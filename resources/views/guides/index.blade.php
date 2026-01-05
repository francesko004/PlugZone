

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <span>Help Guides</span>
    </div>

    <div class="card" style="padding: 40px; margin-bottom: 30px; text-align: center; background: linear-gradient(135deg, #232f3e 0%, #0f1111 100%); color: white;">
        <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 10px;">PlugZone Help Center</h1>
        <p style="font-size: 16px; opacity: 0.8; max-width: 600px; margin: 0 auto;">Comprehensive documentation to help you navigate our secure marketplace with confidence.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        <!-- Monero Guide -->
        <a href="{{ route('guides.monero') }}" class="card" style="padding: 25px; text-decoration: none; color: inherit; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.borderColor='#ff9900'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='var(--dm-border-color)'; this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 15px;">💰</div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">Monero Guide</h3>
            <p style="font-size: 14px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 15px;">Learn how to set up your wallet, manage XMR, and conduct private transactions.</p>
            <span style="color: var(--link-color); font-size: 13px; font-weight: 700;">Read more ›</span>
        </a>

        <!-- Tor Guide -->
        <a href="{{ route('guides.tor') }}" class="card" style="padding: 25px; text-decoration: none; color: inherit; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.borderColor='#ff9900'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='var(--dm-border-color)'; this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 15px;">🧅</div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">Tor Guide</h3>
            <p style="font-size: 14px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 15px;">Information about Tor Browser configuration and best practices for operational security.</p>
            <span style="color: var(--link-color); font-size: 13px; font-weight: 700;">Read more ›</span>
        </a>

        <!-- KeePassXC Guide -->
        <a href="{{ route('guides.keepassxc') }}" class="card" style="padding: 25px; text-decoration: none; color: inherit; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.borderColor='#ff9900'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='var(--dm-border-color)'; this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 15px;">🔐</div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">KeePassXC Guide</h3>
            <p style="font-size: 14px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 15px;">Master secure password management to protect your account and sensitive data.</p>
            <span style="color: var(--link-color); font-size: 13px; font-weight: 700;">Read more ›</span>
        </a>

        <!-- Kleopatra Guide -->
        <a href="{{ route('guides.kleopatra') }}" class="card" style="padding: 25px; text-decoration: none; color: inherit; transition: transform 0.2s, border-color 0.2s;" onmouseover="this.style.borderColor='#ff9900'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='var(--dm-border-color)'; this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 15px;">🔑</div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">Kleopatra Guide</h3>
            <p style="font-size: 14px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 15px;">Step-by-step guide for PGP key management, encryption, and verified communication.</p>
            <span style="color: var(--link-color); font-size: 13px; font-weight: 700;">Read more ›</span>
        </a>
    </div>
</div>
@endsection
