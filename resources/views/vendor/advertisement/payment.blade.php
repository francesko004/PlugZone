@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Seller Central</a>
        <span>›</span>
        <a href="{{ route('vendor.my-products') }}">Inventory</a>
        <span>›</span>
        <span>Campaign Payment</span>
    </div>

    <div style="max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Finalize Your Ad Campaign</h1>

        <div style="display: grid; grid-template-columns: 1fr 320px; gap: 30px;">
            <!-- Left: Payment Details -->
            <div>
                <div class="card" style="padding: 30px; margin-bottom: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Payment Verification</h3>
                    
                    <div style="background: rgba(0,0,0,0.1); padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid var(--dm-border-color);">
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 10px;">Send Monero (XMR) to this unique address</label>
                        <div style="font-family: monospace; font-size: 14px; word-break: break-all; color: #ff9900; line-height: 1.4; background: var(--dm-page-bg); padding: 12px; border-radius: 4px; border: 1px solid var(--dm-border-color);">
                            {{ $advertisement->payment_address }}
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 5px;">TOTAL COST</label>
                            <div style="font-size: 22px; font-weight: 700;">{{ number_format($advertisement->required_amount, 6) }} XMR</div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 5px;">RECEIVED</label>
                            <div style="font-size: 22px; font-weight: 700; color: {{ $advertisement->payment_completed ? '#007600' : 'inherit' }}">
                                {{ number_format($advertisement->total_received, 8) }} XMR
                            </div>
                        </div>
                    </div>

                    <div style="padding: 20px; background: rgba(255, 153, 0, 0.05); border-radius: 8px; border: 1px solid #ff9900;">
                        <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: 700; color: #ff9900;">Campaign Status</h4>
                        @if($advertisement->payment_completed)
                            <div style="color: #007600; font-weight: 700; display: flex; align-items: center; gap: 10px;">
                                <div style="width: 10px; height: 10px; background: #007600; border-radius: 50%;"></div>
                                Payment Confirmed — Ad Live in Slot #{{ $advertisement->slot_number }}
                            </div>
                            <div style="margin-top: 15px;">
                                <a href="{{ route('vendor.my-products') }}" class="btn btn-primary btn-sm">Manage Active Ads</a>
                            </div>
                        @else
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 13px;">
                                <div style="width: 10px; height: 10px; background: #ff9900; border-radius: 50%; box-shadow: 0 0 8px #ff9900;"></div>
                                Monitoring Monero blockchain for your transaction...
                            </div>
                            <div style="margin-top: 15px; display: flex; gap: 10px; align-items: center;">
                                <a href="{{ route('vendor.advertisement.payment', $advertisement->payment_identifier) }}" class="btn btn-outline btn-sm">Refresh Status</a>
                                <span style="font-size: 11px; color: var(--dm-text-secondary);">Expires {{ $advertisement->expires_at->diffForHumans() }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card" style="padding: 25px; border-left: 4px solid #ff4444; background: rgba(255, 68, 68, 0.02);">
                    <h4 style="margin: 0 0 10px 0; font-size: 14px; font-weight: 700; color: #ff4444;">Important Notice</h4>
                    <p style="font-size: 12px; margin: 0; line-height: 1.5; color: var(--dm-text-secondary);">
                        Do not send more or less than the required amount. We recommend waiting for on-chain confirmation before navigating away from this page. Payments below {{ number_format($advertisement->required_amount * config('monero.advertisement_minimum_payment_percentage'), 4) }} XMR will not be recognized.
                    </p>
                </div>
            </div>

            <!-- Right: Campaign Summary -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="card" style="padding: 20px; text-align: center;">
                    <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 15px; color: var(--dm-text-secondary);">SCAN TO PAY</label>
                    @if($qrCode)
                        <img src="{{ $qrCode }}" alt="Payment QR" style="width: 100%; height: auto; border: 8px solid white; border-radius: 8px; max-width: 200px; margin: 0 auto;">
                    @else
                        <div style="padding: 40px; background: #f0f0f0; border-radius: 8px;">
                            <span style="font-size: 30px;">🪙</span>
                        </div>
                    @endif
                </div>

                <div class="card" style="padding: 20px;">
                    <h4 style="margin: 0 0 15px 0; font-size: 13px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Order Summary</h4>
                    <div style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Placement:</span>
                            <span style="font-weight: 700;">Slot #{{ $advertisement->slot_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Duration:</span>
                            <span style="font-weight: 700;">{{ $advertisement->duration_days }} Days</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Product:</span>
                            <span style="font-weight: 700; text-align: right;">{{ Str::limit($advertisement->product->name, 20) }}</span>
                        </div>
                        <hr style="border: 0; border-top: 1px solid var(--dm-border-color); margin: 5px 0;">
                        <div style="display: flex; justify-content: space-between; font-size: 15px; color: #ff9900;">
                            <span style="font-weight: 700;">Total:</span>
                            <span style="font-weight: 700;">{{ number_format($advertisement->required_amount, 6) }} XMR</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
