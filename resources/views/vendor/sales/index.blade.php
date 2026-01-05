@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Vendor Dashboard</a>
        <span>›</span>
        <span>Sales History</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">My Sales</h1>
    </div>

    @if($sales->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">💵</div>
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">You haven't made any sales yet</h2>
            <p style="color: var(--dm-text-secondary); max-width: 400px; margin: 0 auto;">Once customers start buying your products, their orders will appear here.</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($sales as $sale)
                <div class="card" style="padding: 20px; display: flex; justify-content: space-between; align-items: center; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--link-color)'" onmouseout="this.style.borderColor='var(--dm-border-color)'">
                    <div style="display: flex; gap: 20px; align-items: center;">
                        <div style="width: 45px; height: 45px; background: rgba(255, 153, 0, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            💰
                        </div>
                        <div>
                            <h3 style="margin: 0 0 5px 0; font-size: 16px; font-weight: 700;">Order #{{ strtoupper(substr($sale->id, 0, 8)) }}</h3>
                            <div style="font-size: 13px; color: var(--dm-text-secondary);">
                                Buyer: <span style="color: var(--dm-text-main);">{{ $sale->user->username }}</span> • {{ $sale->created_at->format('M d, Y') }} at {{ $sale->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 40px;">
                        <div style="text-align: right;">
                            <div style="font-size: 18px; font-weight: 700; color: #ff9900;">${{ number_format($sale->total, 2) }}</div>
                            <div style="font-size: 11px; color: var(--dm-text-secondary);">ɱ{{ number_format($sale->required_xmr_amount, 8) }}</div>
                        </div>
                        <div style="text-align: right; width: 120px;">
                            <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 4px 10px; border-radius: 12px; 
                                {{ $sale->status === 'payment_received' ? 'background: rgba(0, 118, 0, 0.1); color: #007600; border: 1px solid #007600;' : 
                                   ($sale->status === 'waiting_payment' ? 'background: rgba(43, 89, 110, 0.1); color: #2b596e; border: 1px solid #2b596e;' : 
                                   ($sale->status === 'product_sent' ? 'background: rgba(255, 153, 0, 0.1); color: #f08804; border: 1px solid #f08804;' : 
                                   'background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); border: 1px solid var(--dm-border-color);')) }}">
                                {{ $sale->getFormattedStatus() }}
                            </span>
                        </div>
                        <a href="{{ route('vendor.sales.show', $sale->unique_url) }}" class="btn btn-outline btn-sm">Manage Sale</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 25px;">
            {{ $sales->links() }}
        </div>
    @endif
</div>
@endsection
