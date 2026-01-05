@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <a href="{{ route('orders.index') }}">Your Orders</a>
        <span>›</span>
        <span>Order Details</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Order Details</h1>
        <div style="color: var(--dm-text-secondary); font-size: 14px;">
            Order ID: <span style="font-weight: 500;">{{ substr($order->id, 0, 8) }}</span>
        </div>
    </div>

    <!-- Order Status Tracker -->
    <div class="card" style="margin-bottom: 30px; padding: 30px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 40px; position: relative; padding: 0 40px;">
            <!-- Connector Line -->
            <div style="position: absolute; top: 15px; left: 80px; right: 80px; hieght: 2px; border-top: 2px solid var(--dm-border-color); z-index: 1;"></div>
            
            @php
                $steps = [
                    ['label' => 'Order Placed', 'active' => true, 'date' => $order->created_at],
                    ['label' => 'Payment Received', 'active' => $order->is_paid || $order->is_sent || $order->is_completed, 'date' => $order->paid_at],
                    ['label' => 'Shipped', 'active' => $order->is_sent || $order->is_completed, 'date' => $order->sent_at],
                    ['label' => 'Delivered', 'active' => $order->is_completed, 'date' => $order->completed_at],
                ];
            @endphp

            @foreach($steps as $index => $step)
                <div style="text-align: center; position: relative; z-index: 2; width: 100px;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background-color: {{ $step['active'] ? '#00cc66' : 'rgba(255,255,255,0.05)' }}; border: 2px solid {{ $step['active'] ? '#00cc66' : 'rgba(255,255,255,0.1)' }}; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 14px; font-weight: 700;">
                        @if($step['active']) ✓ @else {{ $index + 1 }} @endif
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: {{ $step['active'] ? '#fff' : 'var(--dm-text-secondary)' }}; text-transform: uppercase; letter-spacing: 0.5px;">
                        {{ $step['label'] }}
                    </div>
                    @if($step['date'])
                        <div style="font-size: 10px; color: var(--dm-text-secondary); margin-top: 4px;">{{ $step['date']->format('M d, H:i') }}</div>
                    @endif
                </div>
            @endforeach
        </div>

        @if($order->status === 'waiting_payment' && $isBuyer && isset($qrCode))
            <div style="background: rgba(255, 153, 0, 0.03); border: 1px solid rgba(255, 153, 0, 0.1); border-radius: 8px; padding: 30px; margin-top: 20px;">
                <div style="display: grid; grid-template-columns: 200px 1fr; gap: 40px; align-items: center;">
                    <div style="background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                        <img src="{{ $qrCode }}" alt="Monero QR" style="width: 100%; height: auto; display: block;">
                    </div>
                    <div>
                        <h3 style="margin: 0 0 15px 0; font-size: 18px; font-weight: 700; color: #ff9900;">Awaiting Monero Settlement</h3>
                        <p style="font-size: 14px; color: var(--dm-text-secondary); margin-bottom: 20px; line-height: 1.5;">To finalize this order, please send the exact amount of XMR to the secure escrow address below. Your order will be automatically updated once the transaction is detected on the blockchain.</p>
                        
                        <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 6px; border: 1px solid var(--dm-border-color); margin-bottom: 20px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 8px;">MONERO RECEIVE ADDRESS</label>
                            <div style="font-family: monospace; font-size: 14px; color: #fff; word-break: break-all; line-height: 1.4;">{{ $order->payment_address }}</div>
                        </div>

                        <div style="display: flex; gap: 30px; align-items: center;">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); margin-bottom: 5px;">REQUIRED XMR</label>
                                <div style="font-size: 20px; font-weight: 700; color: #fff;">ɱ{{ number_format($order->required_xmr_amount, 8) }}</div>
                            </div>
                            <div style="flex: 1; display: flex; align-items: center; gap: 10px; font-size: 13px; color: #ff9900;">
                                <div style="width: 8px; height: 8px; background: #ff9900; border-radius: 50%; box-shadow: 0 0 8px #ff9900;"></div>
                                <span>Scanning blockchain for incoming transfers...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($order->status === 'product_sent' && $isBuyer)
            <div style="background-color: rgba(51, 153, 255, 0.05); padding: 25px; border-radius: 8px; text-align: center; border: 1px solid rgba(51, 153, 255, 0.2); margin-top: 20px;">
                <h3 style="margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">Inventory Acknowledgment Required</h3>
                <p style="color: var(--dm-text-secondary); font-size: 14px; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Platform tracking indicates shipment is complete. Please confirm execution only after you have physically inspected the items.
                </p>
                <form action="{{ route('orders.mark-completed', $order->unique_url) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="padding: 12px 60px;">Confirm Full Receipt</button>
                </form>
            </div>
        @endif
    </div>

    <!-- Info Sections Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 30px;">
        <!-- Vendor Info -->
        <div class="card" style="padding: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Vendor Information</h3>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                <div style="font-size: 32px;">🏪</div>
                <div>
                    <div style="font-size: 16px; font-weight: 500;">{{ $order->vendor->username }}</div>
                    <a href="{{ route('vendors.show', $order->vendor->username) }}" style="font-size: 13px; color: var(--link-color);">View Profile</a>
                </div>
            </div>
            <a href="{{ route('messages.index', ['vendor' => $order->vendor->username]) }}" class="btn btn-secondary btn-sm btn-block">Contact Vendor</a>
        </div>

        <!-- Payment Info -->
        <div class="card" style="padding: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Payment Info</h3>
            <div style="margin-bottom: 10px; font-size: 14px;">
                <span style="color: var(--dm-text-secondary);">Method:</span> <strong>Monero (XMR)</strong>
            </div>
            <div style="margin-bottom: 10px; font-size: 14px;">
                <span style="color: var(--dm-text-secondary);">Rate:</span> <strong>${{ number_format($order->xmr_usd_rate, 2) }} / XMR</strong>
            </div>
            <div style="font-size: 14px;">
                <span style="color: var(--dm-text-secondary);">Status:</span> 
                @if($order->is_paid)
                    <span class="badge badge-success">Paid</span>
                @else
                    <span class="badge badge-warning">Awaiting Payment</span>
                @endif
            </div>
        </div>

        <!-- Order Summary -->
        <div class="card" style="padding: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Order Summary</h3>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px;">
                <span style="color: var(--dm-text-secondary);">Items ({{ $totalItems }}):</span>
                <span>${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px;">
                <span style="color: var(--dm-text-secondary);">Fees:</span>
                <span>${{ number_format($order->commission, 2) }}</span>
            </div>
            <div class="divider"></div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px; font-weight: 700; font-size: 18px; color: #b12704;">
                <span>Grand Total:</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
            <div style="text-align: right; font-size: 12px; color: var(--dm-text-secondary); margin-top: 4px;">
                ɱ{{ number_format($order->required_xmr_amount, 8) }} XMR
            </div>
        </div>
    </div>

    <!-- Items Section -->
    <div class="card" style="margin-bottom: 30px; padding: 0;">
        <div style="padding: 20px; border-bottom: 1px solid var(--dm-border-color);">
            <h2 style="margin: 0; font-size: 20px; font-weight: 500;">Order Items</h2>
        </div>
        <div style="padding: 20px;">
            @foreach($order->items as $item)
                <div style="display: flex; gap: 20px; padding: 20px 0; border-bottom: 1px solid var(--dm-border-color); last-child: border-bottom: none;">
                    <div style="width: 100px; height: 100px; background: var(--dm-page-bg); border: 1px solid var(--dm-border-color); border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                        📦
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 18px; font-weight: 500; color: var(--link-color); margin-bottom: 8px;">{{ $item->product_name }}</div>
                        <div style="font-size: 14px; color: var(--dm-text-secondary); margin-bottom: 15px;">{{ Str::limit($item->product_description, 150) }}</div>
                        <div style="display: flex; gap: 20px; font-size: 13px;">
                            <span>Quantity: <strong>{{ $item->quantity }}</strong></span>
                            @if($item->delivery_option)
                                <span>Delivery: <strong>{{ $item->delivery_option['description'] ?? 'N/A' }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 18px; font-weight: 600;">${{ number_format($item->getTotalPrice(), 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($isBuyer && ($order->status === 'waiting_payment' || $order->status === 'payment_received' || $order->status === 'product_sent'))
        <div style="text-align: right; margin-bottom: 30px;">
            <form action="{{ route('orders.mark-cancelled', $order->unique_url) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline btn-sm" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
            </form>
        </div>
    @endif

    <!-- Reviews Section -->
    @if($isBuyer && $order->status === 'completed')
        <div class="card" style="margin-bottom: 30px; padding: 25px;">
            <h2 style="margin-top: 0; font-size: 20px; font-weight: 500; margin-bottom: 20px;">Product Reviews</h2>
            @foreach($order->items as $item)
                <div style="margin-bottom: 30px; padding: 20px; background: var(--dm-page-bg); border-radius: 8px;">
                    <h3 style="margin-top: 0; font-size: 16px;">Review for: {{ $item->product_name }}</h3>
                    @if(isset($item->existingReview) && $item->existingReview)
                        <div style="margin-top: 15px;">
                            <div class="badge badge-success" style="margin-bottom: 10px;">{{ ucfirst($item->existingReview->sentiment) }} Sentiment</div>
                            <p style="font-style: italic; color: var(--dm-text-secondary);">"{{ $item->existingReview->review_text }}"</p>
                            <div style="font-size: 12px; color: var(--dm-text-secondary);">Reviewed on {{ $item->existingReview->created_at->format('M d, Y') }}</div>
                        </div>
                    @else
                        <form action="{{ route('orders.submit-review', ['uniqueUrl' => $order->unique_url, 'orderItemId' => $item->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">How was it?</label>
                                <textarea name="review_text" rows="4" class="form-input" required placeholder="Share your experience..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sentiment</label>
                                <div style="display: flex; gap: 15px;">
                                    <label style="cursor: pointer;"><input type="radio" name="sentiment" value="positive" required> Positive</label>
                                    <label style="cursor: pointer;"><input type="radio" name="sentiment" value="mixed"> Mixed</label>
                                    <label style="cursor: pointer;"><input type="radio" name="sentiment" value="negative"> Negative</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit Review</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
