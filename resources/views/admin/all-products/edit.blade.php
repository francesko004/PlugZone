@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.all-products') }}">Catalog</a>
        <span>›</span>
        <span>Edit Listing</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Edit Global Listing</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Modify product parameters, moderate content, or adjust fulfillment options.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-secondary btn-sm" target="_blank">Preview Public Page</a>
            <a href="{{ route('admin.all-products') }}" class="btn btn-outline btn-sm">Return to Catalog</a>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            <!-- Left Column: Product Details -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                
                <!-- Visibility & Global Status -->
                <div class="card" style="padding: 30px; border-left: 4px solid {{ $product->active ? '#007185' : '#ff4444' }};">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px;">Global Offering Status</h3>
                    <div style="display: flex; align-items: center; gap: 20px; background: rgba(255, 255, 255, 0.02); padding: 20px; border-radius: 8px;">
                        <input type="checkbox" name="active" value="1" {{ $product->active ? 'checked' : '' }} style="width: 24px; height: 24px; accent-color: #ff9900; cursor: pointer;">
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">Listing is Active</div>
                            <p style="margin: 5px 0 0 0; font-size: 13px; color: var(--dm-text-secondary);">When disabled, this product is immediately hidden from all marketplace search results and categories.</p>
                        </div>
                    </div>
                </div>

                <!-- Product Assets -->
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Listing Assets</h3>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                        <!-- Main Image -->
                        <div style="position: relative; width: 140px; height: 140px; border: 1px solid var(--dm-border-color); border-radius: 4px; overflow: hidden; background: #fff;">
                            <img src="{{ $product->product_picture_url }}" style="width: 100%; height: 100%; object-fit: contain;">
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; font-size: 10px; padding: 4px; text-align: center; font-weight: 700;">MAIN ASSET</div>
                        </div>

                        <!-- Additional -->
                        @foreach($product->additional_photos_urls as $index => $photoUrl)
                            <div style="position: relative; width: 140px; height: 140px; border: 1px solid var(--dm-border-color); border-radius: 4px; overflow: hidden; background: #fff;">
                                <img src="{{ $photoUrl }}" style="width: 100%; height: 100%; object-fit: contain;">
                                <button type="submit" name="delete_additional_photo" value="{{ $index }}" style="position: absolute; top: 5px; right: 5px; background: #ff4444; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center;">✕</button>
                            </div>
                        @endforeach
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 20px; background: rgba(255, 255, 255, 0.03); border-radius: 8px;">
                        <div>
                            <label class="form-label">Replace Primary Photo</label>
                            <input type="file" name="product_picture" class="form-input" style="font-size: 12px; padding: 5px;">
                        </div>
                        <div>
                            <label class="form-label">Add Supplementary Photos</label>
                            <input type="file" name="additional_photos[]" multiple class="form-input" style="font-size: 12px; padding: 5px;">
                        </div>
                    </div>
                </div>

                <!-- Core Information -->
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Offer Information</h3>
                    
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label class="form-label">Global Listing Title</label>
                        <input type="text" name="name" class="form-input" style="font-size: 20px; font-weight: 700;" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label class="form-label">Authoritative Description</label>
                        <textarea name="description" class="form-input" rows="8" style="font-family: inherit; line-height: 1.6;" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                        <div class="form-group">
                            <label class="form-label">Price (USD Equiv.)</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 15px; top: 12px; color: var(--dm-text-secondary);">$</span>
                                <input type="number" name="price" class="form-input" style="padding-left: 30px;" step="0.01" value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Classification / Department</label>
                            <select name="category_id" class="form-input" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach($category->children as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ old('category_id', $product->category_id) == $subcategory->id ? 'selected' : '' }}>-- {{ $subcategory->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Fulfillment Options -->
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Fulfillment & Logistics</h3>
                    
                    @for ($i = 0; $i < 4; $i++)
                        <div style="background: rgba(255, 255, 255, 0.02); padding: 20px; border: 1px solid var(--dm-border-color); border-radius: 8px; margin-bottom: 15px;">
                            <div style="font-weight: 700; font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 15px; text-transform: uppercase;">Service Level {{ $i + 1 }}</div>
                            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                                <div class="form-group">
                                    <label class="form-label">Service Description</label>
                                    <input type="text" name="delivery_options[{{ $i }}][description]" class="form-input" placeholder="e.g. Premium Anonymous Courier" value="{{ old('delivery_options.'.$i.'.description', $product->delivery_options[$i]['description'] ?? '') }}" {{ $i === 0 ? 'required' : '' }}>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Surcharge (USD)</label>
                                    <input type="number" name="delivery_options[{{ $i }}][price]" class="form-input" step="0.01" value="{{ old('delivery_options.'.$i.'.price', $product->delivery_options[$i]['price'] ?? '') }}" {{ $i === 0 ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Right Column: Metadata & Controls -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Audit Summary</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Listing ID:</span>
                            <span style="font-family: monospace;">{{ $product->id }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Market Type:</span>
                            <span style="font-weight: 700;">{{ strtoupper($product->type) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Owner:</span>
                            <span style="font-weight: 700; color: #ff9900;">{{ $product->user->username }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--dm-border-color); padding-top: 15px;">
                            <span style="color: var(--dm-text-secondary);">Added:</span>
                            <span>{{ $product->created_at->format('Y-m-d') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Last Updated:</span>
                            <span>{{ $product->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Inventory Management</h3>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Authoritative Stock</label>
                        <input type="number" name="stock_amount" class="form-input" value="{{ old('stock_amount', $product->stock_amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Unit of Measure</label>
                        <select name="measurement_unit" class="form-input" required>
                            @foreach($measurementUnits as $value => $label)
                                <option value="{{ $value }}" {{ old('measurement_unit', $product->measurement_unit) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; height: 50px; font-size: 16px; font-weight: 700;">Commit All Changes</button>
                    <a href="{{ route('admin.all-products') }}" class="btn btn-outline" style="width: 100%; text-align: center;">Discard Updates</a>
                </div>

                <div class="card" style="padding: 20px; background: rgba(255, 68, 68, 0.05); border: 1px solid rgba(255, 68, 68, 0.2);">
                    <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: #ff4444;">Administrative Moderation</h4>
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin: 0; line-height: 1.5;">Changes made here bypass standard vendor controls. All administrative edits are permanently recorded in the moderation audit logs.</p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
