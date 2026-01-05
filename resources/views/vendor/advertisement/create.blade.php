@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Seller Central</a>
        <span>›</span>
        <a href="{{ route('vendor.my-products') }}">Inventory</a>
        <span>›</span>
        <span>Advertise Product</span>
    </div>

    <div style="max-width: 900px;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 30px;">Launch Advertising Campaign</h1>

        <div style="display: grid; grid-template-columns: 1fr 320px; gap: 30px;">
            <!-- Left: Selection -->
            <div>
                <form action="{{ route('vendor.advertisement.store', $product) }}" method="POST">
                    @csrf
                    
                    <!-- Slot Selection -->
                    <div class="card" style="padding: 30px; margin-bottom: 30px;">
                        <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">1. Select Ad Placement</h3>
                        <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 25px;">Choose where your product will appear. Higher slots offer premium visibility but have limited availability.</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($slots as $slot)
                                <label style="display: flex; align-items: center; gap: 15px; padding: 15px; border: 1px solid var(--dm-border-color); border-radius: 8px; cursor: {{ $slot['is_available'] ? 'pointer' : 'not-allowed' }}; background: {{ $slot['is_available'] ? 'rgba(255,255,255,0.02)' : 'rgba(0,0,0,0.2)' }}; transition: border-color 0.2s; position: relative;">
                                    <input type="radio" name="slot_number" value="{{ $slot['number'] }}" {{ !$slot['is_available'] ? 'disabled' : '' }} {{ old('slot_number') == $slot['number'] ? 'checked' : '' }} required style="accent-color: #ff9900;">
                                    
                                    <div style="flex: 1;">
                                        <div style="display: flex; justify-content: space-between; align-items: baseline;">
                                            <span style="font-weight: 700; {{ !$slot['is_available'] ? 'opacity: 0.5;' : '' }}">Premium Placement #{{ $slot['number'] }}</span>
                                            <span style="font-size: 14px; font-weight: 700; color: #ff9900;">{{ number_format($slot['price'], 4) }} XMR<span style="font-size: 11px; font-weight: 400; color: var(--dm-text-secondary);"> / day</span></span>
                                        </div>
                                        @if(!$slot['is_available'])
                                            <div style="font-size: 11px; color: #ff4444; margin-top: 4px;">Currently occupied by another vendor</div>
                                        @else
                                            <div style="font-size: 11px; color: #007600; margin-top: 4px;">Available for immediate activation</div>
                                        @endif
                                    </div>
                                    @if(old('slot_number') == $slot['number'])
                                        <div style="position: absolute; inset: -1px; border: 2px solid #ff9900; border-radius: 8px; pointer-events: none;"></div>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Duration Selection -->
                    <div class="card" style="padding: 30px; margin-bottom: 30px;">
                        <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">2. Campaign Duration</h3>
                        <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">Select how many days you want your product to be featured.</p>

                        <div class="form-group">
                            <select name="duration_days" required class="form-input" style="width: 200px;">
                                @for($i = config('monero.advertisement_min_duration'); $i <= config('monero.advertisement_max_duration'); $i++)
                                    <option value="{{ $i }}" {{ old('duration_days') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ Str::plural('Day', $i) }}
                                    </option>
                                @endfor
                            </select>
                            <div style="margin-top: 10px; font-size: 11px; color: var(--dm-text-secondary);">Minimum duration is {{ config('monero.advertisement_min_duration') }} days.</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <button type="submit" class="btn btn-primary" style="padding: 12px 40px;">Continue to Payment</button>
                        <a href="{{ route('vendor.my-products') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>

            <!-- Right: Product Preview -->
            <div>
                <div class="card" style="padding: 20px; position: sticky; top: 20px;">
                    <h4 style="margin: 0 0 15px 0; font-size: 13px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Campaign Asset</h4>
                    <div style="border-radius: 8px; overflow: hidden; background: rgba(0,0,0,0.2); margin-bottom: 15px;">
                        <img src="{{ $product->product_picture_url }}" alt="{{ $product->name }}" style="width: 100%; height: auto; aspect-ratio: 1/1; object-fit: cover;">
                    </div>
                    <div style="font-weight: 700; font-size: 16px; margin-bottom: 8px; line-height: 1.3;">{{ $product->name }}</div>
                    <div style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.4; margin-bottom: 15px;">{{ Str::limit($product->description, 100) }}</div>
                    <div style="font-size: 11px; padding: 10px; background: rgba(255,153,0,0.05); border: 1px solid rgba(255,153,0,0.2); border-radius: 4px; color: #ff9900;">
                        This product will be featured in the "Advertised Essentials" sections and at the top of category listings.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
