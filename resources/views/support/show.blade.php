@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('support.index') }}">Your Support Requests</a>
        <span>›</span>
        <span>Case ID #{{ strtoupper($supportRequest->ticket_id) }}</span>
    </div>

    <!-- Case Status Header -->
    <div class="card" style="padding: 25px; margin-bottom: 30px; border-left: 4px solid {{ $supportRequest->status === 'open' ? '#007600' : ($supportRequest->status === 'in_progress' ? '#f08804' : 'var(--dm-border-color)') }};">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
            <div style="flex: 1; min-width: 300px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--dm-text-secondary); background: rgba(0,0,0,0.2); padding: 2px 8px; border-radius: 4px;">
                        {{ str_replace('_', ' ', $supportRequest->status) }}
                    </span>
                    <span style="font-size: 14px; color: var(--dm-text-secondary);">Opened: {{ $supportRequest->created_at->format('M d, Y') }}</span>
                </div>
                <h1 style="font-size: 24px; font-weight: 700; margin: 0; color: #fff; line-height: 1.3;">{{ $supportRequest->title }}</h1>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 12px; color: var(--dm-text-secondary); margin-bottom: 5px;">Reference Identifier</div>
                <div style="font-family: monospace; font-size: 18px; font-weight: 700; color: #3399ff;">#{{ strtoupper($supportRequest->ticket_id) }}</div>
            </div>
        </div>
    </div>

    <!-- Communication Thread -->
    <div style="display: flex; flex-direction: column; gap: 25px; margin-bottom: 40px; max-width: 900px; margin-left: auto; margin-right: auto;">
        @foreach($messages as $message)
            <div style="display: flex; flex-direction: column; {{ $message->is_admin_reply ? 'align-items: flex-start' : 'align-items: flex-end' }}">
                <div style="max-width: 85%; min-width: 200px; padding: 20px; border-radius: 12px; position: relative;
                    {{ $message->is_admin_reply ? 'background: #2d3748; border: 1px solid #4a5568; border-bottom-left-radius: 2px;' : 'background: #232f3e; border: 1px solid #37475a; border-bottom-right-radius: 2px;' }}">
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 10px;">
                        @if($message->is_admin_reply)
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; background: #ff9900; border-radius: 50%;"></div>
                                <span style="font-size: 11px; font-weight: 700; color: #ff9900; text-transform: uppercase; letter-spacing: 0.5px;">Marketplace Security Staff</span>
                            </div>
                        @else
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 8px; height: 8px; background: #3399ff; border-radius: 50%;"></div>
                                <span style="font-size: 11px; font-weight: 700; color: #3399ff; text-transform: uppercase; letter-spacing: 0.5px;">Account Holder</span>
                            </div>
                        @endif
                        <span style="font-size: 11px; opacity: 0.5;">{{ $message->created_at->format('H:i') }}</span>
                    </div>

                    <div style="font-size: 14px; line-height: 1.7; white-space: pre-wrap; color: #e2e8f0;">{{ $message->formatted_message }}</div>
                </div>
                <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 8px; margin-{{ $message->is_admin_reply ? 'left' : 'right' }}: 5px;">
                    {{ $message->created_at->format('M d, Y') }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Interaction Terminal -->
    @if($supportRequest->status !== 'closed')
        <div class="card" style="padding: 30px; max-width: 900px; margin: 0 auto; border-top: 3px solid #3399ff;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span>Send a Response</span>
                <span style="font-size: 12px; font-weight: 400; color: var(--dm-text-secondary);">(Transmission secured via PGP)</span>
            </h3>
            <form action="{{ route('support.reply', $supportRequest->ticket_id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="message" id="message" required
                        class="form-input"
                        style="min-height: 180px; resize: vertical; padding: 20px; line-height: 1.6;"
                        placeholder="Append additional details or clarify directives..."
                        minlength="8" maxlength="4000">{{ old('message') }}</textarea>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; gap: 30px; flex-wrap: wrap; margin-top: 25px; border-top: 1px solid var(--dm-border-color); padding-top: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; background: rgba(0,0,0,0.2); padding: 12px 20px; border-radius: 8px; border: 1px solid var(--dm-border-color);">
                        <img src="{{ $captchaImage }}" alt="CAPTCHA" style="border-radius: 4px; height: 35px; border: 1px solid rgba(255,255,255,0.1);">
                        <input type="text" name="captcha" id="captcha" required
                            class="form-input"
                            style="width: 120px; padding: 8px; text-align: center; letter-spacing: 2px; font-weight: 700;"
                            placeholder="CODE"
                            minlength="2" maxlength="8">
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 12px 40px; font-size: 15px;">Dispatch Reply</button>
                </div>
            </form>
        </div>
    @else
        <div style="background: rgba(255, 255, 255, 0.02); border: 1px dashed var(--dm-border-color); border-radius: 12px; padding: 40px; text-align: center; color: var(--dm-text-secondary); max-width: 900px; margin: 0 auto;">
            <div style="font-size: 32px; margin-bottom: 15px; filter: grayscale(1);">🔒</div>
            <h4 style="color: #fff; margin: 0 0 10px 0; font-size: 18px;">Case File Archived</h4>
            <p style="margin: 0; max-width: 500px; margin: 0 auto; line-height: 1.5;">This consultation has been successfully resolved and locked for security. New developments require a fresh inquiry.</p>
            <div style="margin-top: 25px;">
                <a href="{{ route('support.create') }}" class="btn btn-secondary" style="padding: 10px 25px;">Open New Inquiry</a>
            </div>
        </div>
    @endif
    
    <div style="margin-top: 40px; text-align: center;">
        <a href="{{ route('support.index') }}" style="color: var(--dm-text-secondary); text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 5px; transition: color 0.2s;">
            <span style="font-size: 18px;">‹</span> Return to Ledger
        </a>
    </div>
</div>
@endsection
