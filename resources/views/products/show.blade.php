@extends('layouts.app')

@section('content')

<div class="product-page">
    @if($vendor_on_vacation)
        <div class="alert alert-error">
            <h2>Product Currently Unavailable</h2>
            <p>This product is temporarily unavailable as the vendor is currently on vacation. Please check back later.</p>
        </div>
    @elseif(isset($vendor_shop_private) && $vendor_shop_private)
        <div class="alert alert-error">
            <h2>Private Shop</h2>
            <p>This product is only available to users who have saved the vendor's reference code.</p>
        </div>
    @else
        <div class="product-details-grid">
            {{-- Left: Images --}}
            <div class="product-images">
                <img src="{{ $product->product_picture_url }}" alt="{{ $product->name }}" class="product-image-large">
                
                @if(!empty($product->additional_photos))
                    <div style="display: flex; gap: 10px; margin-top: 10px; overflow-x: auto;">
                         @foreach($product->additional_photos_urls as $photoUrl)
                            <img src="{{ $photoUrl }}" style="height: 60px; width: 60px; object-fit: cover; border: 1px solid var(--border-color); cursor: pointer;">
                         @endforeach
                    </div>
                @endif
            </div>

            {{-- Center: Product Info --}}
            <div class="product-info">
                 <h1 style="font-size: 24px; font-weight: 500; margin-top: 0;">{{ $product->name }}</h1>
                 
                 <div style="margin-bottom: 20px;">
                    <a href="{{ route('vendors.show', $product->user->username) }}" style="color: var(--link-color);">Visit {{ $product->user->username }}'s Store</a>
                 </div>

                 <div style="border-top: 1px solid var(--border-color); padding-top: 20px; margin-top: 20px;">
                     <h3>About this item</h3>
                     <div style="white-space: pre-wrap; font-size: 14px;">{!! nl2br(e($product->description)) !!}</div>
                 </div>

                 {{-- Reviews Section --}}
                 <div style="margin-top: 40px;">
                     <h3 style="font-size: 20px; margin-bottom: 15px;">Customer Reviews</h3>
                     @if($totalReviews > 0)
                        <div style="margin-bottom: 20px; padding: 15px; background-color: var(--dm-page-bg); border-radius: 4px;">
                            <div style="font-size: 24px; font-weight: 700; color: var(--color-success-light);">{{ number_format($positivePercentage, 1) }}%</div>
                            <div style="font-size: 14px; color: var(--dm-text-secondary);">{{ $totalReviews }} {{ $totalReviews == 1 ? 'rating' : 'ratings' }}</div>
                        </div>
                        
                        @foreach($reviews as $review)
                            <div class="card" style="margin-bottom: 15px; padding: 15px;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <div style="font-weight: 600; font-size: 14px;">{{ $review->user->username }}</div>
                                    <div style="font-size: 12px; color: var(--dm-text-secondary);">{{ $review->getFormattedDate() }}</div>
                                     @if($review->sentiment == 'positive')
                                        <span class="badge badge-success">Positive</span>
                                     @elseif($review->sentiment == 'negative')
                                        <span class="badge badge-danger">Negative</span>
                                     @else
                                        <span class="badge badge-neutral">Neutral</span>
                                     @endif
                                </div>
                                <div style="font-size: 14px; line-height: 1.6;">{{ $review->review_text }}</div>
                            </div>
                        @endforeach
                     @else
                        <p style="color: var(--dm-text-secondary); font-style: italic;">No reviews yet. Be the first to review this product!</p>
                     @endif
                 </div>
            </div>

            {{-- Right: Buy Box --}}
            <div class="buy-box">
                <div class="divider-text" style="margin: 0 0 15px 0; font-size: 12px;">BUY NEW</div>
                
                <div style="font-size: 28px; color: #B12704; font-weight: 400; margin-bottom: 5px;">
                    ${{ number_format($product->price, 2) }}
                </div>
                @if(is_numeric($xmrPrice))
                    <div style="color: var(--dm-text-secondary); font-size: 14px; margin-bottom: 15px;">
                        ≈ ɱ{{ number_format($xmrPrice, 4) }} XMR
                    </div>
                @endif

                <div style="font-size: 18px; color: #007600; margin-bottom: 15px;">✓ In Stock</div>

                <div style="margin-bottom: 20px; padding: 12px; background-color: var(--dm-page-bg); border-radius: 4px; font-size: 13px;">
                     <div style="margin-bottom: 6px;"><strong>Ships from:</strong> {{ $product->ships_from }}</div>
                     <div><strong>Ships to:</strong> {{ $product->ships_to }}</div>
                </div>

                @if(Auth::id() === $product->user_id)
                    <div class="alert alert-info" style="font-size: 13px;">You own this product listing.</div>
                @else
                    <form action="{{ route('cart.store', $product) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Delivery Option</label>
                            <select name="delivery_option" required class="form-select">
                                @foreach($formattedDeliveryOptions as $index => $option)
                                    <option value="{{ $index }}">
                                        {{ $option['description'] }} - {{ $option['price'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <select name="quantity" class="form-select">
                                @for($i=1; $i<=30; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                <option value="custom">30+ (Specify in Cart)</option> 
                            </select>
                        </div>
                        
                        @if($product->bulk_options && count($product->bulk_options) > 0)
                         <div class="form-group">
                            <label class="form-label">Bulk Discount</label>
                            <select name="bulk_option" class="form-select">
                                <option value="">None</option>
                                @foreach($formattedBulkOptions as $index => $option)
                                    <option value="{{ $index }}">{{ $option['display_text'] }}</option>
                                @endforeach
                            </select>
                         </div>
                        @endif

                        <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-bottom: 10px; border-radius: 20px;">Add to Cart</button>
                    </form>
                @endif
                
                <div class="divider"></div>
                
                <div style="display: flex; flex-direction: column; gap: 10px;">
                     @if(Auth::user()->hasWishlisted($product->id))
                        <form action="{{ route('wishlist.destroy', $product) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-secondary btn-block">♥ Remove from Wishlist</button>
                        </form>
                     @else
                        <form action="{{ route('wishlist.store', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-block">♡ Add to Wishlist</button>
                        </form>
                     @endif
                     
                     <a href="{{ route('messages.create', ['username' => $product->user->username]) }}" class="btn btn-secondary btn-block">✉ Message Vendor</a>
                </div>
            </div>
        </div>
        
        {{-- Vendor Policy --}}
        @if($product->user->vendorProfile && $product->user->vendorProfile->vendor_policy)
            <div class="card" style="margin-top: 30px;">
                <h3>Vendor Policy</h3>
                <div style="font-size: 14px;">{!! nl2br(e($product->user->vendorProfile->vendor_policy)) !!}</div>
            </div>
        @endif
    @endif
</div>
@endsection
