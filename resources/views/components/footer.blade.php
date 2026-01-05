<footer class="footer">
    <div style="max-width: 1500px; margin: 0 auto; padding: 40px 20px;">
        <!-- Footer Links Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-bottom: 30px;">
            <!-- Security Column -->
            <div>
                <h4 style="color: var(--dm-text-main); font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">Security</h4>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('pgp-key') }}" class="footer-link">PGP Key</a>
                    <a href="{{ route('canary') }}" class="footer-link">Warrant Canary</a>
                </div>
            </div>
            
            <!-- Help Column -->
            <div>
                <h4 style="color: var(--dm-text-main); font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">Help</h4>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @auth
                        <a href="{{ route('support.create') }}" class="footer-link">Contact Support</a>
                    @endauth
                    <a href="{{ route('guides.index') }}" class="footer-link">User Guides</a>
                </div>
            </div>
            
            <!-- Marketplace Column -->
            <div>
                <h4 style="color: var(--dm-text-main); font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">Marketplace</h4>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('products.index') }}" class="footer-link">Browse Products</a>
                    <a href="{{ route('vendors.index') }}" class="footer-link">Vendor Directory</a>
                    @guest
                        <a href="{{ route('become-vendor.index') }}" class="footer-link">Become a Vendor</a>
                    @endguest
                </div>
            </div>
            
            <!-- Market Info Column -->
            <div>
                <h4 style="color: var(--dm-text-main); font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">Market Info</h4>
                <div style="font-size: 14px; color: var(--dm-text-secondary);">
                    <div style="margin-bottom: 8px;">
                        <strong style="color: var(--dm-text-main);">XMR/USD:</strong>
                        @php
                            $xmrPrice = app(App\Http\Controllers\XmrPriceController::class)->getXmrPrice();
                        @endphp
                        <span style="color: {{ $xmrPrice === 'UNAVAILABLE' ? '#f59e0b' : '#10b981' }}; font-weight: 600;">
                            @if($xmrPrice !== 'UNAVAILABLE')
                                ${{ $xmrPrice }}
                            @else
                                {{ $xmrPrice }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="divider"></div>
        
        <!-- JavaScript Warning -->
        @if(config('marketplace.show_javascript_warning'))
            <div class="js-warning-elements" style="display: none; align-items: center; justify-content: center; gap: 10px; background: var(--color-warning-bg); padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid var(--color-warning);">
                <span style="font-size: 20px;">⚠️</span>
                <span style="color: var(--color-warning-light); font-weight: 600; font-size: 13px;">Please Disable JavaScript for Maximum Security</span>
            </div>
        @endif
        
        <!-- Copyright -->
        <div style="text-align: center; font-size: 12px; color: var(--dm-text-secondary);">
            <p style="margin: 0;">&copy; {{ date('Y') }} PlugZone. All rights reserved.</p>
            <p style="margin: 5px 0 0 0;">Strictly for educational and research purposes only.</p>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <a href="#top" style="display: block; background-color: var(--dm-border-color); color: var(--dm-text-main); text-align: center; padding: 15px; text-decoration: none; font-size: 13px; font-weight: 600; transition: background-color 0.2s;">
        ↑ Back to top
    </a>
</footer>

@if(config('marketplace.show_javascript_warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.js-warning-elements').forEach(function(element) {
                element.style.display = 'flex';
            });
        });
    </script>
@endif
