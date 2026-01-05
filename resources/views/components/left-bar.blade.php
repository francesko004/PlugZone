<div class="sidebar">
    <!-- Shop Section -->
    <div style="padding: 10px 15px; font-size: 14px; font-weight: 700; color: #fff; border-bottom: 1px solid var(--dm-border-color); margin-bottom: 10px;">
        SHOP
    </div>
    <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
        <li style="margin-bottom: 2px;">
            <a href="{{ route('products.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('products.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('products.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('products.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('products.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                All Products
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('wishlist.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('wishlist.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('wishlist.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('wishlist.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('wishlist.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Your Wishlist
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('orders.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('orders.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('orders.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('orders.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('orders.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Your Orders
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('vendors.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('vendors.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('vendors.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('vendors.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('vendors.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Browse Vendors
            </a>
        </li>
    </ul>

    <!-- Account Section -->
    <div style="padding: 10px 15px; font-size: 14px; font-weight: 700; color: #fff; border-bottom: 1px solid var(--dm-border-color); margin-bottom: 10px;">
        ACCOUNT
    </div>
    <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
        <li style="margin-bottom: 2px;">
            <a href="{{ route('dashboard') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('dashboard') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('dashboard') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('dashboard') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('dashboard') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Account Home
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('messages.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('messages.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('messages.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('messages.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('messages.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Message Center
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('settings') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('settings') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('settings') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('settings') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('settings') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Security Settings
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('profile') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('profile') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('profile') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('profile') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('profile') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Your Profile
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('disputes.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('disputes.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('disputes.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('disputes.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('disputes.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Resolution Center
            </a>
        </li>
        <li style="margin-bottom: 2px;">
            <a href="{{ route('support.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: {{ request()->routeIs('support.*') ? '#ff9900' : 'var(--dm-text-main)' }}; text-decoration: none; border-left: 3px solid {{ request()->routeIs('support.*') ? '#ff9900' : 'transparent' }}; background: {{ request()->routeIs('support.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }};" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='{{ request()->routeIs('support.*') ? 'rgba(255, 153, 0, 0.1)' : 'transparent' }}'">
                Help & Support
            </a>
        </li>
    </ul>

    <!-- Admin/Vendor Section -->
    @if(auth()->user()->isAdmin() || auth()->user()->isVendor())
    <div style="padding: 10px 15px; font-size: 14px; font-weight: 700; color: #ff9900; border-bottom: 1px solid var(--dm-border-color); margin-bottom: 10px;">
        MANAGEMENT
    </div>
    <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
        @if(auth()->user()->isVendor())
        <li style="margin-bottom: 2px;">
            <a href="{{ route('vendor.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: var(--dm-text-main); text-decoration: none; border-left: 3px solid transparent;" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='transparent'">
                Vendor Dashboard
            </a>
        </li>
        @else
        <li style="margin-bottom: 2px;">
            <a href="{{ route('become.vendor') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: var(--dm-text-main); text-decoration: none; border-left: 3px solid transparent;" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='transparent'">
                Start Selling
            </a>
        </li>
        @endif
        
        @if(auth()->user()->isAdmin())
        <li style="margin-bottom: 2px;">
            <a href="{{ route('admin.index') }}" style="display: block; padding: 8px 15px; font-size: 13px; color: var(--dm-text-main); text-decoration: none; border-left: 3px solid transparent;" onmouseover="this.style.background='rgba(255,153,0,0.05)'" onmouseout="this.style.background='transparent'">
                Marketplace Admin
            </a>
        </li>
        @endif
    </ul>
    @endif
</div>
