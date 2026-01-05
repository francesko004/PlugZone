@extends('layouts.app')

@section('content')
<div class="main-content" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div class="card" style="max-width: 500px; padding: 40px; text-align: center;">
        <div style="font-size: 48px; margin-bottom: 20px;">⏳</div>
        <h1 style="font-size: 24px; font-weight: 400; margin-bottom: 15px;">Rate Limit Exceeded</h1>
        
        <div style="background: rgba(177, 39, 4, 0.05); border: 1px solid #b12704; border-radius: 4px; padding: 20px; margin-bottom: 30px; text-align: left;">
            <div style="color: #b12704; font-weight: 700; font-size: 16px; margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                ⚠️ Too Many Messages
            </div>
            <p style="font-size: 14px; margin-bottom: 10px; line-height: 1.5;">
                For security reasons, we have temporarily limited your message sending frequency.
            </p>
            <p style="font-size: 13px; color: var(--dm-text-secondary); margin: 0;">
                Please wait a few minutes before sending another message.
            </p>
        </div>

        <a href="{{ route('messages.index') }}" class="btn btn-primary btn-block">
            Return to Messages
        </a>
    </div>
</div>
@endsection
