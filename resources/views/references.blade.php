@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Reference & Referrals</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Reference & Referrals</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px;">
        <!-- Reference ID Card -->
        <div class="card" style="padding: 25px;">
            <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Your Information</h2>
            
            <div style="text-align: center; padding: 20px; background: rgba(255, 153, 0, 0.05); border: 1px dashed #ff9900; border-radius: 8px; margin-bottom: 20px;">
                <div style="font-size: 12px; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 8px;">Your Unique Reference ID</div>
                <div style="font-size: 24px; font-weight: 700; color: #ff9900; letter-spacing: 1px;">{{ $referenceId }}</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <div style="padding: 10px; background: var(--dm-page-bg); border-radius: 6px; text-align: center;">
                    <div style="font-size: 11px; color: var(--dm-text-secondary); margin-bottom: 4px;">Used a Reference?</div>
                    <div style="font-weight: 700;">{{ $usedReferenceCode ? 'Yes' : 'No' }}</div>
                </div>
                @if($usedReferenceCode && $referrerUsername)
                <div style="padding: 10px; background: var(--dm-page-bg); border-radius: 6px; text-align: center;">
                    <div style="font-size: 11px; color: var(--dm-text-secondary); margin-bottom: 4px;">Referred By</div>
                    <div style="font-weight: 700;">{{ $referrerUsername }}</div>
                </div>
                @endif
            </div>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 6px; padding: 12px; font-size: 12px; color: var(--dm-text-secondary);">
                <strong>Note:</strong> Share your ID only with trusted individuals. Your reference ID is part of your marketplace identity.
            </div>
        </div>

        <!-- Referrals Card -->
        <div class="card" style="padding: 25px;">
            <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Your Referrals</h2>
            
            @if($referrals->count() > 0)
                <p style="font-size: 14px; margin-bottom: 15px;">Users who joined using your code:</p>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach($referrals as $referral)
                        <span style="background: var(--dm-page-bg); padding: 5px 12px; border-radius: 15px; font-size: 13px; border: 1px solid var(--dm-border-color);">
                            {{ $referral->username }}
                        </span>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px 0; color: var(--dm-text-secondary);">
                    <div style="font-size: 32px; margin-bottom: 10px;">👥</div>
                    <p style="margin: 0;">No one hasn't used your reference code yet.</p>
                </div>
            @endif
        </div>

        <!-- Private Vendors Card -->
        <div class="card" style="padding: 25px; grid-column: span 1;">
            <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Private Vendor Access</h2>
            
            <form action="{{ route('references.store') }}" method="POST" style="margin-bottom: 30px;">
                @csrf
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="vendor_reference_id" placeholder="Enter Vendor ID" required minlength="12" maxlength="20" class="form-input" style="flex: 1;">
                    <button type="submit" class="btn btn-primary">Add Vendor</button>
                </div>
                <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 5px;">Input a vendor's reference ID to save them to your list.</div>
            </form>

            <h3 style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Saved Vendor References</h3>
            
            @if(isset($privateShops) && $privateShops->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($privateShops as $shop)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: var(--dm-page-bg); border-radius: 8px; border: 1px solid var(--dm-border-color);">
                            <div>
                                <div style="font-weight: 700; font-size: 14px;">{{ $shop->vendor_username }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary);">ID: {{ $shop->vendor_reference_id }}</div>
                            </div>
                            <form action="{{ route('references.remove', $shop->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-sm" style="color: var(--color-danger); border-color: transparent;" onclick="return confirm('Remove vendor reference?')">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 20px; color: var(--dm-text-secondary); background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px dashed var(--dm-border-color);">
                    <p style="margin: 0; font-size: 13px;">No private vendor references saved.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
