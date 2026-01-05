@extends('layouts.app')

@section('content')

<div class="main-content">
    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 20px; color: var(--dm-text-main);">Shopping Cart</h1>
    
    @if($cartItems->isEmpty())
        <div class="card" style="padding: 60px 40px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🛒</div>
            <h2 style="font-size: 24px; font-weight: 400; margin: 0 0 10px 0;">Your cart is empty</h2>
            <p style="color: var(--dm-text-secondary); margin: 0 0 30px 0;">Add items to get started</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                Browse Products
            </a>
        </div>
    @else
        <div class="cart-layout">
            {{-- Main Cart Items Area --}}
            <div class="cart-items">
                <div class="card" style="padding: 0;">
                    @foreach($cartItems as $item)
                        <div style="padding: 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; gap: 20px;">
                            {{-- Image --}}
                            <div style="width: 150px; flex-shrink: 0;">
                                <img src="{{ $item->product->product_picture_url }}" alt="{{ $item->product->name }}" style="width: 100%; object-fit: contain;">
                            </div>
                            
                            {{-- Details --}}
                            <div style="flex: 1;">
                                <h3 style="margin-top: 0; font-size: 18px;">
                                    <a href="{{ route('products.show', $item->product) }}" style="color: var(--link-color);">{{ $item->product->name }}</a>
                                </h3>
                                <div style="font-size: 12px; color: #007600;">In Stock</div>
                                <div style="font-size: 12px; color: var(--dm-text-secondary);">Sold by: {{ $item->product->user->username }}</div>
                                
                                <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" style="display: flex; gap: 5px;">
                                        @csrf @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="80000" style="width: 60px; padding: 5px;">
                                        <button type="submit" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px;">Update</button>
                                    </form>
                                    |
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: var(--link-color); cursor: pointer; padding: 0;">Delete</button>
                                    </form>
                                </div>
                                
                                @if($item->encrypted_message)
                                    <div style="margin-top: 10px; background: #333; padding: 10px; font-size: 12px; border-radius: 4px;">
                                        <strong>Encrypted Message Attached</strong>
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Price --}}
                            <div style="text-align: right; font-weight: bold; font-size: 18px;">
                                ${{ number_format($item->getTotalPrice(), 2) }}
                            </div>
                        </div>
                    @endforeach
                    
                    {{-- Shared Message Form (if applicable) --}}
                     @php
                        $hasEncryptedMessage = $cartItems->contains(function($item) {
                            return $item->encrypted_message;
                        });
                        $firstItem = $cartItems->first();
                    @endphp

                    @if(!$hasEncryptedMessage && $firstItem)
                        <div style="padding: 20px; background-color: var(--dm-card-bg);">
                            <form action="{{ route('cart.message.save', $firstItem) }}" method="POST">
                                @csrf
                                <label style="display: block; font-weight: 700; margin-bottom: 5px;">Optional Message (Auto-Encrypted):</label>
                                <textarea name="message" style="width: 100%; height: 80px; padding: 10px; background: var(--dm-page-bg); border: 1px solid var(--dm-border-color); color: var(--dm-text-main);" placeholder="Enter message for vendor..."></textarea>
                                <button type="submit" class="btn btn-secondary" style="margin-top: 10px;">Save Message</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Sidebar Summary --}}
            <div class="cart-summary">
                <div style="font-size: 18px; margin-bottom: 20px;">
                    Subtotal ({{ $cartItems->sum('quantity') }} items): <span style="font-weight: bold;">${{ number_format($cartTotal, 2) }}</span>
                </div>
                
                 @if(is_numeric($xmrTotal))
                    <div style="margin-bottom: 20px; font-size: 14px; color: var(--dm-text-secondary);">
                        ≈ ɱ{{ number_format($xmrTotal, 4) }}
                    </div>
                @endif
                
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary" style="width: 100%; display: block; margin-bottom: 10px; border-radius: 8px;">Proceed to Checkout</a>
                
                <form action="{{ route('cart.clear') }}" method="POST">
                     @csrf @method('DELETE')
                     <button type="submit" class="btn btn-secondary" style="width: 100%; border-radius: 8px;">Clear Cart</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
