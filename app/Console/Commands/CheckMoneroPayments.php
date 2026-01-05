<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Orders;
use MoneroIntegrations\MoneroPhp\walletRPC;
use Illuminate\Support\Facades\Log;

class CheckMoneroPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monero:check-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for pending Monero payments and processes order status timeouts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Monero payment check...');

        $config = config('monero');
        try {
            $walletRPC = app()->makeWith(walletRPC::class, [
                'host' => $config['host'],
                'port' => $config['port'],
                'ssl' => $config['ssl']
            ]);
        } catch (\Exception $e) {
            $this->error('Failed to connect to Monero Wallet RPC: ' . $e->getMessage());
            Log::error('Monero Payment Worker: RPC Connection Failed - ' . $e->getMessage());
            return 1;
        }

        // 1. Check for payments for orders waiting payment
        $waitingOrders = Orders::where('status', Orders::STATUS_WAITING_PAYMENT)->get();
        $this->info("Checking payments for " . $waitingOrders->count() . " waiting orders...");
        
        foreach ($waitingOrders as $order) {
            // Check if expired first
            if ($order->isExpired()) {
                if ($order->handleExpiredPayment()) {
                    $this->line("Order {$order->id} (URL: {$order->unique_url}) has expired and was cancelled.");
                }
                continue;
            }

            // Check for new payments
            if ($order->checkPayments($walletRPC)) {
                if ($order->status === Orders::STATUS_PAYMENT_RECEIVED) {
                    $this->info("Order {$order->id} (URL: {$order->unique_url}) - Payment received!");
                }
            }
        }

        // 2. Process auto-cancellations (not sent) and auto-completions (not confirmed)
        $this->info('Processing auto-status changes for timeout orders...');
        $results = Orders::processAllAutoStatusChanges();
        
        if ($results['cancelled'] > 0) {
            $this->info("Auto-cancelled {$results['cancelled']} orders that were not sent in time.");
        }
        
        if ($results['completed'] > 0) {
            $this->info("Auto-completed {$results['completed']} orders that were not confirmed in time.");
        }

        $this->info('Monero payment check completed.');
        return 0;
    }
}
