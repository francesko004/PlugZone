@extends('layouts.app')

@section('content')
<div class="main-content">
    {{-- Checkout Progress Indicator --}}
    <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 50px; gap: 20px;">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #3399ff; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff;">1</div>
            <span style="font-size: 12px; font-weight: 700; color: #3399ff;">Cart</span>
        </div>
        <div style="width: 100px; height: 2px; background: #3399ff; margin-bottom: 20px;"></div>
        <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: #3399ff; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff;">2</div>
            <span style="font-size: 12px; font-weight: 700; color: #3399ff;">Review</span>
        </div>
        <div style="width: 100px; height: 2px; background: rgba(255,255,255,0.1); margin-bottom: 20px;"></div>
        <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(255,255,255,0.05); border: 2px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #888;">3</div>
            <span style="font-size: 12px; font-weight: 700; color: var(--dm-text-secondary);">Payment</span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px; align-items: start;">
        <!-- Left: Order Review -->
        <div>
            <h1 style="font-size: 24px; font-weight: 700; margin-bottom: 30px;">Review your order</h1>
            
            <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 30px;">
                <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 25px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700;">Inventory for Service</h3>
                    @if($cartItems->isNotEmpty())
                        <span style="font-size: 13px; color: var(--dm-text-secondary);">Contract Partner: <strong style="color: #ff9900;">{{ $cartItems->first()->product->user->username }}</strong></span>
                    @endif
                </div>

                <div style="padding: 25px;">
                    @forelse($cartItems as $item)
                        <div style="display: flex; gap: 20px; padding-bottom: 25px; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); &:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }">
                            <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.03); border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                                📦
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <h4 style="margin: 0; font-size: 16px; font-weight: 700;">{{ $item->product->name }}</h4>
                                    <div style="text-align: right;">
                                        <div style="font-size: 18px; font-weight: 700; color: #fff;">${{ number_format($item->getTotalPrice(), 2) }}</div>
                                        @if(is_numeric($xmrPrice) && $xmrPrice > 0)
                                            <div style="font-size: 12px; color: var(--dm-text-secondary);">≈ ɱ{{ number_format($item->getTotalPrice() / $xmrPrice, 4) }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div style="font-size: 13px; color: var(--dm-text-secondary); line-height: 1.6;">
                                    @if($item->selected_bulk_option)
                                        <span style="color: #00cc66; font-weight: 700;">Bulk Precision:</span> {{ $item->quantity }} sets of {{ $item->selected_bulk_option['amount'] }} {{ $measurementUnits[$item->product->measurement_unit] ?? $item->product->measurement_unit }}<br>
                                        <small>(Total Weight/Vol: {{ $item->quantity * $item->selected_bulk_option['amount'] }} {{ $measurementUnits[$item->product->measurement_unit] ?? $item->product->measurement_unit }})</small>
                                    @else
                                        Quantity: <strong style="color: #fff;">{{ $item->quantity }}</strong> {{ $measurementUnits[$item->product->measurement_unit] ?? $item->product->measurement_unit }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="padding: 40px; text-align: center;">
                            <p style="color: var(--dm-text-secondary); margin: 0;">Basket transition incomplete. No items detected.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($hasEncryptedMessage && $messageItem)
                <div class="card" style="padding: 25px;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Encrypted Logistics Metadata</h3>
                    <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; border: 1px solid var(--dm-border-color);">
                        <div style="font-size: 11px; color: var(--dm-text-secondary); margin-bottom: 10px; font-family: monospace; text-transform: uppercase; letter-spacing: 1px;">PGP SECURED PAYLOAD FOR PARTNER</div>
                        <pre style="margin: 0; font-size: 12px; color: #aaa; white-space: pre-wrap; font-family: monospace; line-height: 1.5;">{{ $messageItem->encrypted_message }}</pre>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right: Order Summary Sidebar -->
        <div style="position: sticky; top: 100px;">
            <div class="card" style="padding: 30px; border-top: 4px solid #ff9900;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 25px;">Order Summary</h3>
                
                <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Items:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Infrastructure Fee ({{ $commissionPercentage }}%):</span>
                        <span>${{ number_format($commission, 2) }}</span>
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                        <span style="font-size: 18px; font-weight: 700; color: #ff4444;">Order Total:</span>
                        <div style="text-align: right;">
                            <div style="font-size: 24px; font-weight: 700; color: #fff;">${{ number_format($total, 2) }}</div>
                        </div>
                    </div>
                    @if(is_numeric($xmrTotal))
                        <div style="text-align: right; font-size: 14px; font-weight: 700; color: #3399ff; font-family: monospace;">ɱ{{ number_format($xmrTotal, 4) }} XMR</div>
                    @endif
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 16px;">Place your order</button>
                    <p style="font-size: 11px; color: var(--dm-text-secondary); text-align: center; margin-top: 15px; line-height: 1.4;">
                        By placing your order, you agree to {{ config('app.name') }}'s <a href="{{ route('rules') }}" style="color: #3399ff; text-decoration: none;">conditions of use</a> and privacy notice.
                    </p>
                </form>
            </div>

            <div class="card" style="margin-top: 20px; padding: 20px; background: rgba(51, 153, 255, 0.03); border: 1px solid rgba(51, 153, 255, 0.1);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: #3399ff;">Secure Settlement</h4>
                <p style="font-size: 11px; color: var(--dm-text-secondary); margin: 0; line-height: 1.5;">Orders are queued for Monero settlement. Funds will be held in platform escrow until delivery verification or dispute resolution.</p>
            </div>
            
            <a href="{{ route('cart.index') }}" style="display: block; text-align: center; margin-top: 20px; font-size: 13px; color: var(--dm-text-secondary); text-decoration: none;">‹ Adjust inventory in cart</a>
        </div>
    </div>
</div>
@endsection
