@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Disputes</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Your Disputes</h1>

    @if($disputes->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">⚖️</div>
            <h2 style="font-size: 24px; font-weight: 400; margin-bottom: 10px;">No disputes found</h2>
            <p style="color: var(--dm-text-secondary); margin-bottom: 30px;">If you have any issues with your orders, you can open a dispute from the order details page.</p>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">View Your Orders</a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($disputes as $dispute)
                <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color);">
                    <!-- Dispute Header -->
                    <div style="background-color: var(--dm-page-bg); padding: 15px 20px; display: flex; flex-wrap: wrap; gap: 30px; border-bottom: 1px solid var(--dm-border-color); font-size: 13px;">
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Dispute Opened</div>
                            <div style="font-weight: 500;">{{ $dispute->created_at->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Order ID</div>
                            <div style="font-weight: 500;">{{ substr($dispute->order->id, 0, 8) }}</div>
                        </div>
                        <div>
                            <div style="color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 4px;">Vendor</div>
                            <div style="font-weight: 500;">{{ $dispute->order->vendor->username }}</div>
                        </div>
                        <div style="margin-left: auto; text-align: right;">
                            <a href="{{ route('orders.show', $dispute->order->unique_url) }}" style="color: var(--link-color);">View original order</a>
                        </div>
                    </div>

                    <!-- Dispute Body -->
                    <div style="padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="flex: 1; padding-right: 20px;">
                            <div style="font-size: 16px; font-weight: 500; margin-bottom: 8px; display: flex; align-items: center; gap: 10px;">
                                <span class="badge {{ $dispute->status == 'resolved' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $dispute->getFormattedStatus() }}
                                </span>
                                <span>Reason: {{ Str::limit($dispute->reason, 60) }}</span>
                            </div>
                            <div style="font-size: 14px; color: var(--dm-text-secondary);">
                                Resolution: {{ $dispute->resolved_at ? 'Resolved on ' . $dispute->resolved_at->format('M d, Y') : 'Waiting for admin review' }}
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('disputes.show', $dispute->id) }}" class="btn btn-primary btn-sm">View Dispute Chat</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 30px;">
            {{ $disputes->links() }}
        </div>
    @endif
</div>
@endsection
