@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <span>Vendor Dashboard</span>
    </div>

    <div class="card" style="padding: 40px; margin-bottom: 30px; background: linear-gradient(135deg, #232f3e 0%, #0f1111 100%); color: white;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 5px;">Seller Central</h1>
        <p style="font-size: 16px; opacity: 0.8; margin: 0;">Manage your inventory, track sales, and grow your presence on PlugZone.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        <!-- Inventory Management -->
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(0, 0, 0, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color);">
                <h3 style="margin: 0; font-size: 16px; font-weight: 700;">📦 Inventory Management</h3>
            </div>
            <div style="padding: 10px 0;">
                <a href="{{ route('vendor.products.create', 'digital') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">Add New Digital Product</a>
                <a href="{{ route('vendor.products.create', 'cargo') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">Add New physical (Cargo) Product</a>
                <a href="{{ route('vendor.products.create', 'deaddrop') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">Add New Dead Drop Listing</a>
                <a href="{{ route('vendor.my-products') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0; border-top: 1px solid var(--dm-border-color); font-weight: 700; color: var(--link-color);">View All Your Products ›</a>
            </div>
        </div>

        <!-- Sales & Performance -->
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(0, 0, 0, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color);">
                <h3 style="margin: 0; font-size: 16px; font-weight: 700;">📈 Sales & Performance</h3>
            </div>
            <div style="padding: 10px 0;">
                <a href="{{ route('vendor.sales') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">View Recent Sales</a>
                <a href="{{ route('vendor.disputes.index') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">Customer Dispute Cases</a>
                <a href="{{ route('vendor.sales') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0; border-top: 1px solid var(--dm-border-color); font-weight: 700; color: var(--link-color);">View Detailed Analytics ›</a>
            </div>
        </div>

        <!-- Store Profile -->
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(0, 0, 0, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color);">
                <h3 style="margin: 0; font-size: 16px; font-weight: 700;">🏬 Storefront Settings</h3>
            </div>
            <div style="padding: 10px 0;">
                <a href="{{ route('vendor.appearance') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">Edit Store Appearance</a>
                <a href="{{ route('dashboard', auth()->user()->username) }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0;">View Public Storefront</a>
                <a href="{{ route('settings') }}" class="sidebar-link" style="padding: 12px 20px; border-radius: 0; border-top: 1px solid var(--dm-border-color); font-weight: 700; color: var(--link-color);">General Vendor Settings ›</a>
            </div>
        </div>
    </div>
</div>
@endsection
