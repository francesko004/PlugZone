@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <a href="{{ route('messages.index') }}">Your Messages</a>
        <span>›</span>
        <span>
            @if($conversation->user1->id == Auth::id())
                {{ $conversation->user2->username }}
            @else
                {{ $conversation->user1->username }}
            @endif
        </span>
    </div>

    <div class="card" style="padding: 0; display: flex; flex-direction: column; height: 70vh;">
        <!-- Chat Header -->
        <div style="padding: 15px 25px; border-bottom: 1px solid var(--dm-border-color); background: var(--dm-page-bg);">
            <h2 style="margin: 0; font-size: 18px; font-weight: 500;">
                Chat with 
                @if($conversation->user1->id == Auth::id())
                    {{ $conversation->user2->username }}
                @else
                    {{ $conversation->user1->username }}
                @endif
            </h2>
        </div>

        <!-- Messages Area -->
        <div style="flex: 1; overflow-y: auto; padding: 25px; display: flex; flex-direction: column; gap: 20px;">
            @foreach($messages as $message)
                <div style="max-width: 70%; {{ $message->sender_id == Auth::id() ? 'align-self: flex-end;' : 'align-self: flex-start;' }}">
                    <div style="padding: 12px 16px; border-radius: 12px; font-size: 14px; line-height: 1.5; {{ $message->sender_id == Auth::id() ? 'background: #0066c0; color: white; border-bottom-right-radius: 2px;' : 'background: var(--dm-page-bg); border: 1px solid var(--dm-border-color); border-bottom-left-radius: 2px;' }}">
                        {{ $message->content }}
                    </div>
                    <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 5px; {{ $message->sender_id == Auth::id() ? 'text-align: right;' : 'text-align: left;' }}">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer / Input Area -->
        <div style="padding: 20px; border-top: 1px solid var(--dm-border-color);">
            @if ($conversation->hasReachedMessageLimit())
                <div style="background: rgba(177, 39, 4, 0.1); border: 1px solid #b12704; color: #b12704; padding: 12px; border-radius: 4px; font-size: 13px; text-align: center;">
                    <strong>Limit Reached:</strong> This conversation has reached the 40 message limit. Please start a new one.
                </div>
            @else
                <form action="{{ route('messages.store', $conversation) }}" method="POST">
                    @csrf
                    <div style="display: flex; gap: 15px;">
                        <textarea name="content" class="form-input" style="height: 50px; resize: none; flex: 1;" placeholder="Write a message..." required minlength="4" maxlength="1600"></textarea>
                        <button type="submit" class="btn btn-primary" style="align-self: flex-end; height: 50px; padding: 0 25px;">Send</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
