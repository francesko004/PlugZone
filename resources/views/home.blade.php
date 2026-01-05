@extends('layouts.app')

@section('content')

@if($popup)
<input type="checkbox" id="pop-up-toggle" checked style="display:none;">
<div class="modal-overlay">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3 class="modal-title">{{ $popup->title }}</h3>
            <label for="pop-up-toggle" class="modal-close" style="cursor: pointer;">&times;</label>
        </div>
        <div class="modal-body">
            <p>{{ $popup->message }}</p>
        </div>
        <div class="modal-footer">
            <label for="pop-up-toggle" class="btn btn-primary" style="cursor: pointer;">Acknowledge & Continue</label>
        </div>
    </div>
</div>
@endif

<div class="main-content">
    @if(count($adSlots) > 0)
        <div class="card" style="margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 700; margin: 0 0 20px 0; color: var(--dm-text-main);">
                <span style="color: var(--dm-primary-btn);">⭐</span> Featured Products
            </h2>
            <div class="product-grid">
                @for($i = 1; $i <= 8; $i++)
                    @if(isset($adSlots[$i]))
                        <a href="{{ route('products.show', $adSlots[$i]['product']) }}" style="text-decoration: none;">
                            <div class="product-card" style="transition: transform 0.2s, box-shadow 0.2s; height: 100%;">
                                <img src="{{ $adSlots[$i]['product']->product_picture_url }}" 
                                     alt="{{ $adSlots[$i]['product']->name }}"
                                     class="product-image">
                                
                                <h3 class="product-title" style="min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $adSlots[$i]['product']->name }}
                                </h3>
                                
                                <div class="product-price" style="margin: 10px 0;">
                                    ${{ number_format($adSlots[$i]['product']->price, 2) }}
                                    @if($adSlots[$i]['xmr_price'] !== null)
                                        <small style="display:block; margin-top: 4px;">≈ ɱ{{ number_format($adSlots[$i]['xmr_price'], 4) }}</small>
                                    @endif
                                </div>

                                <div style="font-size: 12px; color: var(--dm-text-secondary); margin-top: auto;">
                                    <div style="margin-bottom: 4px;">
                                        <strong>Vendor:</strong> {{ $adSlots[$i]['vendor']->username }}
                                    </div>
                                    <div>
                                        <strong>Ships:</strong> {{ $adSlots[$i]['product']->ships_from }} → {{ $adSlots[$i]['product']->ships_to }}
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block" style="margin-top: 15px;">View Product</button>
                            </div>
                        </a>
                    @endif
                @endfor
            </div>
        </div>
    @endif

    @if(count($featuredProducts) > 0)
        <div class="card">
            <h2 style="font-size: 24px; font-weight: 700; margin: 0 0 20px 0; color: var(--dm-text-main);">
                Recently Listed
            </h2>
            <div class="product-grid">
                @foreach($featuredProducts as $featured)
                    <a href="{{ route('products.show', $featured['product']) }}" style="text-decoration: none;">
                        <div class="product-card" style="transition: transform 0.2s, box-shadow 0.2s; height: 100%;">
                            <img src="{{ $featured['product']->product_picture_url }}" 
                                 alt="{{ $featured['product']->name }}"
                                 class="product-image">
                            
                            <h3 class="product-title" style="min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $featured['product']->name }}
                            </h3>
                            
                            <div class="product-price" style="margin: 10px 0;">
                                ${{ number_format($featured['product']->price, 2) }}
                                @if($featured['xmr_price'] !== null)
                                    <small style="display:block; margin-top: 4px;">≈ ɱ{{ number_format($featured['xmr_price'], 4) }}</small>
                                @endif
                            </div>

                            <div style="font-size: 12px; color: var(--dm-text-secondary); margin-top: auto;">
                                <div style="margin-bottom: 4px;">
                                    <strong>Vendor:</strong> {{ $featured['vendor']->username }}
                                </div>
                                <div>
                                    <strong>Ships:</strong> {{ $featured['product']->ships_from }} → {{ $featured['product']->ships_to }}
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block" style="margin-top: 15px;">View Product</button>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($adSlots) === 0 && count($featuredProducts) === 0)
    <div class="card" style="text-align:center; padding: 60px 40px;">
        <h1 style="color: var(--dm-text-main); font-size: 32px; margin: 0 0 15px 0;">Welcome to PlugZone</h1>
        <p style="color: var(--dm-text-secondary); font-size: 16px; margin: 0 0 30px 0;">Your trusted darknet marketplace.</p>
        
        <div style="max-width: 600px; margin: 0 auto; text-align: left;">
            <div class="alert alert-info">
                <strong>🔒 Security Reminder:</strong>
                <p style="margin: 8px 0 0 0;">Always verify PGP signatures and use Tor for maximum anonymity.</p>
            </div>
            
            <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: center;">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-secondary">Create Account</a>
                @endguest
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
