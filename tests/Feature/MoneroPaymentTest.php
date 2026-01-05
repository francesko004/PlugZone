<?php

namespace Tests\Feature;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use MoneroIntegrations\MoneroPhp\walletRPC;
use Mockery;
use Illuminate\Support\Facades\Hash;

class MoneroPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_detects_received_payment()
    {
        // 1. Create a user and a vendor
        $user = User::create([
            'username' => 'buyer1',
            'password' => Hash::make('Password123!'),
            'reference_id' => 'REF1234567890ABC',
            'mnemonic' => 'test mnemonic phrase here',
        ]);
        
        $vendor = User::create([
            'username' => 'vendor1',
            'password' => Hash::make('Password123!'),
            'reference_id' => 'REF0987654321CBA',
            'mnemonic' => 'test mnemonic phrase here',
        ]);
        
        $order = Orders::create([
            'user_id' => $user->id,
            'vendor_id' => $vendor->id,
            'total' => 100,
            'required_xmr_amount' => 1.0,
            'payment_address' => '4...',
            'payment_address_index' => 1,
            'status' => Orders::STATUS_WAITING_PAYMENT,
            'expires_at' => now()->addDay(),
            'subtotal' => 99,
            'commission' => 1,
        ]);

        // 2. Mock walletRPC
        $mock = Mockery::mock(walletRPC::class);
        $mock->shouldReceive('get_transfers')->once()->andReturn([
            'in' => [
                ['amount' => 1.0 * 1e12]
            ],
            'pool' => []
        ]);
        
        $this->app->bind(walletRPC::class, function () use ($mock) {
            return $mock;
        });

        // 3. Run the command
        Artisan::call('monero:check-payments');

        // 4. Assert order status changed to payment_received
        $order->refresh();
        $this->assertEquals(Orders::STATUS_PAYMENT_RECEIVED, $order->status);
        $this->assertTrue($order->is_paid);
    }

    public function test_command_cancels_expired_orders()
    {
        // 1. Create an expired order
        $user = User::create([
            'username' => 'buyer2',
            'password' => Hash::make('Password123!'),
            'reference_id' => 'REF2234567890ABC',
            'mnemonic' => 'test mnemonic phrase here',
        ]);
        
        $vendor = User::create([
            'username' => 'vendor2',
            'password' => Hash::make('Password123!'),
            'reference_id' => 'REF2789067890ABC',
            'mnemonic' => 'test mnemonic phrase here',
        ]);
        
        $order = Orders::create([
            'user_id' => $user->id,
            'vendor_id' => $vendor->id,
            'total' => 100,
            'required_xmr_amount' => 1.0,
            'status' => Orders::STATUS_WAITING_PAYMENT,
            'expires_at' => now()->subDay(), // Expired yesterday
            'subtotal' => 99,
            'commission' => 1,
        ]);

        // 2. Mock walletRPC
        $mock = Mockery::mock(walletRPC::class);
        $this->app->bind(walletRPC::class, function () use ($mock) {
            return $mock;
        });

        // 3. Run the command
        Artisan::call('monero:check-payments');

        // 4. Assert order status changed to cancelled
        $order->refresh();
        $this->assertEquals(Orders::STATUS_CANCELLED, $order->status);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
