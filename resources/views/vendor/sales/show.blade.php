@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.sales') }}">Sales History</a>
        <span>›</span>
        <span>Order Details</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0 0 5px 0;">Order Details</h1>
            <div style="font-size: 14px; color: var(--dm-text-secondary);">
                Order #{{ strtoupper(substr($sale->id, 0, 8)) }} | Placed on {{ $sale->created_at->format('M d, Y') }}
            </div>
        </div>
        <div style="text-align: right;">
            <a href="{{ route('vendor.sales') }}" class="btn btn-outline btn-sm">‹ Back to History</a>
        </div>
    </div>

    <!-- Status Tracker -->
    <div class="card" style="padding: 30px; margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
            <!-- Connector Lines -->
            <div style="position: absolute; top: 18px; left: 10%; right: 10%; height: 4px; background: var(--dm-border-color); z-index: 1;"></div>
            <div style="position: absolute; top: 18px; left: 10%; width: {{ $sale->is_completed ? '80%' : ($sale->is_sent ? '53%' : ($sale->is_paid ? '26%' : '0%')) }}; height: 4px; background: #ff9900; z-index: 2; transition: width 0.5s;"></div>

            <!-- Step 1: Placed -->
            <div style="text-align: center; width: 20%; z-index: 3;">
                <div style="width: 40px; height: 40px; background: {{ $sale->status !== 'cancelled' ? '#ff9900' : '#ff4444' }}; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-weight: 700; box-shadow: 0 0 0 5px var(--dm-card-bg);">
                   {{ $sale->status !== 'cancelled' ? '✓' : '✕' }}
                </div>
                <div style="font-size: 12px; font-weight: 700; color: var(--dm-text-main);">Ordered</div>
                <div style="font-size: 10px; color: var(--dm-text-secondary);">{{ $sale->created_at->format('M d') }}</div>
            </div>

            <!-- Step 2: Paid -->
            <div style="text-align: center; width: 20%; z-index: 3;">
                <div style="width: 40px; height: 40px; background: {{ $sale->is_paid ? '#ff9900' : 'var(--dm-border-color)' }}; color: {{ $sale->is_paid ? 'white' : 'var(--dm-text-secondary)' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-weight: 700; box-shadow: 0 0 0 5px var(--dm-card-bg);">
                   {{ $sale->is_paid ? '✓' : '2' }}
                </div>
                <div style="font-size: 12px; font-weight: 700; color: {{ $sale->is_paid ? 'var(--dm-text-main)' : 'var(--dm-text-secondary)' }};">Paid</div>
                @if($sale->paid_at) <div style="font-size: 10px; color: var(--dm-text-secondary);">{{ $sale->paid_at->format('M d') }}</div> @endif
            </div>

            <!-- Step 3: Delivered -->
            <div style="text-align: center; width: 20%; z-index: 3;">
                <div style="width: 40px; height: 40px; background: {{ $sale->is_sent ? '#ff9900' : 'var(--dm-border-color)' }}; color: {{ $sale->is_sent ? 'white' : 'var(--dm-text-secondary)' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-weight: 700; box-shadow: 0 0 0 5px var(--dm-card-bg);">
                   {{ $sale->is_sent ? '✓' : '3' }}
                </div>
                <div style="font-size: 12px; font-weight: 700; color: {{ $sale->is_sent ? 'var(--dm-text-main)' : 'var(--dm-text-secondary)' }};">Shipped</div>
                @if($sale->sent_at) <div style="font-size: 10px; color: var(--dm-text-secondary);">{{ $sale->sent_at->format('M d') }}</div> @endif
            </div>

            <!-- Step 4: Completed -->
            <div style="text-align: center; width: 20%; z-index: 3;">
                <div style="width: 40px; height: 40px; background: {{ $sale->is_completed ? '#ff9900' : 'var(--dm-border-color)' }}; color: {{ $sale->is_completed ? 'white' : 'var(--dm-text-secondary)' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-weight: 700; box-shadow: 0 0 0 5px var(--dm-card-bg);">
                   {{ $sale->is_completed ? '✓' : '4' }}
                </div>
                <div style="font-size: 12px; font-weight: 700; color: {{ $sale->is_completed ? 'var(--dm-text-main)' : 'var(--dm-text-secondary)' }};">Completed</div>
                @if($sale->completed_at) <div style="font-size: 10px; color: var(--dm-text-secondary);">{{ $sale->completed_at->format('M d') }}</div> @endif
            </div>
        </div>

        @if($sale->status === 'cancelled')
            <div style="margin-top: 30px; padding: 15px; background: rgba(255, 68, 68, 0.1); border: 1px solid #ff4444; border-radius: 8px; color: #ff4444; font-size: 14px; text-align: center;">
                <strong>Order Cancelled:</strong> This transaction was terminated and cannot be resumed.
            </div>
        @endif
    </div>

    <!-- Vendor Actions -->
    @if($sale->status === 'payment_received')
        <div class="card" style="padding: 25px; margin-bottom: 30px; border-left: 4px solid #ff9900;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; color: #ff9900; margin-bottom: 15px;">Action Required: Deliver Order</h3>
            <p style="font-size: 14px; line-height: 1.5; margin-bottom: 20px;">Payment has been confirmed. Please provide the delivery information for the items below and mark the order as sent.</p>

            <form action="{{ route('vendor.sales.update-delivery-text', $sale->unique_url) }}" method="POST">
                @csrf
                @foreach($sale->items as $item)
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13px; font-weight: 700; margin-bottom: 8px;">{{ $item->product_name }}</label>
                        <textarea name="delivery_text[{{ $item->product_id }}]" rows="3" class="form-input" placeholder="Enter delivery coordinates, tracking info, or digital keys..." required minlength="8" maxlength="800">{{ $item->delivery_text }}</textarea>
                    </div>
                @endforeach
                
                <div style="display: flex; gap: 15px; align-items: center; margin-top: 25px; pt: 20px; border-top: 1px solid var(--dm-border-color); padding-top: 20px;">
                    <button type="submit" class="btn btn-secondary btn-sm">Save Delivery Info</button>
                    <form action="{{ route('orders.mark-sent', $sale->unique_url) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="padding: 8px 30px;">Mark as Sent</button>
                    </form>
                </div>
            </form>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Left Column: Items & Message -->
        <div>
            <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 30px;">
                <div style="background: rgba(0,0,0,0.05); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color);">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700;">Order Items</h3>
                </div>
                <div style="padding: 20px;">
                    @foreach($sale->items as $item)
                        <div style="display: flex; gap: 20px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--dm-border-color);">
                            <div style="flex-grow: 1;">
                                <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: var(--link-color);">{{ $item->product_name }}</h4>
                                <p style="font-size: 13px; color: var(--dm-text-secondary); margin: 0 0 10px 0;">{{ Str::limit($item->product_description, 150) }}</p>
                                <div style="display: flex; gap: 15px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                    <span style="color: var(--dm-text-secondary);">QTY: {{ $item->quantity }}</span>
                                    @if($item->bulk_option) <span>Bulk Option: {{ $item->bulk_option['amount'] }} units</span> @endif
                                </div>
                            </div>
                            <div style="text-align: right; min-width: 100px;">
                                <div style="font-size: 16px; font-weight: 700; color: var(--dm-text-main);">${{ number_format($item->getTotalPrice(), 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($sale->encrypted_message)
                <div class="card" style="padding: 25px;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">Encrypted Shipping Message</h3>
                    <pre style="background: var(--dm-page-bg); padding: 15px; border-radius: 6px; font-size: 12px; border: 1px solid var(--dm-border-color); white-space: pre-wrap; word-break: break-all; color: var(--dm-text-secondary);">{{ $sale->encrypted_message }}</pre>
                </div>
            @endif
        </div>

        <!-- Right Column: Summary & Buyer -->
        <div>
            <div class="card" style="padding: 25px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Order Summary</h3>
                <div style="display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Subtotal:</span>
                        <span>${{ number_format($sale->subtotal, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: #ff4444;">
                        <span>Commission:</span>
                        <span>-${{ number_format($sale->commission, 2) }}</span>
                    </div>
                    <div style="border-top: 1px solid var(--dm-border-color); padding-top: 12px; display: flex; justify-content: space-between; font-weight: 700; font-size: 18px;">
                        <span>Net Total:</span>
                        <span style="color: #ff9900;">${{ number_format($sale->total, 2) }}</span>
                    </div>
                    <div style="font-size: 11px; color: var(--dm-text-secondary); text-align: right; margin-top: 5px;">
                        ɱ{{ number_format($sale->required_xmr_amount, 8) }} (Rate: ${{ number_format($sale->xmr_usd_rate, 2) }})
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">Buyer Details</h3>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px;">👤</div>
                    <div>
                        <div style="font-weight: 700;">{{ $sale->user->username }}</div>
                        <div style="font-size: 12px; color: var(--dm-text-secondary);">Member since {{ $sale->user->created_at->format('Y') }}</div>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ route('messages.create', ['recipient' => $sale->user->username]) }}" class="btn btn-outline btn-sm" style="width: 100%; text-align: center;">Message Buyer</a>
                </div>
            </div>

            @if($sale->dispute)
                <div class="card" style="padding: 25px; margin-top: 30px; border: 1px solid #ff4444; background: rgba(255, 68, 68, 0.05);">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; color: #ff4444; margin-bottom: 10px;">Active Dispute</h3>
                    <p style="font-size: 13px; margin-bottom: 15px;">Reason: {{ $sale->dispute->reason }}</p>
                    <a href="{{ route('vendor.disputes.show', $sale->dispute->id) }}" class="btn btn-primary btn-sm" style="width: 100%; text-align: center; background: #ff4444; border-color: #ff4444;">Manage Dispute</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
