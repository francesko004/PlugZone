@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <span>Administration</span>
        <span>›</span>
        <span>Management Console</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Service Management Console</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Oversee system operations, manage global users, and monitor marketplace vitals from a centralized interface.</p>
        </div>
        <div style="font-size: 11px; color: var(--dm-text-secondary); text-align: right;">
            Region: <strong style="color: #fff;">Global Interface</strong><br>
            Platform: <strong style="color: #fff;">{{ config('app.name') }} Engine</strong>
        </div>
    </div>

    <!-- Administrative Modules Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        
        <!-- Identity & Access -->
        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #3399ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">👥</div>
                <span style="font-size: 10px; font-weight: 700; color: #3399ff; letter-spacing: 1px;">IDENTITY</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">User Infrastructure</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Manage user profiles, roles, and security permissions. Review individual account activity and enforce marketplace rules.</p>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Directory & Roles</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #3399ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">🆔</div>
                <span style="font-size: 10px; font-weight: 700; color: #3399ff; letter-spacing: 1px;">ONBOARDING</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Vendor Verification</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Review merchant applications. Verify PGP keys and business details before allowing authorized shop activation.</p>
            <a href="{{ route('admin.vendor-applications.index') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Active Applications</a>
        </div>

        <!-- Inventory & Logic -->
        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #00cc66;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">📦</div>
                <span style="font-size: 10px; font-weight: 700; color: #00cc66; letter-spacing: 1px;">INVENTORY</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Global Listings</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Monitor and moderate all marketplace listings. Global access to edit, flag, or remove product offerings.</p>
            <a href="{{ route('admin.all-products') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Moderation Console</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #00cc66;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">📁</div>
                <span style="font-size: 10px; font-weight: 700; color: #00cc66; letter-spacing: 1px;">TAXONOMY</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Department Tree</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Structure the global catalog by managing categories and subcategories. Optimize product discovery.</p>
            <a href="{{ route('admin.categories') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Edit Category Node</a>
        </div>

        <!-- Support & Operations -->
        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ff9900;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">📩</div>
                <span style="font-size: 10px; font-weight: 700; color: #ff9900; letter-spacing: 1px;">CUSTOMER SERVICE</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Support Desk</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Review and resolve user assistance requests. Efficiently respond to inquiries and platform feedback.</p>
            <a href="{{ route('admin.support.requests') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Ticket Queue</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ff9900;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">⚖️</div>
                <span style="font-size: 10px; font-weight: 700; color: #ff9900; letter-spacing: 1px;">ARBITRATION</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Resolution Operations</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Arbitrate open disputes between buyers and vendors. Enforce trade policies and resolve transaction conflicts.</p>
            <a href="{{ route('admin.disputes.index') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Manage Cases</a>
        </div>

        <!-- Telemetry & Outreach -->
        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ac39ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">📊</div>
                <span style="font-size: 10px; font-weight: 700; color: #ac39ff; letter-spacing: 1px;">ANALYTICS</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Marketplace Vitals</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Access deep-dive statistics on demographics, security, and inventory distribution.</p>
            <a href="{{ route('admin.statistics') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Health Dashboard</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ac39ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">📣</div>
                <span style="font-size: 10px; font-weight: 700; color: #ac39ff; letter-spacing: 1px;">OUTREACH</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Communication Services</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Dispatch platform-wide announcements or targeted bulk messages to specific user groups.</p>
            <a href="{{ route('admin.bulk-message.list') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Campaign Manager</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ac39ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">💬</div>
                <span style="font-size: 10px; font-weight: 700; color: #ac39ff; letter-spacing: 1px;">DISRUPTIONS</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Site-Wide Banners</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Configure and schedule platform-wide modal pop-ups and critical maintenance alerts.</p>
            <a href="{{ route('admin.popup.index') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Alert Editor</a>
        </div>

        <!-- Security & Audit -->
        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ff4444;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">🛡️</div>
                <span style="font-size: 10px; font-weight: 700; color: #ff4444; letter-spacing: 1px;">DIAGNOSTICS</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Central Logging</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Monitor application logs for security events and runtime exceptions. Detailed stream auditing.</p>
            <a href="{{ route('admin.logs') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Analyze Streams</a>
        </div>

        <div class="card" style="padding: 25px; display: flex; flex-direction: column; height: 100%; border-top: 4px solid #ff4444;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div style="font-size: 24px;">🔒</div>
                <span style="font-size: 10px; font-weight: 700; color: #ff4444; letter-spacing: 1px;">TRUST & SAFETY</span>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700;">Security Compliance</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.5; margin-bottom: 20px; flex: 1;">Warrant Canary management. Provide signed proof of platform integrity and transparency.</p>
            <a href="{{ route('admin.canary') }}" class="btn btn-secondary btn-sm" style="text-align: center;">Compliance Desk</a>
        </div>
    </div>
</div>
@endsection
