@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <span>Sell on {{ config('app.name') }}</span>
    </div>

    <!-- Hero Section -->
    <div style="background: linear-gradient(135deg, #232f3e 0%, #131921 100%); border-radius: 12px; padding: 60px 40px; margin-bottom: 40px; color: white; display: flex; align-items: center; justify-content: space-between; overflow: hidden; position: relative; border: 1px solid var(--dm-border-color);">
        <div style="max-width: 600px; position: relative; z-index: 2;">
            <h1 style="font-size: 42px; font-weight: 700; margin: 0 0 20px 0; color: #ff9900;">Become a {{ config('app.name') }} Seller</h1>
            <p style="font-size: 18px; line-height: 1.6; margin: 0 0 30px 0; opacity: 0.9;">Reach thousands of customers on the most secure Monero-based marketplace. Start your business today with our professional Seller Central tools.</p>
            
            @if(!isset($vendorPayment) || (!$vendorPayment->payment_completed))
                <a href="{{ route('become.payment') }}" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Get Started — Secure Your Spot</a>
            @else
                <a href="{{ route('become.vendor.application') }}" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Finish Your Application</a>
            @endif
        </div>
        <div style="font-size: 180px; opacity: 0.1; position: absolute; right: -20px; bottom: -40px; pointer-events: none;">🏪</div>
    </div>

    @if(!$hasPgpVerified || !$hasMoneroAddress)
        <div class="card" style="padding: 25px; margin-bottom: 40px; border-left: 4px solid #ff9900; background: rgba(255, 153, 0, 0.05);">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; color: #ff9900;">Pre-Registration Checklist</h3>
            <p style="font-size: 14px; color: var(--dm-text-secondary); margin-bottom: 20px;">For the security of our marketplace, all sellers must complete the following steps before applying:</p>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="display: flex; gap: 15px; align-items: flex-start;">
                    <div style="width: 24px; height: 24px; border-radius: 50%; background: {{ $hasPgpVerified ? '#007600' : 'var(--dm-border-color)' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; margin-top: 2px;">{{ $hasPgpVerified ? '✓' : '1' }}</div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; font-size: 15px; font-weight: 700;">PGP Key Verification</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary);">Required for secure communication. <a href="{{ route('settings') }}" style="color: var(--link-color);">Setup now ›</a></p>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; align-items: flex-start;">
                    <div style="width: 24px; height: 24px; border-radius: 50%; background: {{ $hasMoneroAddress ? '#007600' : 'var(--dm-border-color)' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; margin-top: 2px;">{{ $hasMoneroAddress ? '✓' : '2' }}</div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; font-size: 15px; font-weight: 700;">Monero Return Address</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary);">Required for refund processing. <a href="{{ route('return-addresses.index') }}" style="color: var(--link-color);">Add address ›</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
        <!-- Left: Why Sell / Process -->
        <div>
            <div class="card" style="padding: 30px; margin-bottom: 40px;">
                <h2 style="font-size: 22px; font-weight: 700; margin-top: 0; margin-bottom: 25px;">Why professional sellers choose {{ config('app.name') }}</h2>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <div>
                        <div style="font-size: 28px; margin-bottom: 10px;">🔒</div>
                        <h4 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Ironclad Security</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary); line-height: 1.5;">Mandatory PGP, Escrow system, and XMR focus ensures you and your buyers are always protected.</p>
                    </div>
                    <div>
                        <div style="font-size: 28px; margin-bottom: 10px;">📊</div>
                        <h4 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Advanced Tools</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary); line-height: 1.5;">Powerful inventory management, bulk pricing, and detailed sales statistics at your fingertips.</p>
                    </div>
                    <div>
                        <div style="font-size: 28px; margin-bottom: 10px;">🛡️</div>
                        <h4 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Fair Dispute Resolution</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary); line-height: 1.5;">Our unbiased moderators review every dispute with precision and common sense.</p>
                    </div>
                    <div>
                        <div style="font-size: 28px; margin-bottom: 10px;">💸</div>
                        <h4 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Zero Hidden Fees</h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary); line-height: 1.5;">Simple one-time registration fee and low transaction commissions. We grow when you grow.</p>
                    </div>
                </div>

                <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--dm-border-color);">
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">Our Easy 3-Step Process</h3>
                    <div style="display: flex; gap: 20px;">
                        <div style="flex: 1; text-align: center;">
                            <div style="width: 40px; height: 40px; background: rgba(255, 153, 0, 0.1); color: #ff9900; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; font-weight: 700;">1</div>
                            <h5 style="margin: 0 0 5px 0;">Commitment Fee</h5>
                            <p style="margin: 0; font-size: 11px; color: var(--dm-text-secondary);">One-time XMR payment</p>
                        </div>
                        <div style="flex: 1; text-align: center;">
                            <div style="width: 40px; height: 40px; background: rgba(255, 153, 0, 0.1); color: #ff9900; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; font-weight: 700;">2</div>
                            <h5 style="margin: 0 0 5px 0;">Application</h5>
                            <p style="margin: 0; font-size: 11px; color: var(--dm-text-secondary);">Tell us what you sell</p>
                        </div>
                        <div style="flex: 1; text-align: center;">
                            <div style="width: 40px; height: 40px; background: rgba(255, 153, 0, 0.1); color: #ff9900; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto; font-weight: 700;">3</div>
                            <h5 style="margin: 0 0 5px 0;">Go Live</h5>
                            <p style="margin: 0; font-size: 11px; color: var(--dm-text-secondary);">Review within 24-48h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Application Status / Quick Actions -->
        <div>
            @if(isset($vendorPayment) && $vendorPayment->payment_completed)
                <div class="card" style="padding: 25px; margin-bottom: 30px; border: 1px solid #007600; background: rgba(0, 118, 0, 0.05);">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; color: #007600;">Application Status</h3>
                    
                    @if($vendorPayment->application_status === null)
                        <div style="margin-bottom: 20px;">
                            <span style="font-size: 11px; font-weight: 700; background: #ff9900; color: white; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">Payment Received</span>
                        </div>
                        <p style="font-size: 13px; line-height: 1.5; margin-bottom: 20px;">Your registration fee has been confirmed. Please submit your business details to continue.</p>
                        <a href="{{ route('become.vendor.application') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Submit Application</a>
                    @elseif($vendorPayment->application_status === 'waiting')
                        <div style="margin-bottom: 20px;">
                            <span style="font-size: 11px; font-weight: 700; background: #2b596e; color: white; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">Under Review</span>
                        </div>
                        <p style="font-size: 13px; line-height: 1.5; margin-bottom: 0;">Our team is currently reviewing your application. You will be notified of our decision within 48 hours.</p>
                    @elseif($vendorPayment->application_status === 'accepted')
                        <div style="margin-bottom: 20px; color: #007600; font-weight: 700;">✓ Vendor Status Active</div>
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Go to Seller Central</a>
                    @else
                        <div style="margin-bottom: 20px; color: #ff4444; font-weight: 700;">✕ Application Denied</div>
                        <p style="font-size: 13px; margin-bottom: 0;">Unfortunately, your application did not meet our requirements at this time.</p>
                    @endif
                </div>
            @endif

            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">Established Vendor?</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px;">If you have a proven track record on other platforms, we may waive the registration fee.</p>
                <a href="{{ route('return-addresses.index') }}" class="btn btn-outline btn-sm">Manage Return Addresses</a>
                <a href="{{ route('support.create') }}" class="btn btn-outline btn-sm" style="width: 100%; text-align: center;">Apply for Fee Waiver</a>
                <div style="margin-top: 15px; font-size: 11px; color: var(--dm-text-secondary); line-height: 1.4;">
                    * Proof of history (PGP signed) from recognized marketplaces required.
                </div>
            </div>

            <div class="card" style="padding: 25px; margin-top: 30px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">Safety & Rules</h3>
                <ul style="margin: 0; padding: 0; list-style: none; font-size: 13px; display: flex; flex-direction: column; gap: 10px;">
                    <li style="display: flex; gap: 10px;">
                        <span style="color: #ff9900;">•</span>
                        <span>Zero tolerance for prohibited items.</span>
                    </li>
                    <li style="display: flex; gap: 10px;">
                        <span style="color: #ff9900;">•</span>
                        <span>Fee is non-refundable.</span>
                    </li>
                    <li style="display: flex; gap: 10px;">
                        <span style="color: #ff9900;">•</span>
                        <span>Read our <a href="{{ route('rules') }}" style="color: var(--link-color);">Marketplace Rules ›</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
