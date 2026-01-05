@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Orders</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Your Orders</h1>

    @if($orders->isEmpty())
        <div class="card" style="padding: 60px 40px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
            <h2 style="font-size: 24px; font-weight: 400; margin: 0 0 10px 0;">You haven't placed any orders yet.</h2>
            <p style="color: var(--dm-text-secondary); margin: 0 0 30px 0;">Check out our products and start shopping!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                Browse Products
            </a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($orders as $order)
                <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color);">
                    <!-- Order Header -->
                    <div style="background-color: var(--dm-page-bg); padding: 15px 20px; display: flex; flex-wrap: wrap; gap: 30px; border-bottom: 1px solid var(--dm-border-color); font-size: 13px;">
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Order Placed</div>
                            <div style="font-weight: 500;">{{ $order->created_at->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Total</div>
                            <div style="font-weight: 500;">${{ number_format($order->total, 2) }}</div>
                        </div>
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Vendor</div>
                            <div style="font-weight: 500;">{{ $order->vendor->username }}</div>
                        </div>
                        <div style="margin-left: auto; text-align: right;">
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Order # {{ substr($order->id, 0, 8) }}</div>
                            <a href="{{ route('orders.show', $order->unique_url) }}" style="color: var(--link-color);">View order details</a>
                        </div>
                    </div>

                    <!-- Order Body -->
                    <div style="padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-size: 18px; font-weight: 500; margin-bottom: 8px;">
                                @if($order->status == 'completed')
                                    <span style="color: #007600;">✓ Delivered</span>
                                @elseif($order->status == 'waiting')
                                    <span style="color: #f08804;">⌚ Waiting for confirmation</span>
                                @elseif($order->status == 'shipped')
                                    <span style="color: #0066c0;">🚚 Shipped</span>
                                @else
                                    <span>Status: {{ ucfirst($order->status) }}</span>
                                @endif
                            </div>
                            <div style="font-size: 14px; color: var(--dm-text-secondary);">
                                Finalized on {{ $order->updated_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <div>
                            <a href="{{ route('orders.show', $order->unique_url) }}" class="btn btn-secondary" style="border-radius: 8px;">View Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $orders->links() }}
            @endif
        </div>
    @endif
</div>
@endsection

