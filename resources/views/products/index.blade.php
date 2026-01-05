@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="card" style="margin-bottom: 30px; padding: 20px; background-color: var(--dm-card-bg);">
        <form action="{{ route('products.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label" for="search">Search Products</label>
                    <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search title... 🔎" class="form-input">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="vendor">By Vendor</label>
                    <input type="text" name="vendor" id="vendor" value="{{ $filters['vendor'] ?? '' }}" placeholder="Vendor name... 🔎" class="form-input">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label class="form-label" for="type">Product Type</label>
                    <select name="type" id="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="digital" {{ ($currentType === 'digital') ? 'selected' : '' }}>Digital</option>
                        <option value="cargo" {{ ($currentType === 'cargo') ? 'selected' : '' }}>Cargo</option>
                        <option value="deaddrop" {{ ($currentType === 'deaddrop') ? 'selected' : '' }}>Dead Drop</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="category">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($filters['category'] ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sort_price">Sort by Price</label>
                    <select name="sort_price" id="sort_price" class="form-select">
                        <option value="">Most Recent</option>
                        <option value="asc" {{ ($filters['sort_price'] ?? '') === 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="desc" {{ ($filters['sort_price'] ?? '') === 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset Filters</a>
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>

    @if($products->isEmpty())
        <div class="card" style="padding: 60px 40px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🔍</div>
            <h2 style="font-size: 24px; font-weight: 400; margin: 0 0 10px 0;">No products found</h2>
            <p style="color: var(--dm-text-secondary); margin: 0 0 30px 0;">Try adjusting your filters or search terms</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                View All Products
            </a>
        </div>
    @else
        <div style="margin-bottom: 20px; font-size: 14px; color: var(--dm-text-secondary);">
            Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results
        </div>
        <x-products 
            :products="$products"
        />
    @endif
</div>

@endsection
