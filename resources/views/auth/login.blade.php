@extends('layouts.auth')
@section('content')

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/plugzone.png') }}" alt="PlugZone">
            </a>
        </div>
        
        <h2 class="auth-title">Sign in</h2>
        
        <form action="{{ route('login') }}" method="POST">
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
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="auth-form-group">
                <label for="captcha" class="auth-label">CAPTCHA</label>
                <div class="auth-captcha-wrapper">
                    <img src="{{ new Mobicms\Captcha\Image($captchaCode) }}" 
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
            
            <button type="submit" class="auth-submit-btn">Sign In</button>
        </form>
        
        <div class="auth-links">
            <a href="{{ route('register') }}">Create an Account</a>
            <span class="auth-links-separator">|</span>
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
    </div>
</div>
@endsection
