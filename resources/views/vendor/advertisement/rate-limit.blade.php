@extends('layouts.app')

@section('content')
<div class="main-content">
    <div style="max-width: 600px; margin: 100px auto; text-align: center;">
        <div class="card" style="padding: 40px; border-top: 4px solid #ff9900;">
            <div style="font-size: 48px; margin-bottom: 20px;">⏳</div>
            <h1 style="font-size: 24px; font-weight: 700; margin-bottom: 15px;">Slow Down</h1>
            <p style="font-size: 16px; color: var(--dm-text-secondary); line-height: 1.6; margin-bottom: 30px;">
                You have recently created or attempted to create an advertisement. To ensure system stability and prevent spam, please wait at least 5 minutes before your next attempt.
            </p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="{{ route('vendor.my-products') }}" class="btn btn-primary">Back to Inventory</a>
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Seller Central</a>
            </div>
    <div class="advertisement-rate-limit-button">
        <a href="{{ route('vendor.my-products') }}">
            Return to My Products
        </a>
    </div>
</div>
@endsection

