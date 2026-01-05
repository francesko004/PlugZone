<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('images/plugzone.png') }}" alt="PlugZone" style="height: 35px;">
        </a>
    </div>

    <div class="nav-search">
        <form action="{{ route('products.index') }}" method="GET" style="display: flex; width: 100%;">
            <input type="text" 
                   name="search" 
                   placeholder="Search products, vendors..." 
                   value="{{ request('search') }}"
                   aria-label="Search">
            <button type="submit" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>
        </form>
    </div>

    <div class="navbar-right">
        <button id="theme-toggle" aria-label="Toggle theme" style="background: none; border: 1px solid rgba(255,255,255,0.3); padding: 8px 12px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; gap: 8px; color: white; font-size: 13px; transition: all 0.2s;">
            <span id="theme-icon" style="font-size: 18px;">🌙</span>
            <span id="theme-text" style="font-weight: 600;">Dark</span>
        </button>
        
        @auth
            <a href="{{ route('dashboard') }}" class="nav-link">
                <div style="font-size: 12px; line-height: 1.2;">Hello, {{ auth()->user()->username }}</div>
                <div style="font-weight: 700; font-size: 14px;">Account & Lists</div>
            </a>

            <a href="{{ route('orders.index') }}" class="nav-link">
                <div style="font-size: 12px; line-height: 1.2;">Returns</div>
                <div style="font-weight: 700; font-size: 14px;">& Orders</div>
            </a>

            <a href="{{ route('cart.index') }}" class="nav-link" style="display: flex; align-items: center; gap: 8px;">
                <div style="position: relative;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="filter: invert(1);">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    @if(auth()->user()->cartItems()->count() > 0)
                        <span style="position: absolute; top: -5px; right: -8px; background: #F08804; color: #111; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px;">{{ auth()->user()->cartItems()->count() }}</span>
                    @endif
                </div>
                <span style="font-weight: 700; font-size: 14px;">Cart</span>
            </a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 13px; border-color: #fff; color: #fff;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-link">
                <div style="font-size: 12px; line-height: 1.2;">Hello, Sign in</div>
                <div style="font-weight: 700; font-size: 14px;">Account & Lists</div>
            </a>
            
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px; margin-left: 10px;">Register</a>
        @endauth
    </div>
</nav>
