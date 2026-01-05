@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Global Broadcasts</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Marketplace Broadcasts</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Manage platform-wide announcements and bulk user notifications.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.bulk-message.create') }}" class="btn btn-primary btn-sm" style="border-radius: 8px;">Create Broadcast</a>
        </div>
    </div>

    @if($notifications->isEmpty())
        <div class="card" style="padding: 60px; text-align: center; border: 1px dashed var(--dm-border-color);">
            <div style="font-size: 40px; margin-bottom: 15px;">📢</div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 700;">No Broadcasts Sent</h3>
            <p style="color: var(--dm-text-secondary);">Platform-wide messaging history is currently empty.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg);">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: #232f3e; border-bottom: 2px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 15px 20px; color: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Transmission Payload</th>
                        <th style="text-align: left; padding: 15px 20px; color: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; width: 180px;">Audience Scope</th>
                        <th style="text-align: left; padding: 15px 20px; color: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; width: 180px;">Dispatch Date</th>
                        <th style="text-align: right; padding: 15px 20px; color: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; width: 220px;">Protocols</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        @if($notification->type === 'bulk')
                            <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.15s;" onmouseover="this.style.background='rgba(51, 153, 255, 0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 18px 20px;">
                                    <div style="font-weight: 700; color: #fff; font-size: 14px; margin-bottom: 4px;">{{ $notification->title }}</div>
                                    <div style="font-size: 10px; color: var(--dm-text-secondary); font-family: monospace;">UUID: {{ strtoupper($notification->id) }}</div>
                                </td>
                                <td style="padding: 18px 20px;">
                                    @if($notification->target_role)
                                        <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 4px; border: 1px solid rgba(255, 153, 0, 0.3); background: rgba(255, 153, 0, 0.05); color: #ff9900; text-transform: uppercase; letter-spacing: 0.5px;">
                                            🎯 {{ $notification->translated_role }}s Only
                                        </span>
                                    @else
                                        <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 4px; border: 1px solid rgba(0, 168, 225, 0.3); background: rgba(0, 168, 225, 0.05); color: #00a8e1; text-transform: uppercase; letter-spacing: 0.5px;">
                                            🌐 Platform-Wide
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 18px 20px; color: var(--dm-text-secondary); font-size: 12px; font-weight: 500;">
                                    {{ $notification->created_at->format('M d, Y') }}<br>
                                    <small style="opacity: 0.6;">{{ $notification->created_at->format('H:i:s') }} UTC</small>
                                </td>
                                <td style="padding: 18px 20px; text-align: right;">
                                    <form action="{{ route('admin.bulk-message.delete', $notification) }}" method="POST" onsubmit="return confirm('Archive record and remove from user inboxes? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm" style="color: #ff6666; border-color: rgba(255, 102, 102, 0.3); font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 6px 15px;">Decommission</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $notifications->links('components.pagination') }}
        </div>
    @endif
</div>
@endsection
