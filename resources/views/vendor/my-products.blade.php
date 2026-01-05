@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Vendor Dashboard</a>
        <span>›</span>
        <span>My Inventory</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">My Products</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('vendor.products.create', 'digital') }}" class="btn btn-secondary btn-sm">Add Digital</a>
            <a href="{{ route('vendor.products.create', 'cargo') }}" class="btn btn-secondary btn-sm">Add Cargo</a>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">Your inventory is empty</h2>
            <p style="color: var(--dm-text-secondary); max-width: 400px; margin: 0 auto; margin-bottom: 25px;">Start listing your products to reach customers on PlugZone.</p>
            <a href="{{ route('vendor.index') }}" class="btn btn-primary">Go to Vendor Dashboard</a>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 20px;">
            @foreach($products as $product)
                <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                    <div style="padding: 20px; flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                            <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 3px 8px; border-radius: 4px; background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary);">
                                {{ $product->type === 'deaddrop' ? 'Dead Drop' : ucfirst($product->type) }}
                            </span>
                            @if($product->is_advertised)
                                <span style="font-size: 11px; font-weight: 700; color: #ff9900; background: rgba(255, 153, 0, 0.1); padding: 3px 8px; border-radius: 4px; border: 1px solid #ff9900;">
                                    ADVERTISED
                                </span>
                            @endif
                        </div>
                        <h3 style="margin: 0 0 15px 0; font-size: 18px; font-weight: 700; line-height: 1.4;">
                            <a href="{{ route('products.show', $product->slug) }}" style="color: var(--link-color); text-decoration: none;">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <div style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 5px;">
                            Last updated: {{ $product->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div style="background: rgba(0, 0, 0, 0.1); padding: 15px 20px; border-top: 1px solid var(--dm-border-color); display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="{{ route('vendor.products.edit', $product) }}" class="btn btn-outline btn-sm">Edit Product</a>
                        
                        @if(!$product->is_advertised)
                            <a href="{{ route('vendor.advertisement.create', $product) }}" class="btn btn-secondary btn-sm" style="background: #232f3e; border-color: #3a4553;">Advertise</a>
                        @endif

                        <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" style="margin-left: auto;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" style="color: #ff4444; border-color: rgba(255, 68, 68, 0.2);" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 30px;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
