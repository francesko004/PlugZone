@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.popup.index') }}">Site-Wide Banners</a>
        <span>›</span>
        <span>New Alert Deployment</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Configure Site-Wide Alert</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Deploy modal interruptions for platform-wide announcements or maintenance notices.</p>
    </div>

    <div style="max-width: 800px;">
        <div class="card" style="padding: 40px; background: var(--dm-card-bg); border: 1px solid var(--dm-border-color); box-shadow: 0 4px 25px rgba(0,0,0,0.4);">
            <form action="{{ route('admin.popup.store') }}" method="POST">
                @csrf

                <div class="form-group" style="margin-bottom: 30px;">
                    <label class="form-label" style="font-weight: 800; text-transform: uppercase; font-size: 11px; color: var(--dm-text-secondary); letter-spacing: 1px; margin-bottom: 12px;">Alert Identity (Internal Protocol Name)</label>
                    <input type="text" name="title" class="form-input" 
                           style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #fff; font-size: 15px; padding: 12px 15px;"
                           value="{{ old('title') }}" placeholder="e.g. MONERO NODE MAINTENANCE" required>
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 8px; font-style: italic;">Internal reference name for this alert configuration.</p>
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label class="form-label" style="font-weight: 800; text-transform: uppercase; font-size: 11px; color: var(--dm-text-secondary); letter-spacing: 1px; margin-bottom: 12px;">Broadcast Payload (User Facing Message)</label>
                    <textarea name="message" class="form-input" rows="7" 
                              style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #fff; line-height: 1.6; font-size: 14px;"
                              placeholder="Describe the alert or maintenance event clearly for the end user..." required>{{ old('message') }}</textarea>
                </div>

                <div style="padding: 25px; background: rgba(0, 168, 225, 0.04); border-radius: 4px; border: 1px solid rgba(0, 168, 225, 0.2); margin-bottom: 35px;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h4 style="margin: 0; font-size: 13px; font-weight: 800; color: #00a8e1; text-transform: uppercase; letter-spacing: 0.5px;">Immediate Deployment Protocol</h4>
                            <p style="margin: 5px 0 0 0; font-size: 11px; color: var(--dm-text-secondary);">Activating this will instantly override any current active alerts.</p>
                        </div>
                        <label style="position: relative; display: inline-block; width: 50px; height: 26px; cursor: pointer;">
                            <input type="checkbox" name="active" value="1" {{ old('active') ? 'checked' : '' }} style="opacity: 0; width: 0; height: 0;">
                            <span style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(255,255,255,0.1); transition: .25s; border-radius: 34px; border: 1px solid rgba(255,255,255,0.1);"></span>
                            <span class="active-slider" style="position: absolute; content: ''; height: 18px; width: 18px; left: 4px; bottom: 3px; background-color: #fff; transition: .25s; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></span>
                        </label>
                    </div>
                </div>

                <style>
                    input:checked + span { background-color: #00cc66 !important; border-color: #00cc66 !important; }
                    input:checked + span + .active-slider { transform: translateX(24px); }
                </style>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--dm-border-color); padding-top: 30px;">
                    <a href="{{ route('admin.popup.index') }}" style="color: var(--dm-text-secondary); font-size: 13px; font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--dm-text-secondary)'">Discard Draft</a>
                    <button type="submit" class="btn btn-primary" style="padding: 12px 50px; border-radius: 4px; font-weight: 900; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(255, 216, 20, 0.2);">PUBLISH BROADCAST</button>
                </div>
            </form>
        </div>

        <div class="card" style="margin-top: 35px; padding: 25px; background: rgba(255, 153, 0, 0.04); border: 1px solid rgba(255, 153, 0, 0.2); border-left: 5px solid #ff9900;">
            <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 900; color: #ff9900; text-transform: uppercase; letter-spacing: 1px;">UX Considerations</h4>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.8; margin: 0;">Pop-ups are highly disruptive and force absolute user interaction. Use sparingly for critical infrastructure updates or security disclosures. For general announcements, utilize the <strong>Outreach Services (Bulk Messaging)</strong> tool to maintain user workflow continuity.</p>
        </div>
    </div>
</div>
@endsection
