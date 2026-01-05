@extends('layouts.app')

@section('content')

<div class="main-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">{{ $title }}</h1>
        @if(!$products->isEmpty())
            <form action="{{ route('wishlist.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure you want to clear your wishlist?')">
                    Clear Wishlist
                </button>
            </form>
        @endif
    </div>

    @if($products->isEmpty())
        <div class="card" style="padding: 60px 40px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">♥</div>
            <h2 style="font-size: 24px; font-weight: 400; margin: 0 0 10px 0;">Your wishlist is empty</h2>
            <p style="color: var(--dm-text-secondary); margin: 0 0 30px 0;">Save items you're interested in for later</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                Browse Products
            </a>
        </div>
    @else
        <x-products 
            :products="$products"
        />
    @endif
</div>
@endsection


