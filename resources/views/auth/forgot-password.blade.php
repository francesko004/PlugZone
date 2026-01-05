@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">Password Recovery</h2>
        <p class="auth-subtitle">Enter your username and 12-word mnemonic phrase to reset your password</p>
        
        <form method="POST" action="{{ route('password.verify') }}">
            @csrf
            
            <div class="auth-form-group">
                <label for="username" class="auth-label">Username</label>
                <input type="text" 
                       name="username" 
                       id="username" 
                       class="auth-input" 
                       value="{{ old('username') }}" 
                       minlength="4" 
                       maxlength="16" 
                       required 
                       autofocus>
                @error('username')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="mnemonic" class="auth-label">12-Word Mnemonic Phrase</label>
                <textarea name="mnemonic" 
                          id="mnemonic" 
                          class="auth-input" 
                          style="resize: vertical; min-height: 100px;"
                          minlength="40" 
                          maxlength="512" 
                          required 
                          placeholder="Enter your 12-word recovery phrase separated by spaces">{{ old('mnemonic') }}</textarea>
                <div class="form-help-text">Enter the 12-word phrase you saved during registration</div>
                @error('mnemonic')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="auth-submit-btn">Verify & Reset Password</button>
        </form>
        
        <div class="auth-links">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</div>
@endsection
