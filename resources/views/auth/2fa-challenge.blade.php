@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">2-Step PGP Verification</h2>
        <p class="auth-subtitle">Decrypt the message below using your private PGP key</p>
        
        <div class="card" style="background-color: var(--dm-page-bg); padding: 15px; margin-bottom: 20px;">
            <h5 class="text-sm font-bold mb-2">Encrypted Message</h5>
            <pre style="font-family: 'Courier New', monospace; font-size: 12px; color: var(--dm-text-main); white-space: pre-wrap; word-break: break-all; margin: 0;">{{ $encryptedMessage }}</pre>
        </div>
        
        <p class="text-sm text-muted mb-3">Please decrypt this message using your private key and enter the decrypted message below.</p>
        
        <form method="POST" action="{{ route('pgp.2fa.verify') }}">
            @csrf
            <div class="auth-form-group">
                <label for="decrypted_message" class="auth-label">Decrypted Message</label>
                <textarea name="decrypted_message" 
                          id="decrypted_message" 
                          rows="2" 
                          required 
                          autocomplete="off" 
                          class="auth-input" 
                          style="resize: vertical; min-height: 60px;"
                          placeholder="Enter the decrypted message"></textarea>
                @error('decrypted_message')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="auth-submit-btn">Verify & Continue</button>
        </form>
        
        <div class="auth-links">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</div>
@endsection
