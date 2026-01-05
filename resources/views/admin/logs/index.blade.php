@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Diagnostic Logs</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Marketplace Diagnostic Central</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Monitor platform health, track exceptions, and review system audit trails.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px;">
        
        <!-- Logic Group: Critical & Errors -->
        <div class="card" style="padding: 30px; border-top: 5px solid #ff4444; background: var(--dm-card-bg); box-shadow: 0 4px 20px rgba(0,0,0,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                <div style="width: 54px; height: 54px; background: rgba(255, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid rgba(255, 68, 68, 0.2);">🚨</div>
                <div>
                    <h2 style="margin: 0; font-size: 17px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Critical Events</h2>
                    <span style="font-size: 10px; color: #ff4444; font-weight: 800; letter-spacing: 1px;">HIGH PRIORITY</span>
                </div>
            </div>
            <p style="color: var(--dm-text-secondary); font-size: 13px; line-height: 1.7; margin-bottom: 35px; height: 60px;">Analysis of Error, Critical, Alert, and Emergency system exceptions requiring immediate intervention protocols.</p>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <a href="{{ route('admin.logs.show', 'error') }}" class="btn btn-primary" style="width: 100%; text-align: center; border-radius: 4px; font-weight: 700; padding: 12px; box-shadow: 0 2px 8px rgba(255, 216, 20, 0.2);">MONITOR ERROR STREAM</a>
                <form action="{{ route('admin.logs.delete', ['type' => 'error']) }}" method="POST" onsubmit="return confirm('Purge all critical logs? Historical data will be unrecoverable.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="width: 100%; color: #ff4444; border-color: rgba(255, 68, 68, 0.3); font-size: 11px; font-weight: 700; padding: 10px; text-transform: uppercase;">Flush Critical Buffer</button>
                </form>
            </div>
        </div>

        <!-- Logic Group: Warnings & Notices -->
        <div class="card" style="padding: 30px; border-top: 5px solid #ff9900; background: var(--dm-card-bg); box-shadow: 0 4px 20px rgba(0,0,0,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                <div style="width: 54px; height: 54px; background: rgba(255, 153, 0, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid rgba(255, 153, 0, 0.2);">⚠️</div>
                <div>
                    <h2 style="margin: 0; font-size: 17px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">Runtime Warnings</h2>
                    <span style="font-size: 10px; color: #ff9900; font-weight: 800; letter-spacing: 1px;">PLATFORM DRIFT</span>
                </div>
            </div>
            <p style="color: var(--dm-text-secondary); font-size: 13px; line-height: 1.7; margin-bottom: 35px; height: 60px;">Non-critical Warning and Notice telemetry for monitoring infrastructure stability and deprecated features.</p>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <a href="{{ route('admin.logs.show', 'warning') }}" class="btn btn-secondary" style="width: 100%; text-align: center; border-radius: 4px; font-weight: 700; padding: 12px; background: #37475a; border-color: #adb1b8; color: #fff;">REVIEW WARNINGS</a>
                <form action="{{ route('admin.logs.delete', ['type' => 'warning']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="width: 100%; font-size: 11px; font-weight: 700; padding: 10px; text-transform: uppercase; border-color: var(--dm-border-color);">Clear Warning Cache</button>
                </form>
            </div>
        </div>

        <!-- Logic Group: Information & Metrics -->
        <div class="card" style="padding: 30px; border-top: 5px solid #00a8e1; background: var(--dm-card-bg); box-shadow: 0 4px 20px rgba(0,0,0,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                <div style="width: 54px; height: 54px; background: rgba(0, 168, 225, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid rgba(0, 168, 225, 0.2);">ℹ️</div>
                <div>
                    <h2 style="margin: 0; font-size: 17px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.5px;">System Telemetry</h2>
                    <span style="font-size: 10px; color: #00a8e1; font-weight: 800; letter-spacing: 1px;">GENERAL AUDIT</span>
                </div>
            </div>
            <p style="color: var(--dm-text-secondary); font-size: 13px; line-height: 1.7; margin-bottom: 35px; height: 60px;">General platform activity logs including routine lifecycle events and verbose debugging traces.</p>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <a href="{{ route('admin.logs.show', 'info') }}" class="btn btn-secondary" style="width: 100%; text-align: center; border-radius: 4px; font-weight: 700; padding: 12px; background: #37475a; border-color: #adb1b8; color: #fff;">ANALYZE ACTIVITY</a>
                <form action="{{ route('admin.logs.delete', ['type' => 'info']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline" style="width: 100%; font-size: 11px; font-weight: 700; padding: 10px; text-transform: uppercase; border-color: var(--dm-border-color);">Purge Verbose Logs</button>
                </form>
            </div>
        </div>

    </div>

    <div class="card" style="margin-top: 40px; padding: 30px; background: rgba(0, 168, 225, 0.04); border: 1px solid rgba(0, 168, 225, 0.15); border-radius: 8px;">
        <div style="display: flex; gap: 20px; align-items: center;">
            <div style="font-size: 24px; filter: drop-shadow(0 0 10px rgba(0, 168, 225, 0.3));">🛡️</div>
            <div>
                <h3 style="margin: 0 0 5px 0; font-size: 14px; font-weight: 800; color: #00a8e1; text-transform: uppercase; letter-spacing: 1px;">Platform Retention Protocols</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); line-height: 1.6; margin: 0; max-width: 900px;">Diagnostic logs are buffered directly in the persistent database. To preserve optimal query performance and TOR circuit responsiveness, periodic buffer purging is mandated. High-volume telemetry should be restricted to active development windows.</p>
            </div>
        </div>
    </div>
</div>
@endsection
