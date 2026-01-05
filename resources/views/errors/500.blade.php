@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">500</div>
        <div class="error-message">Something went wrong on our end</div>
        <div class="error-description">
            We're experiencing some technical difficulties. Our team has been notified and is working to resolve the issue as quickly as possible.
        </div>
        <a href="{{ route('home') }}" class="home-button">Return to PlugZone Home</a>
    </div>
@endsection
