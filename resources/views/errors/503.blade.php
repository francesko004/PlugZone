@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">503</div>
        <div class="error-message">Service Unavailable</div>
        <div class="error-description">
            PlugZone is currently undergoing maintenance. We'll be back online shortly. Thank you for your patience.
        </div>
        <a href="{{ route('home') }}" class="home-button">Return to PlugZone Home</a>
    </div>
@endsection
