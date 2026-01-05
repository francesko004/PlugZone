@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Vendor Dashboard</a>
        <span>›</span>
        <a href="{{ route('vendor.my-products') }}">Inventory</a>
        <span>›</span>
        <span>Edit Listing</span>
    </div>

    <div style="max-width: 900px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Edit {{ ucfirst($product->type) }} Product</h1>
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline btn-sm" target="_blank">View Live Listing ↗</a>
        </div>

        <form action="{{ route('vendor.products.update', $product) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Section 0: Visibility Control (Floating Card Style) -->
            <div class="card" style="padding: 20px; margin-bottom: 30px; border-left: 4px solid {{ $product->active ? '#007600' : '#ff4444' }}; background: {{ $product->active ? 'rgba(0, 118, 0, 0.05)' : 'rgba(255, 68, 68, 0.05)' }};">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h4 style="margin: 0 0 5px 0; font-size: 16px; font-weight: 700; color: {{ $product->active ? '#007600' : '#ff4444' }};">
                            Listing is Currently {{ $product->active ? 'ACTIVE' : 'INACTIVE' }}
                        </h4>
                        <p style="margin: 0; font-size: 13px; color: var(--dm-text-secondary);">
                            {{ $product->active ? 'Customers can find and purchase this item.' : 'This listing is hidden from all search results and categories.' }}
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 12px; font-weight: 700;">Active:</span>
                        <input type="checkbox" name="active" id="active" value="1" style="width: 20px; height: 20px;" {{ $product->active ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <!-- Section 1: Basic Information -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">General Information</h3>
                
                <div class="form-group">
                    <label class="form-label">Product Title (Read-only)</label>
                    <input type="text" value="{{ $product->name }}" class="form-input" style="background: rgba(0,0,0,0.1); opacity: 0.7;" readonly disabled>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea name="description" id="description" rows="8" required class="form-input" style="resize: vertical;" minlength="4" maxlength="2400">{{ old('description', $product->description) }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" required class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @foreach($category->children as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('category_id', $product->category_id) == $subcategory->id ? 'selected' : '' }}>-- {{ $subcategory->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="measurement_unit" class="form-label">Unit of Measure</label>
                        <select name="measurement_unit" id="measurement_unit" required class="form-select">
                            @foreach($measurementUnits as $value => $label)
                                <option value="{{ $value }}" {{ old('measurement_unit', $product->measurement_unit) == $value ? 'selected' : '' }}>{{ $label }}</option>
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
                            <input type="number" name="price" id="price" required step="0.01" min="0" max="80000" class="form-input" style="padding-left: 25px;" value="{{ old('price', $product->price) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock_amount" class="form-label">Current Stock</label>
                        <input type="number" name="stock_amount" id="stock_amount" required min="0" max="80000" class="form-input" value="{{ old('stock_amount', $product->stock_amount) }}">
                    </div>
                </div>

                @if($product->type !== 'digital')
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label for="ships_from" class="form-label">Ships From</label>
                        <select name="ships_from" id="ships_from" required class="form-select">
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ old('ships_from', $product->ships_from) == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ships_to" class="form-label">Ships To</label>
                        <select name="ships_to" id="ships_to" required class="form-select">
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ old('ships_to', $product->ships_to) == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

            <!-- Section 3: Photos (Display only in Edit) -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Listing Photos</h3>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <div style="width: 120px; height: 120px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden; position: relative; background: var(--dm-page-bg);">
                        <img src="{{ $product->product_picture_url }}" alt="Main" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); color: white; font-size: 10px; padding: 2px 5px; text-align: center;">Main</div>
                    </div>
                    @foreach($product->additional_photos_urls as $photoUrl)
                        <div style="width: 120px; height: 120px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden; background: var(--dm-page-bg);">
                            <img src="{{ $photoUrl }}" alt="Additional" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <p style="font-size: 12px; color: var(--dm-text-secondary); margin-top: 15px;">Note: Images cannot be edited after creation for security reasons. If you need to change photos, please create a new listing.</p>
            </div>

            <!-- Section 4: Delivery Options -->
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 15px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">{{ $product->type === 'deaddrop' ? 'Pickup' : 'Delivery' }} Options</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    @for ($i = 0; $i < 4; $i++)
                        <div style="padding: 15px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--dm-border-color); border-radius: 8px;">
                            <h4 style="margin: 0 0 10px 0; font-size: 13px; color: var(--dm-text-secondary);">Option {{ $i + 1 }}</h4>
                            <div class="form-group">
                                <input type="text" name="delivery_options[{{ $i }}][description]" class="form-input" style="font-size: 13px; margin-bottom: 10px;" value="{{ old('delivery_options.'.$i.'.description', $product->delivery_options[$i]['description'] ?? '') }}" placeholder="Description" {{ $i === 0 ? 'required' : '' }}>
                                <div style="position: relative;">
                                    <span style="position: absolute; left: 10px; top: 50%; translate: 0 -50%; font-size: 12px; color: var(--dm-text-secondary);">$</span>
                                    <input type="number" name="delivery_options[{{ $i }}][price]" step="0.01" class="form-input" style="padding-left: 20px; font-size: 13px;" value="{{ old('delivery_options.'.$i.'.price', $product->delivery_options[$i]['price'] ?? '') }}" placeholder="Add. Cost" {{ $i === 0 ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 5: Bulk Pricing -->
            <div class="card" style="padding: 25px; margin-bottom: 40px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 15px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Bulk Pricing</h3>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    @for ($i = 0; $i < 4; $i++)
                        <div style="padding: 12px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--dm-border-color); border-radius: 8px;">
                            <div style="display: flex; gap: 8px;">
                                <input type="number" name="bulk_options[{{ $i }}][amount]" class="form-input" style="font-size: 12px;" value="{{ old('bulk_options.'.$i.'.amount', $product->bulk_options[$i]['amount'] ?? '') }}" placeholder="Qty">
                                <input type="number" name="bulk_options[{{ $i }}][price]" step="0.01" class="form-input" style="font-size: 12px;" value="{{ old('bulk_options.'.$i.'.price', $product->bulk_options[$i]['price'] ?? '') }}" placeholder="Price/Unit">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 25px; background: var(--dm-card-bg); border-radius: 8px; border: 1px solid var(--dm-border-color); margin-bottom: 50px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 40px;">Update Listing</button>
                <a href="{{ route('vendor.my-products') }}" class="btn btn-secondary">Discard Changes</a>
            </div>
        </form>
    </div>
</div>
@endsection
