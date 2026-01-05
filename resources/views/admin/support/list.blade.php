@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Service Desk</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Support Help Desk</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Manage incoming user inquiries and provide platform assistance.</p>
    </div>

    @if($requests->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 15px;">🎧</div>
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">No Pending Requests</h2>
            <p style="color: var(--dm-text-secondary);">The support queue is currently clear. All user tickets have been addressed.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color);">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">{{ $requests->total() }} Support Tickets</span>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: #232f3e; border-bottom: 1px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 12px 20px; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Reference</th>
                        <th style="text-align: left; padding: 12px 20px; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Ticket Summary</th>
                        <th style="text-align: left; padding: 12px 20px; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Requestor</th>
                        <th style="text-align: center; padding: 12px 20px; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                        <th style="text-align: right; padding: 12px 20px; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; color: var(--dm-primary-btn); font-family: 'Inter', monospace; font-size: 14px;">#TK-{{ strtoupper(substr($request->ticket_id, 0, 8)) }}</div>
                                <div style="font-size: 12px; color: var(--dm-text-secondary); margin-top: 2px;">{{ $request->created_at->format('M d, Y') }}</div>
                            </td>
                            <td style="padding: 15px 20px; max-width: 300px;">
                                <div style="font-weight: 500; color: var(--dm-text-main); font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $request->title }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 4px;">Activity: {{ $request->latestMessage ? $request->latestMessage->created_at->diffForHumans() : 'N/A' }}</div>
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 600; font-size: 14px;">{{ $request->user->username }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary);">UID: {{ $request->user_id }}</div>
                            </td>
                            <td style="padding: 15px 20px; text-align: center;">
                                @php
                                    $statusStyle = match($request->status) {
                                        'open' => 'background: rgba(0, 113, 133, 0.15); color: #00a8e1; border: 1px solid rgba(0, 168, 225, 0.3);',
                                        'in_progress' => 'background: rgba(255, 153, 0, 0.1); color: #ff9900; border: 1px solid rgba(255, 153, 0, 0.3);',
                                        'closed' => 'background: rgba(0, 134, 0, 0.1); color: #00bb00; border: 1px solid rgba(0, 187, 0, 0.3);',
                                        default => 'background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); border: 1px solid var(--dm-border-color);'
                                    };
                                @endphp
                                <span style="display: inline-block; min-width: 100px; text-align: center; font-size: 11px; font-weight: 700; padding: 6px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; {{ $statusStyle }}">
                                    {{ str_replace('_', ' ', $request->status) }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <a href="{{ route('admin.support.show', $request->ticket_id) }}" class="btn btn-secondary btn-sm" style="padding: 6px 16px; border-radius: 4px; font-size: 12px; font-weight: 600; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">View Case</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $requests->links('components.pagination') }}
        </div>
    @endif
</div>
@endsection
