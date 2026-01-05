@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.bulk-message.list') }}">Outreach Services</a>
        <span>›</span>
        <span>New Campaign</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Compose Global Outreach</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Dispatch platform-wide announcements or targeted group notifications.</p>
    </div>

    <div style="max-width: 800px;">
        <div class="card" style="padding: 40px; background: var(--dm-card-bg); border: 1px solid var(--dm-border-color); box-shadow: 0 4px 25px rgba(0,0,0,0.4);">
            <form action="{{ route('admin.bulk-message.send') }}" method="POST">
                @csrf
                
                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="title" class="form-label" style="font-weight: 800; text-transform: uppercase; font-size: 11px; color: var(--dm-text-secondary); letter-spacing: 1px; margin-bottom: 12px;">Campaign Transmission Title</label>
                    <input type="text" name="title" id="title" class="form-input" 
                           style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #fff; font-size: 15px; padding: 12px 15px;"
                           placeholder="e.g. SYSTEM UPGRADE NOTIFICATION: FEB 01" required>
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 8px; font-style: italic;">This subject line identifies the notification in the recipient's secure inbox.</p>
                </div>

                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="target_role" class="form-label" style="font-weight: 800; text-transform: uppercase; font-size: 11px; color: var(--dm-text-secondary); letter-spacing: 1px; margin-bottom: 12px;">Target Audience Protocol</label>
                    <select name="target_role" id="target_role" class="form-input" style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #f0c14b; font-weight: 700; cursor: pointer;">
                        <option value="">🌐 GLOBAL BROADCAST (ALL REGISTERED ENTITIES)</option>
                        <option value="vendor">⚔️ VENDOR COHORT ONLY</option>
                        <option value="admin">🛡️ ADMINISTRATIVE STAFF ONLY</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 40px;">
                    <label for="message" class="form-label" style="font-weight: 800; text-transform: uppercase; font-size: 11px; color: var(--dm-text-secondary); letter-spacing: 1px; margin-bottom: 12px;">Dispatch Payload (Markdown Supported)</label>
                    <textarea name="message" id="message" class="form-input" rows="10" 
                              style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #fff; line-height: 1.6; font-size: 14px;"
                              placeholder="Describe the platform event or announcement. PGP encryption is automatically handled for sensitive transmissions." required></textarea>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--dm-border-color); padding-top: 30px;">
                    <a href="{{ route('admin.bulk-message.list') }}" style="color: var(--dm-text-secondary); font-size: 13px; font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--dm-text-secondary)'">Discard Draft</a>
                    <button type="submit" class="btn btn-primary" style="padding: 12px 50px; border-radius: 4px; font-weight: 900; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(255, 216, 20, 0.2);" onclick="return confirm('Authorize secure global transmission? This protocol will populate targeted user inboxes instantly.')">
                        EXECUTE DISPATCH
                    </button>
                </div>
            </form>
        </div>

        <div class="card" style="margin-top: 35px; padding: 25px; background: rgba(255, 153, 0, 0.04); border: 1px solid rgba(255, 153, 0, 0.2); border-left: 5px solid #ff9900;">
            <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 900; color: #ff9900; text-transform: uppercase; letter-spacing: 1px;">Operational Safeguards</h4>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.8; margin: 0;">Bulk outreach is a high-visibility operation. Frequent platform-wide dispatches should be limited to critical infrastructure status updates. For emergency modal interruptions (real-time lockouts), utilize the <strong>Autonomous Alert (Pop-ups)</strong> module for immediate circuit dominance.</p>
        </div>
    </div>
</div>
@endsection
