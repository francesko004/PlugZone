@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">Sorry, you don't have access</div>
        <div class="error-description">
            You don't have permission to access this resource. If you believe this is an error, please contact support or try a different account.
        </div>
        <a href="{{ route('home') }}" class="home-button">Return to PlugZone Home</a>
    </div>
@endsection
