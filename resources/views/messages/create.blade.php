@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <a href="{{ route('messages.index') }}">Your Messages</a>
        <span>›</span>
        <span>Start New Conversation</span>
    </div>

    <div class="card" style="max-width: 600px; margin: 0 auto; padding: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Start New Conversation</h1>
        
        <form action="{{ route('messages.start') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username" class="form-label">Recipient Username</label>
                <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    class="form-input" 
                    required 
                    maxlength="16"
                    placeholder="e.g. VendorName" 
                    value="{{ old('username', $username ?? '') }}"
                >
                <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 4px;">Enter the exact username of the person you want to message.</div>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Your Message</label>
                <textarea 
                    name="content" 
                    id="content" 
                    class="form-input" 
                    style="height: 150px;"
                    required 
                    minlength="4"
                    maxlength="1600"
                    placeholder="Type your initial message here..."
                >{{ old('content') }}</textarea>
            </div>

            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">Start Conversation</button>
                <a href="{{ route('messages.index') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
