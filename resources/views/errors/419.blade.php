@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">419</div>
        <div class="error-message">Page Expired</div>
        <div class="error-description">
            Your session has expired or the page has been idle for too long. Please go back, refresh the page, and try again.
        </div>
        <a href="{{ route('login') }}" class="home-button">Return to Login</a>
    </div>
@endsection
