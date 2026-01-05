@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <a href="{{ route('disputes.index') }}">Your Disputes</a>
        <span>›</span>
        <span>Dispute #{{ substr($dispute->id, 0, 8) }}</span>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
        <!-- Left: Messages -->
        <div class="card" style="padding: 0; display: flex; flex-direction: column; height: 75vh;">
            <div style="padding: 15px 25px; border-bottom: 1px solid var(--dm-border-color); background: var(--dm-page-bg);">
                <h2 style="margin: 0; font-size: 18px; font-weight: 500;">Dispute Conversation</h2>
            </div>

            <div style="flex: 1; overflow-y: auto; padding: 25px; display: flex; flex-direction: column; gap: 20px;">
                <!-- Initial Dispute Reason -->
                <div style="align-self: center; max-width: 90%; background: rgba(177, 39, 4, 0.05); border: 1px solid #b12704; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <div style="font-size: 12px; color: #b12704; font-weight: 700; margin-bottom: 5px; text-transform: uppercase;">Original Dispute Reason</div>
                    <div style="font-size: 14px; line-height: 1.5;">{{ $dispute->reason }}</div>
                </div>

                @foreach($dispute->messages as $message)
                    <div style="max-width: 75%; {{ $message->user_id == Auth::id() ? 'align-self: flex-end;' : 'align-self: flex-start;' }}">
                        <div style="font-size: 11px; color: var(--dm-text-secondary); margin-bottom: 4px; {{ $message->user_id == Auth::id() ? 'text-align: right;' : 'text-align: left;' }}">
                            @if($message->isFromAdmin())
                                <span style="color: var(--color-danger); font-weight: 700;">Admin</span>
                            @elseif($message->isFromBuyer())
                                Buyer
                            @elseif($message->isFromVendor())
                                Vendor
                            @endif
                            • {{ $message->user->username }}
                        </div>
                        <div style="padding: 12px 16px; border-radius: 12px; font-size: 14px; line-height: 1.5; 
                            @if($message->user_id == Auth::id()) 
                                background: #0066c0; color: white; border-bottom-right-radius: 2px;
                            @elseif($message->isFromAdmin())
                                background: #b12704; color: white; border-bottom-left-radius: 2px;
                            @else
                                background: var(--dm-page-bg); border: 1px solid var(--dm-border-color); border-bottom-left-radius: 2px;
                            @endif">
                            {{ $message->message }}
                        </div>
                        <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 5px; {{ $message->user_id == Auth::id() ? 'text-align: right;' : 'text-align: left;' }}">
                            {{ $message->created_at->format('M d, H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>

            @if($dispute->status === \App\Models\Dispute::STATUS_ACTIVE)
                <div style="padding: 20px; border-top: 1px solid var(--dm-border-color);">
                    <form action="{{ route('disputes.add-message', $dispute->id) }}" method="POST">
                        @csrf
                        <div style="display: flex; gap: 15px;">
                            <textarea name="message" class="form-input" style="height: 60px; resize: none; flex: 1;" placeholder="Type your message for the admin and vendor..." required minlength="4" maxlength="800"></textarea>
                            <button type="submit" class="btn btn-primary" style="align-self: flex-end; height: 60px; padding: 0 25px;">Send</button>
                        </div>
                    </form>
                </div>
            @else
                <div style="padding: 20px; text-align: center; background: var(--dm-page-bg); border-top: 1px solid var(--dm-border-color);">
                    <span style="color: var(--dm-text-secondary); font-size: 14px;">This dispute is resolved and closed for new messages.</span>
                </div>
            @endif
        </div>

        <!-- Right: Info Panel -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card" style="padding: 20px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Dispute Status</h3>
                <div style="text-align: center; padding: 15px 0;">
                    <span class="badge {{ $dispute->status == 'resolved' ? 'badge-success' : 'badge-warning' }}" style="font-size: 16px; padding: 8px 20px;">
                        {{ $dispute->getFormattedStatus() }}
                    </span>
                </div>
                @if($dispute->resolved_at)
                    <div style="font-size: 13px; color: var(--dm-text-secondary); text-align: center;">
                        Resolved on {{ $dispute->resolved_at->format('M d, Y') }}
                    </div>
                @endif
            </div>

            <div class="card" style="padding: 20px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Order Details</h3>
                <div style="font-size: 14px; display: flex; flex-direction: column; gap: 10px;">
                    <div><span style="color: var(--dm-text-secondary);">Order:</span> #{{ substr($dispute->order->id, 0, 8) }}</div>
                    <div><span style="color: var(--dm-text-secondary);">Vendor:</span> {{ $dispute->order->vendor->username }}</div>
                    <div><span style="color: var(--dm-text-secondary);">Amount:</span> ${{ number_format($dispute->order->total, 2) }}</div>
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ route('orders.show', $dispute->order->unique_url) }}" class="btn btn-outline btn-sm btn-block">View Order</a>
                </div>
            </div>

            <div class="card" style="padding: 20px; background: rgba(0, 102, 192, 0.05);">
                <h3 style="margin-top: 0; font-size: 14px; font-weight: 700;">Resolution Process</h3>
                <p style="font-size: 13px; line-height: 1.5; color: var(--dm-text-secondary);">
                    An admin will review the case details and chat history to make a final decision. This process usually takes 24-72 hours.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
