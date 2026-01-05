@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('become.vendor') }}">Vendor Center</a>
        <span>›</span>
        <span>Registration Payment</span>
    </div>

    <div style="max-width: 900px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Finalize Seller Registration</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Secure your platform credentials and activate your merchant operations.</p>
        </div>

        @if(!$hasPgpVerified || !$hasMoneroAddress)
            <div class="card" style="padding: 35px; border-left: 5px solid #ff4444; background: rgba(255, 68, 68, 0.03);">
                <h3 style="margin: 0 0 15px 0; font-size: 18px; font-weight: 700; color: #ff4444;">Prerequisites Incomplete</h3>
                <p style="font-size: 14px; margin-bottom: 0; line-height: 1.6;">You must verify your PGP identity and configure a Monero refund address on the <a href="{{ route('become.vendor') }}" style="color: #3399ff; text-decoration: none; font-weight: 700;">Merchant Orientation</a> dashboard before deploying your deposit.</p>
            </div>
        @else
            @if(isset($error))
                <div class="card" style="padding: 40px; border: 1px solid #ff4444; text-align: center;">
                    <div style="font-size: 40px; margin-bottom: 20px;">⚠️</div>
                    <h2 style="color: #ff4444; margin: 0 0 10px 0; font-size: 22px;">Gateway Synchronization Error</h2>
                    <p style="color: var(--dm-text-secondary); margin-bottom: 30px;">{{ $error }}</p>
                </div>
            @endif
            
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Campaign Acceleration Payment</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Secure prominent placement and increase listing visibility across PlugZone.</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 40px; align-items: start;">
            <!-- Left: Payment Terminal -->
            <div>
                <div class="card" style="padding: 35px; border-top: 4px solid #3399ff;">
                    <h3 style="margin: 0 0 25px 0; font-size: 18px; font-weight: 700;">Transaction Handshake</h3>
                    
                    <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; border: 1px solid var(--dm-border-color); margin-bottom: 30px;">
                        <label style="display: block; font-size: 10px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">CONTRACT DEPOSIT ADDRESS</label>
                        <div style="font-family: monospace; font-size: 14px; color: #3399ff; word-break: break-all; line-height: 1.5; background: rgba(51, 153, 255, 0.05); padding: 15px; border-radius: 4px; border: 1px solid rgba(51, 153, 255, 0.1);">
                            {{ $advertisement->payment_address }}
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;">
                        <div>
                            <label style="display: block; font-size: 10px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 8px; letter-spacing: 0.5px;">TOTAL CAMPAIGN COST</label>
                            <div style="font-size: 22px; font-weight: 700; color: #fff;">{{ number_format($advertisement->required_amount, 6) }} <span style="font-size: 14px; font-weight: 400; color: var(--dm-text-secondary);">XMR</span></div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 10px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 8px; letter-spacing: 0.5px;">ON-CHAIN BALANCE</label>
                            <div style="font-size: 22px; font-weight: 700; color: {{ $advertisement->payment_completed ? '#00cc66' : '#3399ff' }}">
                                {{ number_format($advertisement->total_received, 8) }} <span style="font-size: 14px; font-weight: 400; color: var(--dm-text-secondary);">XMR</span>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 25px; background: rgba(51, 153, 255, 0.03); border-radius: 8px; border: 1px solid rgba(51, 153, 255, 0.1);">
                        <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #3399ff; text-transform: uppercase; letter-spacing: 0.5px;">Stream Status</h4>
                        @if($advertisement->payment_completed)
                            <div style="color: #00cc66; font-weight: 700; display: flex; align-items: center; gap: 12px; font-size: 15px;">
                                <div style="width: 12px; height: 12px; background: #00cc66; border-radius: 50%; box-shadow: 0 0 10px #00cc66;"></div>
                                Payment Verified. Campaign Active in Slot #{{ $advertisement->slot_number }}
                            </div>
                            <div style="margin-top: 25px;">
                                <a href="{{ route('vendor.my-products') }}" class="btn btn-primary" style="padding: 10px 40px;">Manage Inventory</a>
                            </div>
                        @else
                            <div style="display: flex; align-items: center; gap: 12px; font-size: 14px; color: #fff;">
                                <div style="width: 10px; height: 10px; background: #3399ff; border-radius: 50%; box-shadow: 0 0 8px #3399ff;"></div>
                                Analyzing Monero ecosystem for matching transaction...
                            </div>
                            <div style="margin-top: 20px; display: flex; gap: 15px; align-items: center;">
                                <a href="{{ route('vendor.advertisement.payment', $advertisement->payment_identifier) }}" class="btn btn-secondary btn-sm">Refresh Status</a>
                                <span style="font-size: 11px; color: var(--dm-text-secondary);">Expires {{ $advertisement->expires_at->diffForHumans() }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card" style="margin-top: 30px; padding: 25px; border-left: 5px solid #ff4444; background: rgba(255, 68, 68, 0.03);">
                    <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #ff4444; text-transform: uppercase; letter-spacing: 0.5px;">Operational Protocol</h4>
                    <p style="font-size: 12px; margin: 0; line-height: 1.6; color: var(--dm-text-secondary);">
                        Deploy the exact contract amount. Payments below <strong style="color: #fff;">{{ number_format($advertisement->required_amount * config('monero.advertisement_minimum_payment_percentage'), 4) }} XMR</strong> will fail internal verification and may result in asset forfeiture.
                    </p>
                </div>
            </div>

            <!-- Right: Campaign Metrics -->
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div class="card" style="padding: 25px; text-align: center;">
                    <label style="display: block; font-size: 10px; font-weight: 700; margin-bottom: 20px; color: var(--dm-text-secondary); text-transform: uppercase;">Scan Terminal</label>
                    @if($qrCode)
                        <div style="background: #fff; padding: 15px; border-radius: 8px; display: inline-block;">
                            <img src="{{ $qrCode }}" alt="Payment QR" style="width: 180px; height: auto; display: block;">
                        </div>
                    @else
                        <div style="padding: 50px; background: rgba(255,255,255,0.05); border-radius: 8px; color: var(--dm-text-secondary); font-size: 60px;">🪙</div>
                    @endif
                </div>

                <div class="card" style="padding: 25px;">
                    <h4 style="margin: 0 0 20px 0; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; letter-spacing: 1px;">Execution Summary</h4>
                    <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Infrastructure Slot:</span>
                            <span style="font-weight: 700; color: #fff;">#{{ $advertisement->slot_number }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Lease Duration:</span>
                            <span style="font-weight: 700; color: #fff;">{{ $advertisement->duration_days }} Units</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Linked Asset:</span>
                            <span style="font-weight: 700; color: #fff; text-align: right;">{{ Str::limit($advertisement->product->name, 20) }}</span>
                        </div>
                        <hr style="border: 0; border-top: 1px solid var(--dm-border-color); margin: 5px 0;">
                        <div style="display: flex; justify-content: space-between; font-size: 16px;">
                            <span style="font-weight: 700; color: #ff9900;">Total Required:</span>
                            <span style="font-weight: 700; color: #fff;">{{ number_format($advertisement->required_amount, 6) }} XMR</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
