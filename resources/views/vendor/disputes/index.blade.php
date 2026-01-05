@extends('layouts.app')
@section('content')

<div class="disputes-index-container">
    <div class="disputes-index-card">
        <h1 class="disputes-index-title">My Disputes</h1>
        {{-- Disputes List --}}
        <div>
            @if($disputes->isEmpty())
                <div class="disputes-index-empty">
                    <p>You don't have any disputes at the moment.</p>
                    <a href="{{ route('vendor.sales') }}" class="disputes-index-back-btn">Return to Sales</a>
                </div>
            @else
                <div class="disputes-index-table-container">
                    <table class="disputes-index-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Buyer</th>
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Seller Central</a>
        <span>›</span>
        <span>Dispute Case Management</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 30px;">Customer Dispute Cases</h1>

    @if($disputes->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🛡️</div>
            <h2 style="margin-top: 0; font-size: 20px; font-weight: 700;">No Active Disputes</h2>
            <p style="color: var(--dm-text-secondary); margin-bottom: 0;">Congratulations! You have no open dispute cases from customers.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">{{ $disputes->count() }} Case(s) Found</span>
            </div>
            
            <div style="display: flex; flex-direction: column;">
                @foreach($disputes as $dispute)
                    <div style="padding: 20px; border-bottom: 1px solid var(--dm-border-color); display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: center;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                <span style="font-weight: 700; font-size: 15px;">Case #{{ substr($dispute->id, 0, 8) }}</span>
                                @if($dispute->status === 'open')
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; background: rgba(255, 153, 0, 0.1); color: #ff9900; border: 1px solid rgba(255, 153, 0, 0.2); text-transform: uppercase;">OPEN</span>
                                @else
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; background: rgba(0, 118, 0, 0.1); color: #007600; border: 1px solid rgba(0, 118, 0, 0.2); text-transform: uppercase;">RESOLVED</span>
                                @endif
                                <span style="font-size: 12px; color: var(--dm-text-secondary);">Opened {{ $dispute->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="font-size: 13px; color: var(--dm-text-secondary); line-height: 1.4;">
                                Buyer: <span style="color: var(--dm-text-primary); font-weight: 700;">{{ $dispute->order->user->username }}</span><br>
                                Order: <a href="{{ route('vendor.sales.show', $dispute->order->unique_url) }}" style="color: var(--link-color);">{{ $dispute->order->unique_url }}</a>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <a href="{{ route('vendor.disputes.show', $dispute->id) }}" class="btn btn-outline btn-sm">View Case Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
