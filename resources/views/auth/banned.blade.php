@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-card" style="max-width: 500px; text-align: center; padding: 40px;">
        <div style="font-size: 48px; margin-bottom: 20px;">🚫</div>
        <h1 style="font-size: 24px; font-weight: 400; margin-bottom: 25px;">Account Suspended</h1>
        
        <div style="background: rgba(177, 39, 4, 0.05); border: 1px solid #b12704; border-radius: 4px; padding: 25px; margin-bottom: 30px; text-align: left;">
            <div style="margin-bottom: 20px;">
                <div style="color: var(--dm-text-secondary); font-size: 12px; text-transform: uppercase; font-weight: 700; margin-bottom: 5px;">Reason:</div>
                <div style="font-size: 15px; line-height: 1.5;">{{ $bannedUser->bannedUser->reason }}</div>
            </div>
            
            <div>
                <div style="color: var(--dm-text-secondary); font-size: 12px; text-transform: uppercase; font-weight: 700; margin-bottom: 5px;">Banned Until:</div>
                <div style="font-size: 15px; font-weight: 500;">{{ $bannedUser->bannedUser->banned_until->format('M d, Y \a\t H:i') }}</div>
            </div>
        </div>
        
        <p style="color: var(--dm-text-secondary); font-size: 13px; margin-bottom: 30px; line-height: 1.5;">
            If you believe this is a mistake, please review our terms of service or contact support.
        </p>
        
        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Return to Login</a>
    </div>
</div>
@endsection
