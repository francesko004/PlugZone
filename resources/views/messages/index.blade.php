@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Messages</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Your Messages</h1>
        @if(!Auth::user()->hasReachedConversationLimit())
            <a href="{{ route('messages.create') }}" class="btn btn-primary">Start New Conversation</a>
        @endif
    </div>

    @if($conversations->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">✉️</div>
            <h2 style="font-size: 24px; font-weight: 400; margin-bottom: 10px;">No messages yet</h2>
            <p style="color: var(--dm-text-secondary); margin-bottom: 30px;">When you contact vendors, your conversations will appear here.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden;">
            @foreach($conversations as $conversation)
                <div style="display: flex; border-bottom: 1px solid var(--dm-border-color); position: relative; {{ $loop->last ? 'border-bottom: none;' : '' }}">
                    <a href="{{ route('messages.show', $conversation) }}" style="flex: 1; display: block; padding: 20px; text-decoration: none; color: inherit; transition: background 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-weight: 500; font-size: 16px;">
                                @if($conversation->user1->id == Auth::id())
                                    {{ $conversation->user2->username }}
                                @else
                                    {{ $conversation->user1->username }}
                                @endif
                            </span>
                            <span style="color: var(--dm-text-secondary); font-size: 12px;">
                                {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : 'No messages' }}
                            </span>
                        </div>
                        <p style="margin: 0; color: var(--dm-text-secondary); font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding-right: 40px;">
                            @if($conversation->messages->isNotEmpty())
                                {{ $conversation->messages->last()->content }}
                            @else
                                <span style="font-style: italic;">No messages yet...</span>
                            @endif
                        </p>
                    </a>
                    
                    <form action="{{ route('messages.destroy', $conversation) }}" method="POST" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline btn-sm" style="color: var(--color-danger); border-color: transparent;" onclick="return confirm('Delete this conversation?')" title="Delete">×</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 25px;">
            {{ $conversations->links() }}
        </div>
    @endif

    @if (Auth::user()->hasReachedConversationLimit())
        <div style="margin-top: 20px; background: rgba(177, 39, 4, 0.1); border: 1px solid #b12704; color: #b12704; padding: 15px; border-radius: 4px; font-size: 14px;">
            <strong>Limit Reached:</strong> You have 16 active conversations. Please delete some before creating new ones.
        </div>
    @endif
</div>
@endsection
