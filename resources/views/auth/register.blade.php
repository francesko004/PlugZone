@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/plugzone.png') }}" alt="PlugZone">
            </a>
        </div>
        
        <h2 class="auth-title">Create account</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="auth-form-group">
                <label for="username" class="auth-label">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="{{ old('username') }}" 
                       class="auth-input" 
                       required 
                       minlength="4" 
                       maxlength="16"
                       autofocus>
                <div class="form-help-text">4-16 characters, alphanumeric only</div>
                @error('username')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="password" class="auth-label">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="auth-input" 
                       required 
                       minlength="8" 
                       maxlength="40">
                <div class="form-help-text">Minimum 8 characters</div>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="password_confirmation" class="auth-label">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="auth-input" 
                       required 
                       minlength="8" 
                       maxlength="40">
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="reference_code" class="auth-label">
                    Reference Code
                    @if(!config('marketplace.require_reference_code', true))
                        <span class="text-muted text-sm">(Optional)</span>
                    @endif
                </label>
                <input type="text" 
                       id="reference_code" 
                       name="reference_code" 
                       value="{{ old('reference_code') }}"
                       class="auth-input"
                       @if(config('marketplace.require_reference_code', true)) required @endif
                       minlength="12" 
                       maxlength="20">
                @error('reference_code')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="captcha" class="auth-label">CAPTCHA</label>
                <div class="auth-captcha-wrapper">
                    <img src="{{ $captchaImage }}" 
                         alt="CAPTCHA Image" 
                         class="auth-captcha-image">
                    <input type="text" 
                           id="captcha" 
                           name="captcha" 
                           class="auth-input" 
                           required 
                           minlength="2" 
                           maxlength="8"
                           placeholder="Enter the characters above">
                </div>
                @error('captcha')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="auth-submit-btn">Create Account</button>
        </form>
        
        <div class="auth-links">
            <a href="{{ route('login') }}">Already have an account? Sign in</a>
        </div>
    </div>
</div>
@endsection
