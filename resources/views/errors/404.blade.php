@extends('layouts.error')

@section('content')
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Looking for something?</div>
        <div class="error-description">
            We're sorry. The Web address you entered is not a functioning page on our site. <br>
            Please go to our home page to browse our featured products.
        </div>
        <a href="{{ route('home') }}" class="home-button">Return to PlugZone Home</a>
    </div>
@endsection
