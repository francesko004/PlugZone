@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Seller Central</a>
        <span>›</span>
        <span>Storefront Settings</span>
    </div>

    <div style="max-width: 900px;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 30px;">Storefront Settings</h1>

        <form action="{{ route('vendor.appearance.update') }}" method="POST">
            @csrf
            
            <!-- Store Visibility Section -->
            <div class="card" style="padding: 30px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Store Visibility</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                    <!-- Vacation Mode -->
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label style="font-weight: 700; font-size: 15px;">Vacation Mode</label>
                            <label class="switch">
                                <input type="hidden" name="vacation_mode" value="0">
                                <input type="checkbox" name="vacation_mode" value="1" {{ $vendorProfile->vacation_mode ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin: 0;">Temporarily take your products off the market. New orders cannot be placed while this is active.</p>
                    </div>

                    <!-- Private Shop Mode -->
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label style="font-weight: 700; font-size: 15px;">Private Shop</label>
                            <label class="switch">
                                <input type="hidden" name="private_shop_mode" value="0">
                                <input type="checkbox" name="private_shop_mode" value="1" {{ $vendorProfile->private_shop_mode ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin: 0;">Hide your store from the public directory. Only customers with your direct link or reference code can see your shop.</p>
                    </div>
                </div>
            </div>

            <!-- Store Content Section -->
            <div class="card" style="padding: 30px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Store Content</h3>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label class="form-label" style="display: flex; justify-content: space-between; align-items: baseline;">
                        <span>Store Description</span>
                        <span style="font-weight: 400; font-size: 11px; color: var(--dm-text-secondary);">8-800 characters</span>
                    </label>
                    <textarea 
                        name="description" 
                        class="form-input" 
                        rows="6" 
                        required 
                        minlength="8" 
                        maxlength="800" 
                        placeholder="Tell your customers about your shop, specialization, and brand values..."
                        style="resize: vertical; font-size: 14px;">{{ old('description', $vendorProfile->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" style="display: flex; justify-content: space-between; align-items: baseline;">
                        <span>Vendor Terms & Policy</span>
                        <span style="font-weight: 400; font-size: 11px; color: var(--dm-text-secondary);">8-1600 characters</span>
                    </label>
                    <textarea 
                        name="vendor_policy" 
                        class="form-input" 
                        rows="10" 
                        minlength="8" 
                        maxlength="1600" 
                        placeholder="Clearly outline your shipping policies, refund terms, and customer communication expectations..."
                        style="resize: vertical; font-size: 14px;">{{ old('vendor_policy', $vendorProfile->vendor_policy) }}</textarea>
                </div>
            </div>

            <div style="margin-top: 40px; display: flex; gap: 15px;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 30px;">Save Appearance Settings</button>
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Cancel Changes</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Amazon-style Toggle Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 46px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #313131;
  transition: .2s;
  border: 1px solid #444;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: .2s;
}

input:checked + .slider {
  background-color: #ff9900;
  border-color: #e68a00;
}

input:focus + .slider {
  box-shadow: 0 0 1px #ff9900;
}

input:checked + .slider:before {
  transform: translateX(22px);
}

.slider.round {
  border-radius: 24px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection
