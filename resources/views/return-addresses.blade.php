@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Refund Addresses</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Your Monero Refund Addresses</h1>

    <div style="background-color: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-bottom: 30px; display: flex; gap: 15px;">
        <span style="font-size: 24px;">ℹ️</span>
        <div style="font-size: 14px; line-height: 1.5; color: var(--dm-text-main);">
            To shop at {{ config('app.name') }}, you need to add at least one Monero address. Refunds will be made to this address. For your security, use a subaddress instead of your main address and be careful not to share this address elsewhere. Main Monero addresses usually start with "4", while subaddresses start with "8".
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; align-items: stretch;">
        <!-- Add Address Button Container/Card -->
        <div class="card" style="border: 2px dashed var(--dm-border-color); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 30px; text-align: center; background: transparent; cursor: pointer; min-height: 200px;" onclick="document.getElementById('add-address-form').style.display='block'; this.style.display='none'">
            <div style="font-size: 40px; color: var(--dm-text-secondary); margin-bottom: 10px;">+</div>
            <div style="font-size: 18px; font-weight: 700; color: var(--dm-text-secondary);">Add Address</div>
        </div>

        <!-- Add Address Form Card (Hidden by default) -->
        <div id="add-address-form" class="card" style="padding: 25px; display: none;">
            <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px;">Add New Address</h2>
            <form action="{{ route('return-addresses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="monero_address">Monero Address</label>
                    <input type="text" 
                           class="form-input" 
                           id="monero_address" 
                           name="monero_address" 
                           placeholder="Enter Monero refund address"
                           required
                           minlength="40"
                           maxlength="160">
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Add Address</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('add-address-form').style.display='none'; document.querySelector('.card[onclick]').style.display='flex'">Cancel</button>
                </div>
            </form>
        </div>

        @foreach($returnAddresses as $address)
            <div class="card" style="padding: 25px; display: flex; flex-direction: column; justify-content: space-between; min-height: 200px;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <span style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--dm-text-secondary); font-weight: 700;">Monero Address</span>
                        @if($loop->first)
                            <span style="font-size: 11px; background: rgba(0, 118, 0, 0.1); color: #007600; padding: 2px 8px; border-radius: 4px; border: 1px solid #007600;">ACTIVE</span>
                        @endif
                    </div>
                    <div style="font-family: monospace; font-size: 13px; word-break: break-all; line-height: 1.4; color: #fff;">
                        {{ $address->monero_address }}
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; gap: 15px; border-top: 1px solid var(--dm-border-color); padding-top: 15px;">
                    <form action="{{ route('return-addresses.destroy', $address) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 0; color: var(--link-color); font-size: 13px; cursor: pointer;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" onclick="return confirm('Remove this address?')">
                            Remove Address
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @if($returnAddresses->isEmpty())
        <!-- (This is already covered by the Add Address card, but good to keep structure) -->
    @endif
</div>
@endsection
