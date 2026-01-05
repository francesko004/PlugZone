@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Support Requests</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 700; margin: 0;">Support Center</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Manage your communication with the platform administration team.</p>
        </div>
        <a href="{{ route('support.create') }}" class="btn btn-primary" style="padding: 10px 25px;">Open New Ticket</a>
    </div>

    @forelse($requests as $request)
        <div class="card" style="padding: 25px; margin-bottom: 15px; border-left: 4px solid {{ $request->status === 'open' ? '#00cc66' : ($request->status === 'in_progress' ? '#ff9900' : 'rgba(255,255,255,0.1)') }}; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s; &:hover { background: rgba(255,255,255,0.02); }">
            <div style="display: flex; gap: 25px; align-items: center;">
                <div style="width: 50px; height: 50px; background: rgba(51, 153, 255, 0.05); border-radius: 8px; border: 1px solid rgba(51, 153, 255, 0.1); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    🎫
                </div>
                <div>
                    <h3 style="margin: 0 0 8px 0; font-size: 17px; font-weight: 700;">{{ $request->title }}</h3>
                    <div style="display: flex; gap: 15px; align-items: center; font-size: 12px; color: var(--dm-text-secondary);">
                        <span>Ref: <strong style="color: #fff; font-family: monospace;">#{{ strtoupper($request->ticket_id) }}</strong></span>
                        <span>•</span>
                        <span>Opened {{ $request->created_at->diffForHumans() }}</span>
                        @if($request->latestMessage)
                            <span>•</span>
                            <span>Activity: {{ $request->latestMessage->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 25px;">
                <div style="text-align: right;">
                    <div style="margin-bottom: 4px;">
                        <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 4px; 
                            {{ $request->status === 'open' ? 'background: rgba(0, 204, 102, 0.1); color: #00cc66; border: 1px solid rgba(0, 204, 102, 0.2);' : 
                               ($request->status === 'in_progress' ? 'background: rgba(255, 153, 0, 0.1); color: #ff9900; border: 1px solid rgba(255, 153, 0, 0.2);' : 
                               'background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); border: 1px solid var(--dm-border-color);') }}">
                            {{ str_replace('_', ' ', $request->status) }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('support.show', $request->ticket_id) }}" class="btn btn-secondary btn-sm" style="padding: 8px 15px;">View Thread</a>
            </div>
        </div>
    @empty
        <div class="card" style="padding: 80px; text-align: center; border: 1.5px dashed var(--dm-border-color); background: transparent;">
            <div style="font-size: 50px; margin-bottom: 20px; opacity: 0.5;">📨</div>
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">No support records detected</h2>
            <p style="color: var(--dm-text-secondary); max-width: 450px; margin: 0 auto; line-height: 1.6;">If you have any questions regarding your account, orders, or platform security, our support team is available for encrypted consultation.</p>
            <a href="{{ route('support.create') }}" class="btn btn-primary" style="margin-top: 30px; padding: 12px 40px;">Open New Ticket</a>
        </div>
    @endforelse

    @if(!$requests->isEmpty())
        <div style="margin-top: 30px;">
            {{ $requests->links() }}
        </div>
    @endif
</div>
@endsection
