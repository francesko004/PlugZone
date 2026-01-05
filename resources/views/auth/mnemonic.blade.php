@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">Your Recovery Phrase</h2>
        <p class="auth-subtitle">Save this phrase securely - you'll need it to recover your account</p>
        
        <div class="alert alert-error" style="margin-bottom: 20px;">
            <strong>⚠ Critical Security Warning</strong>
            <div style="margin-top: 8px; font-size: 13px;">
                This is the ONLY time you will see this mnemonic phrase. Write it down and store it securely offline. You will need this to recover your account if you forget your password.
            </div>
        </div>
        
        <div class="mnemonic-grid">
            @php
                $words = explode(' ', $mnemonic);
            @endphp
            @foreach($words as $index => $word)
                <div class="mnemonic-word">
                    <span class="mnemonic-word-number">{{ $index + 1 }}</span>
                    {{ $word }}
                </div>
            @endforeach
        </div>
        
        <form method="GET" action="{{ route('login') }}" style="margin-top: 30px;">
            <button type="submit" class="auth-submit-btn">I've Saved My Recovery Phrase</button>
        </form>
    </div>
</div>
@endsection
