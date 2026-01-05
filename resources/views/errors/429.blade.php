@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">429</div>
        <div class="error-message">Too Many Requests</div>
        <div class="error-description">
            You've sent too many requests in a short period. Please wait a moment before trying again.
        </div>
        <a href="{{ route('home') }}" class="home-button">Return to PlugZone Home</a>
    </div>
@endsection
