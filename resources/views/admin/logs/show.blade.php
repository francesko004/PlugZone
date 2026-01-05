@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.logs') }}">Diagnostic Logs</a>
        <span>›</span>
        <span>{{ strtoupper($type) }} Stream</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">{{ ucfirst($type) }} Telemetry Stream</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Analyzing real-time system events and application exceptions.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.logs') }}" class="btn btn-secondary btn-sm" style="border-radius: 8px;">‹ System Overview</a>
        </div>
    </div>

    <div class="card" style="padding: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.2); border: 1px solid var(--dm-border-color);">
        <form action="{{ route('admin.logs.show', $type) }}" method="GET" style="display: flex; gap: 10px; flex: 1; max-width: 600px;">
            <input type="text" name="search" placeholder="Filter log stream (e.g. 'timeout', 'db_error', 'UID:5')..." value="{{ $searchQuery ?? '' }}" 
                   class="form-input" style="background: var(--dm-card-bg); font-size: 13px; border-radius: 8px; border-color: var(--dm-border-color);">
            <button type="submit" class="btn btn-primary btn-sm" style="white-space: nowrap; border-radius: 8px;">Filter Stream</button>
            @if(isset($searchQuery) && $searchQuery)
                <a href="{{ route('admin.logs.show', $type) }}" class="btn btn-outline btn-sm" style="display: flex; align-items: center; border-radius: 8px;">Clear</a>
            @endif
        </form>
        
        <div style="font-size: 12px; color: var(--dm-text-secondary); font-weight: 500;">
            Buffer Capacity: <strong style="color: var(--dm-text-main);">{{ count($logs) }} lines</strong>
        </div>
    </div>

    <form action="{{ route('admin.logs.delete-selected', $type) }}" method="POST" id="logsDeleteForm">
        @csrf
        @method('DELETE')
        
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--dm-border-color); background: #0b0e11;">
            <div style="padding: 18px 25px; background: #131921; border-bottom: 2px solid var(--dm-border-color); display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <label style="display: flex; align-items: center; gap: 12px; font-size: 11px; cursor: pointer; color: var(--dm-text-secondary); text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">
                        <input type="checkbox" id="selectAllLogs" style="width: 18px; height: 18px; cursor: pointer; accent-color: #ff9900;"> 
                        <span>Bulk Selection Protocol</span>
                    </label>
                    <button type="submit" class="btn btn-danger btn-sm" style="font-size: 10px; padding: 6px 18px; border-radius: 4px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;" onclick="return confirm('Purge selected diagnostic lines from the buffer?')">Delete Selected Records</button>
                </div>
                <div style="font-size: 10px; color: var(--dm-text-secondary); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                    Stream Health: <span style="color: #00cc66;">OPTIMAL</span>
                </div>
            </div>

            <div style="max-height: 800px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse; font-family: 'JetBrains Mono', 'Fira Code', 'Courier New', monospace;">
                    <thead style="position: sticky; top: 0; background: #232f3e; z-index: 10; border-bottom: 2px solid var(--dm-border-color);">
                        <tr>
                            <th style="width: 60px; padding: 15px 25px;"></th>
                            <th style="text-align: left; padding: 15px 25px; color: #fff; width: 220px; text-transform: uppercase; letter-spacing: 1px; font-size: 10px; font-weight: 800;">Timestamp (UTC)</th>
                            <th style="text-align: left; padding: 15px 25px; color: #fff; width: 140px; text-transform: uppercase; letter-spacing: 1px; font-size: 10px; font-weight: 800;">Severity Level</th>
                            <th style="text-align: left; padding: 15px 25px; color: #fff; text-transform: uppercase; letter-spacing: 1px; font-size: 10px; font-weight: 800;">Telemetric Payload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.1s;" onmouseover="this.style.background='rgba(51, 153, 255, 0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 16px 25px; text-align: center;">
                                    <input type="checkbox" name="selected_logs[]" value="{{ $log['id'] }}" class="log-checkbox" style="width: 16px; height: 16px; cursor: pointer; accent-color: #ff9900;">
                                </td>
                                <td style="padding: 16px 25px; color: #888; white-space: nowrap; font-size: 11px; font-weight: 500;">
                                    [{{ $log['datetime'] }}]
                                </td>
                                <td style="padding: 16px 25px;">
                                    <span style="display: inline-block; font-weight: 800; padding: 4px 10px; border-radius: 2px; font-size: 9px; text-transform: uppercase; letter-spacing: 1px;
                                        @if(in_array(strtolower($log['type']), ['error', 'critical', 'alert', 'emergency'])) background: rgba(255, 68, 68, 0.15); color: #ff6666; border: 1px solid rgba(255, 68, 68, 0.3);
                                        @elseif(in_array(strtolower($log['type']), ['warning', 'notice'])) background: rgba(255, 153, 0, 0.15); color: #ffad33; border: 1px solid rgba(255, 153, 0, 0.3);
                                        @else background: rgba(0, 168, 225, 0.15); color: #00ccff; border: 1px solid rgba(0, 168, 225, 0.3);
                                        @endif
                                    ">
                                        {{ $log['type'] }}
                                    </span>
                                </td>
                                <td style="padding: 16px 25px;">
                                    <div style="word-break: break-all; color: #d1d5db; line-height: 1.6; font-size: 12px; font-weight: 400;">
                                        <span style="color: #6b7280; margin-right: 5px;">$</span>{{ $log['message'] }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 120px; text-align: center; background: #0b0e11;">
                                    <div style="font-size: 48px; margin-bottom: 25px; opacity: 0.3;">📡</div>
                                    <div style="font-size: 14px; color: var(--dm-text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">
                                        No active telemetry found for {{ strtoupper($type) }} stream.
                                    </div>
                                    <div style="font-size: 11px; color: #444; margin-top: 10px;">BUFFER PURGED OR SYSTEM QUIET</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('selectAllLogs').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.log-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
