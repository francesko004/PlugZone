@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendor.index') }}">Seller Central</a>
        <span>›</span>
        <a href="{{ route('vendor.disputes.index') }}">Disputes</a>
        <span>›</span>
        <span>Case Details</span>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Left: Case History / Chat -->
        <div>
            <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 30px;">
                <div style="background: rgba(255, 255, 255, 0.03); padding: 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 700;">Case History</h2>
                    <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; background: {{ $dispute->status === 'open' ? '#ff9900' : '#007600' }}; color: white; text-transform: uppercase;">{{ $dispute->status }}</span>
                </div>

                <div style="padding: 30px; display: flex; flex-direction: column; gap: 20px; min-height: 400px;">
                    @if($dispute->messages->isEmpty())
                        <div style="text-align: center; color: var(--dm-text-secondary); margin-top: 100px;">
                            <div style="font-size: 40px; margin-bottom: 15px;">💬</div>
                            No messages have been exchanged in this case yet.
                        </div>
                    @else
                        @foreach($dispute->messages as $message)
                            <div style="display: flex; flex-direction: column; {{ $message->isFromVendor() ? 'align-items: flex-end;' : 'align-items: flex-start;' }}">
                                <div style="display: flex; gap: 8px; align-items: baseline; margin-bottom: 5px; font-size: 12px; color: var(--dm-text-secondary);">
                                    <span style="font-weight: 700; color: {{ $message->isFromAdmin() ? '#ff4444' : ($message->isFromVendor() ? '#ff9900' : 'var(--dm-text-primary)') }}">
                                        @if($message->isFromAdmin())
                                            MODERATOR
                                        @elseif($message->isFromVendor())
                                            YOU (Vendor)
                                        @else
                                            BUYER ({{ $message->user->username }})
                                        @endif
                                    </span>
                                    <span>•</span>
                                    <span>{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="max-width: 80%; padding: 12px 16px; border-radius: 12px; font-size: 14px; line-height: 1.5; white-space: pre-wrap;
                                    @if($message->isFromAdmin())
                                        background: rgba(255, 68, 68, 0.1); border: 1px solid rgba(255, 68, 68, 0.2); color: var(--dm-text-primary);
                                    @elseif($message->isFromVendor())
                                        background: rgba(255, 153, 0, 0.1); border: 1px solid rgba(255, 153, 0, 0.2); border-bottom-right-radius: 2px;
                                    @else
                                        background: var(--dm-border-color); border: 1px solid rgba(255,255,255,0.05); border-bottom-left-radius: 2px;
                                    @endif
                                ">{{ $message->message }}</div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if($dispute->status === 'open')
                    <div style="padding: 20px; background: rgba(0,0,0,0.2); border-top: 1px solid var(--dm-border-color);">
                        <form action="{{ route('disputes.add-message', $dispute->id) }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 15px;">
                                <textarea name="message" class="form-input" rows="4" placeholder="Type your response to the customer or moderator..." required maxlength="1000"></textarea>
                            </div>
                            <div style="display: flex; justify-content: flex-end;">
                                <button type="submit" class="btn btn-primary">Send Response</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div style="padding: 20px; text-align: center; background: rgba(0, 118, 0, 0.05); color: #007600; font-weight: 700;">
                        This case has been marked as resolved and is now closed for comments.
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Order Details -->
        <div>
            <div class="card" style="padding: 20px; position: sticky; top: 20px;">
                <h3 style="margin-top: 0; font-size: 14px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Case Summary</h3>
                
                <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px;">
                    <div>
                        <div style="color: var(--dm-text-secondary); margin-bottom: 4px;">Dispute Reason:</div>
                        <div style="font-weight: 700; padding: 8px; background: rgba(255, 68, 68, 0.05); border: 1px solid rgba(255,68,68,0.2); border-radius: 4px;">{{ $dispute->reason }}</div>
                    </div>

                    <div>
                        <div style="color: var(--dm-text-secondary); margin-bottom: 4px;">Order Status:</div>
                        <div style="font-weight: 700;">{{ ucfirst($dispute->order->status) }}</div>
                    </div>

                    <div style="padding-top: 15px; border-top: 1px solid var(--dm-border-color);">
                        <div style="color: var(--dm-text-secondary); margin-bottom: 4px;">Buyer Information:</div>
                        <div style="font-weight: 700; font-size: 14px;">{{ $dispute->order->user->username }}</div>
                        <div style="font-size: 11px; color: var(--dm-text-secondary);">Member since {{ $dispute->order->user->created_at->format('M Y') }}</div>
                    </div>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('vendor.sales.show', $dispute->order->unique_url) }}" class="btn btn-outline btn-sm" style="width: 100%; text-align: center;">View Full Order</a>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 20px; margin-top: 20px;">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700;">Resolution Process</h4>
                <p style="font-size: 11px; line-height: 1.5; color: var(--dm-text-secondary); margin: 0;">Our moderators will review the evidence provided by both parties. Please provide all necessary proof of delivery or communication to expedite the resolution.</p>
            </div>
        </div>
    </div>
</div>
@endsection
