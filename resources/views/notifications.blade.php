@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Notifications</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Your Notifications</h1>

    @if($notifications->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🔔</div>
            <h2 style="font-size: 24px; font-weight: 400; margin-bottom: 10px;">No notifications</h2>
            <p style="color: var(--dm-text-secondary); margin-bottom: 30px;">You're all caught up! New updates will appear here.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @foreach($notifications as $notification)
                <div class="card" style="padding: 20px; position: relative; {{ !$notification->pivot->read ? 'border-left: 4px solid #ff9900;' : '' }}">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: {{ !$notification->pivot->read ? '#fff' : 'var(--dm-text-secondary)' }}">
                            {{ $notification->title }}
                        </h3>
                        <span style="font-size: 12px; color: var(--dm-text-secondary);">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.5; color: var(--dm-text-main);">
                        {{ $notification->message }}
                    </p>

                    <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: center;">
                        @if(!$notification->pivot->read)
                            <form method="POST" action="{{ route('notifications.mark-read', ['notification' => $notification->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline btn-sm">Mark as Read</button>
                            </form>
                        @endif
                        
                        <form method="POST" action="{{ route('notifications.destroy', ['notification' => $notification->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm" style="color: var(--color-danger); border-color: transparent;" onclick="return confirm('Delete this notification?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 30px;">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection
