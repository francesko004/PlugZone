@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Catalog Management</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Global Inventory Catalog</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Manage and moderate all product listings across the platform.</p>
    </div>

    <!-- Advanced Filter Console -->
    <div class="card" style="padding: 25px; margin-bottom: 30px;">
        <form action="{{ route('admin.all-products') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: flex-end;">
                <div class="form-group">
                    <label class="form-label">Vendor ID/Name</label>
                    <input type="text" name="vendor" class="form-input" value="{{ $filters['vendor'] ?? '' }}" placeholder="Filter by seller...">
                </div>

                <div class="form-group">
                    <label class="form-label">Classification</label>
                    <select name="type" class="form-input">
                        <option value="">All Types</option>
                        <option value="digital" {{ ($currentType === 'digital') ? 'selected' : '' }}>Digital Goods</option>
                        <option value="cargo" {{ ($currentType === 'cargo') ? 'selected' : '' }}>Cargo (Physical)</option>
                        <option value="deaddrop" {{ ($currentType === 'deaddrop') ? 'selected' : '' }}>Dead Drop</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Department</label>
                    <select name="category" class="form-input">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($filters['category'] ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Keyword Search</label>
                    <input type="text" name="search" class="form-input" value="{{ $filters['search'] ?? '' }}" placeholder="Search titles...">
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary btn-sm" style="flex: 1;">Refine Results</button>
                    <a href="{{ route('admin.all-products') }}" class="btn btn-outline btn-sm">Clear</a>
                </div>
            </div>
        </form>
    </div>

    @if($products->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 15px;">🔍</div>
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">No Products Found</h2>
            <p style="color: var(--dm-text-secondary);">Try adjusting your filters to find what you're looking for.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">{{ $products->total() }} Products Listed</span>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: rgba(0,0,0,0.2); border-bottom: 1px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Product Detail</th>
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Owner</th>
                        <th style="text-align: center; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Type</th>
                        <th style="text-align: right; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 15px 20px;">
                                <a href="{{ route('products.show', $product->slug) }}" style="font-weight: 700; color: var(--link-color); text-decoration: none;">{{ Str::limit($product->name, 50) }}</a>
                                <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 4px;">Created {{ $product->created_at->format('Y-m-d') }}</div>
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="font-weight: 700;">{{ $product->user->username }}</span>
                                    @if($product->user->isVendor())
                                        <span style="font-size: 9px; padding: 1px 4px; border: 1px solid rgba(255,153,0,0.3); color: #ff9900; border-radius: 3px;">VENDOR</span>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 15px 20px; text-align: center;">
                                <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; border: 1px solid var(--dm-border-color); background: rgba(255,255,255,0.05);">
                                    {{ strtoupper($product->type) }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm" style="padding: 4px 12px;">Edit</a>
                                    
                                    @if($product->isFeatured())
                                        <form action="{{ route('admin.products.unfeature', $product) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-outline btn-sm" style="color: #ff9900; border-color: rgba(255,153,0,0.3);">Unfeature</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.products.feature', $product) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-outline btn-sm">Feature</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Archive this product listing permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="padding: 4px 12px;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $products->appends(request()->all())->links('components.pagination') }}
        </div>
    @endif
</div>
@endsection
