@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Site-Wide Banners</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Alert Campaign Manager</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Configure and deploy critical modal announcements for the entire user base.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.popup.create') }}" class="btn btn-primary btn-sm">Deploy New Alert</a>
        </div>
    </div>

    @if($popups->count())
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg);">
            <div style="background: #131921; padding: 18px 25px; border-bottom: 2px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 13px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 1px;">Alert Deployment Registry</span>
                <span style="font-size: 11px; color: var(--dm-text-secondary); font-weight: 700;">{{ $popups->total() }} CONFIGURATIONS LOADED</span>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: #232f3e; border-bottom: 2px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 15px 25px; font-size: 11px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 1px;">Campaign Identity</th>
                        <th style="text-align: left; padding: 15px 25px; font-size: 11px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 1px;">Payload Preview</th>
                        <th style="text-align: center; padding: 15px 25px; font-size: 11px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 1px; width: 220px;">Operational Status</th>
                        <th style="text-align: right; padding: 15px 25px; font-size: 11px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 1px; width: 250px;">Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popups as $popup)
                        <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.15s;" onmouseover="this.style.background='rgba(51, 153, 255, 0.02)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 18px 25px;">
                                <div style="font-weight: 700; color: #fff; font-size: 14px; margin-bottom: 4px;">{{ $popup->title }}</div>
                                <div style="font-size: 10px; color: var(--dm-text-secondary); font-family: monospace;">SIG: #POP-{{ strtoupper(substr($popup->id, 0, 10)) }}</div>
                            </td>
                            <td style="padding: 18px 25px; max-width: 350px;">
                                <div style="font-size: 12px; color: var(--dm-text-main); line-height: 1.5; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $popup->message }}</div>
                                <div style="font-size: 10px; color: var(--dm-text-secondary); margin-top: 5px; font-weight: 600;">DEPLOYED: {{ $popup->created_at->format('M d, Y') }}</div>
                            </td>
                            <td style="padding: 18px 25px; text-align: center;">
                                <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 5px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px;
                                    @if($popup->active) background: rgba(0, 204, 102, 0.1); color: #00cc66; border: 1px solid rgba(0, 204, 102, 0.3);
                                    @else background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); border: 1px solid var(--dm-border-color);
                                    @endif
                                ">
                                    {{ $popup->active ? '📡 ACTIVE BROADCAST' : '⏹️ DECOMMISSIONED' }}
                                </span>
                            </td>
                            <td style="padding: 18px 25px; text-align: right;">
                                <div style="display: flex; gap: 10px; justify-content: flex-end; align-items: center;">
                                    @if(!$popup->active)
                                        <form action="{{ route('admin.popup.activate', $popup) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm" style="padding: 6px 15px; font-size: 11px; font-weight: 700; background: #37475a; border-color: #adb1b8; color: #fff; text-transform: uppercase;">Activate</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.popup.destroy', $popup) }}" method="POST" onsubmit="return confirm('Terminate this alert protocol permanently? Circuit dominance will be relinquished.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm" style="color: #ff6666; border-color: rgba(255, 102, 102, 0.3); font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 6px 15px;">Purge</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($popups->hasPages())
            <div style="margin-top: 30px;">
                {{ $popups->links('components.pagination') }}
            </div>
        @endif
    @else
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 15px;">🔕</div>
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">No Active Deployments</h2>
            <p style="color: var(--dm-text-secondary);">The alert system is quiet. No modal notifications are currently configured for deployment.</p>
        </div>
    @endif
</div>
@endsection
