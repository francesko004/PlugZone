@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.disputes.index') }}">Resolution Operations</a>
        <span>›</span>
        <span>Case ID: {{ substr($dispute->id, 0, 8) }}</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Dispute Arbitration Console</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Review evidence, mediate communication, and issue a binding resolution.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.disputes.index') }}" class="btn btn-outline btn-sm">Return to Queue</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 320px 1fr 320px; gap: 30px; align-items: start;">
        
        <!-- Left Column: Case Context -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px;">Case Metadata</h3>
                <div style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Internal ID:</span>
                        <span style="font-family: monospace;">{{ substr($dispute->id, 0, 12) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Status:</span>
                        <span style="font-weight: 700; color: {{ $dispute->status === \App\Models\Dispute::STATUS_ACTIVE ? '#ff9900' : 'var(--dm-text-secondary)' }};">
                            {{ strtoupper($dispute->status) }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Opened:</span>
                        <span>{{ $dispute->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Buyer:</span>
                        <span style="font-weight: 700;">{{ $dispute->order->user->username }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Vendor:</span>
                        <span style="font-weight: 700;">{{ $dispute->order->vendor->username }}</span>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">Order Context</h3>
                <div style="font-size: 13px; margin-bottom: 20px;">
                    <div style="color: var(--dm-text-secondary); margin-bottom: 5px;">Product:</div>
                    <div style="font-weight: 700;">{{ $dispute->order->product->name }}</div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 20px;">
                    <span style="color: var(--dm-text-secondary);">Total Value:</span>
                    <span style="font-weight: 700;">{{ $dispute->order->total_price }} USD</span>
                </div>
                <a href="{{ route('orders.show', $dispute->order->unique_url) }}" class="btn btn-secondary btn-sm" style="width: 100%; text-align: center;">View Full Order</a>
            </div>

            <div class="card" style="padding: 20px; background: rgba(255, 68, 68, 0.05); border: 1px solid rgba(255, 68, 68, 0.1);">
                <h4 style="margin: 0 0 10px 0; font-size: 12px; font-weight: 700; color: #ff4444;">Resolution Warning</h4>
                <p style="font-size: 11px; line-height: 1.5; color: var(--dm-text-secondary); margin: 0;">Arbitration verdicts are final and immediately execute fund distributions as specified. Ensure all evidence has been reviewed.</p>
            </div>
        </div>

        <!-- Center Column: Investigation Thread -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="card" style="padding: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Investigation Thread</h3>
                
                <div style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 30px;">
                    @forelse($dispute->messages as $message)
                        <div style="padding: 15px; border-radius: 8px; border: 1px solid var(--dm-border-color); 
                            @if($message->isFromAdmin()) border-left: 4px solid #3399ff; background: rgba(51, 153, 255, 0.03); 
                            @elseif($message->isFromBuyer()) border-left: 4px solid #ff9900; background: rgba(255, 153, 0, 0.03);
                            @else border-left: 4px solid #6c757d; background: rgba(108, 117, 125, 0.03);
                            @endif
                        ">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 12px;">
                                <span style="font-weight: 700;">
                                    @if($message->isFromAdmin()) 🛡️ ADMIN: {{ $message->user->username }}
                                    @elseif($message->isFromBuyer()) 👤 BUYER: {{ $message->user->username }}
                                    @else 🏪 VENDOR: {{ $message->user->username }}
                                    @endif
                                </span>
                                <span style="color: var(--dm-text-secondary);">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div style="font-size: 14px; line-height: 1.5; white-space: pre-wrap;">{{ $message->message }}</div>
                        </div>
                    @empty
                        <div style="padding: 40px; text-align: center; color: var(--dm-text-secondary);">No messages recorded in this case.</div>
                    @endforelse
                </div>

                @if($dispute->status === \App\Models\Dispute::STATUS_ACTIVE)
                    <form action="{{ route('disputes.add-message', $dispute->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Internal Administrator Message</label>
                            <textarea name="message" class="form-input" rows="4" placeholder="Enter findings or request further evidence from parties..." required></textarea>
                            <div style="display: flex; justify-content: flex-end; margin-top: 15px;">
                                <button type="submit" class="btn btn-secondary">Post to Case Thread</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Right Column: Final Arbitration -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            @if($dispute->status === \App\Models\Dispute::STATUS_ACTIVE)
                <div class="card" style="padding: 25px; border-top: 4px solid #ff9900;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 25px;">Arbitration Verdict</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 40px;">
                        <!-- Vendor Prevails -->
                        <form action="{{ route('admin.disputes.vendor-prevails', $dispute->id) }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="form-label" style="font-size: 11px;">Resolution Notes (Vendor)</label>
                                <textarea name="message" class="form-input" style="font-size: 12px; height: 80px;" placeholder="Reasoning for merchant outcome..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;" onclick="return confirm('Execute settlement: Order funds will be released to MERCHANT. Continue?')">Verdict: Vendor Prevails</button>
                        </form>

                        <div style="border-top: 1px solid var(--dm-border-color); position: relative; margin: 10px 0;">
                            <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--dm-card-bg); padding: 0 10px; font-size: 10px; color: var(--dm-text-secondary);">OR</span>
                        </div>

                        <!-- Buyer Prevails -->
                        <form action="{{ route('admin.disputes.buyer-prevails', $dispute->id) }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label class="form-label" style="font-size: 11px;">Resolution Notes (Buyer)</label>
                                <textarea name="message" class="form-input" style="font-size: 12px; height: 80px;" placeholder="Reasoning for customer outcome..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Execute settlement: Order funds will be returned to CUSTOMER. Continue?')">Verdict: Buyer Prevails</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card" style="padding: 25px; background: rgba(0, 204, 102, 0.03); border: 1px solid rgba(0, 204, 102, 0.1);">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px; color: #00cc66;">Verdict Issued</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Resolution Date:</span>
                            <span>{{ $dispute->resolved_at->format('Y-m-d') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--dm-text-secondary);">Arbitrator:</span>
                            <span style="font-weight: 700;">{{ $dispute->resolver->username }}</span>
                        </div>
                    </div>
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(0, 204, 102, 0.2); font-size: 12px; line-height: 1.5;">
                        Platform records indicate this case is permanently archived. No further arbitration actions are possible.
                    </div>
                </div>
            @endif

            <div class="card" style="padding: 20px;">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700;">Arbitration Standards</h4>
                <ul style="margin: 0; padding-left: 15px; font-size: 11px; color: var(--dm-text-secondary); line-height: 1.6;">
                    <li>Review tracking if applicable.</li>
                    <li>Check encrypted communication history.</li>
                    <li>Verify PGP signatures on sensitive claims.</li>
                    <li>Refer to seller's specific terms/policy.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
