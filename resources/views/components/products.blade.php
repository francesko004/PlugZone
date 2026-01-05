@props([
    'products'  // Required: collection of products
])

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">
    @foreach($products as $product)
        <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 100%; border: 1px solid var(--dm-border-color); position: relative;" onmouseover="this.style.borderColor='#666'" onmouseout="this.style.borderColor='var(--dm-border-color)'">
            @auth
                <form action="{{ Auth::user()->hasWishlisted($product->id) 
                    ? route('wishlist.destroy', $product) 
                    : route('wishlist.store', $product) }}" 
                    method="POST"
                    style="position: absolute; top: 12px; right: 12px; z-index: 10;">
                    @csrf
                    @if(Auth::user()->hasWishlisted($product->id))
                        @method('DELETE')
                    @endif
                    <button type="submit" 
                            style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.2); border-radius: 50%; width: 34px; height: 34px; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); transition: all 0.2s;"
                            title="{{ Auth::user()->hasWishlisted($product->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
                            onmouseover="this.style.background='rgba(0,0,0,0.6)'; this.style.transform='scale(1.1)'"
                            onmouseout="this.style.background='rgba(0,0,0,0.4)'; this.style.transform='scale(1)'">
                        @if(Auth::user()->hasWishlisted($product->id))
                            <span style="color: #ff9900; font-size: 18px;">★</span>
                        @else
                            <span style="font-size: 18px;">☆</span>
                        @endif
                    </button>
                </form>
            @endauth

            <a href="{{ route('products.show', $product->slug) }}" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                <!-- Image Container -->
                <div style="background: white; display: flex; align-items: center; justify-content: center; height: 200px; padding: 10px;">
                    <img src="{{ $product->product_picture_url }}" 
                         alt="{{ $product->name }}" 
                         style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
                
                <!-- Product Info -->
                <div style="padding: 15px; flex: 1; display: flex; flex-direction: column;">
                    <h3 style="margin: 0 0 8px 0; font-size: 15px; font-weight: 500; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px;">
                        {{ $product->name }}
                    </h3>

                    <!-- Ratings -->
                    <div style="display: flex; align-items: center; gap: 4px; margin-bottom: 8px;">
                        @if($product->getPositiveReviewPercentage() !== null)
                            <div style="display: flex; gap: 1px;">
                                @php $stars = floor($product->getPositiveReviewPercentage() / 20); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color: #f08804; font-size: 13px;">{{ $i <= $stars ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <span style="font-size: 12px; color: var(--link-color);">{{ number_format($product->getPositiveReviewPercentage(), 0) }}%</span>
                        @else
                            <span style="font-size: 12px; color: var(--dm-text-secondary);">New release</span>
                        @endif
                    </div>

                    <!-- Price -->
                    <div style="margin-bottom: 12px; display: flex; align-items: baseline; gap: 4px;">
                        <span style="font-size: 14px; transform: translateY(-4px);">$</span>
                        <span style="font-size: 24px; font-weight: 700;">{{ floor($product->price) }}</span>
                        <span style="font-size: 14px; transform: translateY(-4px);">{{ str_pad(round(($product->price - floor($product->price)) * 100), 2, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <!-- Badges / Info -->
                    <div style="margin-top: auto; display: flex; flex-direction: column; gap: 5px; font-size: 12px; color: var(--dm-text-secondary);">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Vendor:</span>
                            <span style="color: var(--link-color);">{{ $product->user->username }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Shipping:</span>
                            <span style="color: var(--dm-text-main);">{{ ucfirst($product->type) }}</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Action Area -->
            <div style="padding: 0 15px 15px;">
                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 20px;">View Details</a>
            </div>
        </div>
    @endforeach
</div>

@if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div style="margin-top: 40px; display: flex; justify-content: center;">
        {{ $products->links() }}
    </div>
@endif
