@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Vendor Dashboard</a>
        <span>›</span>
        <a href="{{ route('vendor.my-products') }}">Inventory</a>
        <span>›</span>
        <span>Add Listing</span>
    </div>

    <div style="max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Add New {{ ucfirst($type) }} Product</h1>

        <form action="{{ route('vendor.products.store', $type) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Basic Information -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">General Information</h3>
                
                <div class="form-group">
                    <label for="name" class="form-label">Product Title</label>
                    <input type="text" name="name" id="name" required class="form-input" value="{{ old('name') }}" minlength="4" maxlength="240" placeholder="e.g. High quality digital service or physical item name">
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea name="description" id="description" rows="8" required class="form-input" style="resize: vertical;" minlength="4" maxlength="2400" placeholder="Describe your product in detail. Include features, requirements, and any other important information.">{{ old('description') }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" required class="form-select">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @foreach($category->children as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('category_id') == $subcategory->id ? 'selected' : '' }}>-- {{ $subcategory->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="measurement_unit" class="form-label">Unit of Measure</label>
                        <select name="measurement_unit" id="measurement_unit" required class="form-select">
                            @foreach($measurementUnits as $value => $label)
                                <option value="{{ $value }}" {{ old('measurement_unit') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 2: Pricing & Inventory -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Pricing & Inventory</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="price" class="form-label">Price (USD)</label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 12px; top: 50%; translate: 0 -50%; color: var(--dm-text-secondary);">$</span>
                            <input type="number" name="price" id="price" required step="0.01" min="0" max="80000" class="form-input" style="padding-left: 25px;" value="{{ old('price') }}" placeholder="0.00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock_amount" class="form-label">Initial Stock</label>
                        <input type="number" name="stock_amount" id="stock_amount" required min="0" max="80000" class="form-input" value="{{ old('stock_amount', 0) }}">
                    </div>
                </div>

                @if($type !== 'digital')
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label for="ships_from" class="form-label">Ships From</label>
                        <select name="ships_from" id="ships_from" required class="form-select">
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ old('ships_from', 'Worldwide') == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ships_to" class="form-label">Ships To</label>
                        <select name="ships_to" id="ships_to" required class="form-select">
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ old('ships_to', 'Worldwide') == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

            <!-- Section 3: Media -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Product Images</h3>
                
                <div class="form-group">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="product_picture" id="product_picture" accept="image/*" class="form-input" style="padding: 8px;">
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 5px;">JPEG, PNG, GIF, WebP. Max 800KB.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Additional Photos (Optional, up to 3)</label>
                    <input type="file" name="additional_photos[]" id="additional_photos" accept="image/*" multiple class="form-input" style="padding: 8px;">
                </div>
            </div>

            <!-- Section 4: Delivery Options -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 10px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">{{ $type === 'deaddrop' ? 'Pickup' : 'Delivery' }} Options</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">Provide at least one delivery method. Customers will choose from these options at checkout.</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    @for ($i = 0; $i < 4; $i++)
                        <div style="padding: 15px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--dm-border-color); border-radius: 8px;">
                            <h4 style="margin: 0 0 10px 0; font-size: 13px; color: var(--dm-text-secondary);">Option {{ $i + 1 }}</h4>
                            <div class="form-group">
                                <input type="text" name="delivery_options[{{ $i }}][description]" class="form-input" style="font-size: 13px; margin-bottom: 10px;" value="{{ old('delivery_options.'.$i.'.description') }}" placeholder="Description (e.g. Standard Shipping)" {{ $i === 0 ? 'required' : '' }}>
                                <div style="position: relative;">
                                    <span style="position: absolute; left: 10px; top: 50%; translate: 0 -50%; font-size: 12px; color: var(--dm-text-secondary);">$</span>
                                    <input type="number" name="delivery_options[{{ $i }}][price]" step="0.01" class="form-input" style="padding-left: 20px; font-size: 13px;" value="{{ old('delivery_options.'.$i.'.price') }}" placeholder="Add. Cost" {{ $i === 0 ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 5: Bulk Pricing -->
            <div class="card" style="padding: 25px; margin-bottom: 40px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 10px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Bulk Pricing (Optional)</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">Offer discounts for larger quantities.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    @for ($i = 0; $i < 4; $i++)
                        <div style="padding: 12px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--dm-border-color); border-radius: 8px;">
                            <div style="display: flex; gap: 8px;">
                                <input type="number" name="bulk_options[{{ $i }}][amount]" class="form-input" style="font-size: 12px;" value="{{ old('bulk_options.'.$i.'.amount') }}" placeholder="Qty">
                                <input type="number" name="bulk_options[{{ $i }}][price]" step="0.01" class="form-input" style="font-size: 12px;" value="{{ old('bulk_options.'.$i.'.price') }}" placeholder="Price/Unit">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 25px; background: var(--dm-card-bg); border-radius: 8px; border: 1px solid var(--dm-border-color); margin-bottom: 50px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 40px;">Create Listing</button>
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
