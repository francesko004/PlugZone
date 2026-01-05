@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">Reset Password</h2>
        <p class="auth-subtitle">Enter your new password below</p>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="auth-form-group">
                <label for="password" class="auth-label">New Password</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="auth-input" 
                       minlength="8" 
                       maxlength="40" 
                       required
                       autofocus>
                <div class="form-help-text">Minimum 8 characters</div>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="password_confirmation" class="auth-label">Confirm New Password</label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       class="auth-input" 
                       minlength="8" 
                       maxlength="40" 
                       required>
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="auth-submit-btn">Reset Password</button>
        </form>
        
        <div class="auth-links">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</div>
@endsection
