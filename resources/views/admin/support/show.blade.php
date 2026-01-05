@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.support.requests') }}">Service Desk</a>
        <span>›</span>
        <span>Case ID: {{ strtoupper(substr($supportRequest->ticket_id, 0, 8)) }}</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Support Workspace</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Subject: <span style="font-weight: 700; color: var(--dm-text-main);">{{ $supportRequest->title }}</span></p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.support.requests') }}" class="btn btn-secondary btn-sm" style="border-radius: 8px;">‹ Back to Queue</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 25px; align-items: start;">
        <!-- Left: Communication Thread -->
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <div class="card" style="padding: 30px; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg);">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 30px; color: var(--dm-text-main); text-transform: uppercase; letter-spacing: 0.5px;">Correspondence Ledger</h3>
                
                <div style="display: flex; flex-direction: column; gap: 28px; margin-bottom: 40px;">
                    @foreach($messages as $message)
                        <div style="display: flex; flex-direction: column; max-width: 85%; 
                            @if($message->is_admin_reply) align-self: flex-end; @else align-self: flex-start; @endif
                        ">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 11px; padding: 0 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <span style="font-weight: 800; color: @if($message->is_admin_reply) #00a8e1 @else #ff9900 @endif;">
                                    @if($message->is_admin_reply) 🛡️ PLATFORM STAFF (@if($message->user_id === Auth::id()) YOU @else {{ strtoupper($message->user->username) }} @endif)
                                    @else 👤 END USER: {{ strtoupper($message->user->username) }}
                                    @endif
                                </span>
                                <span style="color: var(--dm-text-secondary);">{{ $message->created_at->format('M d, H:i') }}</span>
                            </div>
                            <div style="padding: 18px 22px; border-radius: 12px; font-size: 14px; line-height: 1.7; white-space: pre-wrap; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                                @if($message->is_admin_reply) 
                                    background: #232f3e; color: #fff; border: 1px solid #00a8e1; border-top-right-radius: 2px;
                                @else 
                                    background: rgba(255, 255, 255, 0.05); color: var(--dm-text-main); border: 1px solid var(--dm-border-color); border-top-left-radius: 2px;
                                @endif
                            ">{{ $message->message }}</div>
                        </div>
                    @endforeach
                </div>

                @if($supportRequest->status !== 'closed')
                    <div style="border-top: 1px solid var(--dm-border-color); padding-top: 30px;">
                        <form action="{{ route('admin.support.reply', $supportRequest->ticket_id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" style="font-weight: 700; margin-bottom: 12px; text-transform: uppercase; font-size: 12px; color: var(--dm-text-secondary);">Draft Official Response</label>
                                <textarea name="message" class="form-input" rows="7" style="background: rgba(0,0,0,0.3); border-color: var(--dm-border-color); color: #fff;" placeholder="Address the user's inquiry with platform precision..." required>{{ old('message') }}</textarea>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px;">
                                    <div style="display: flex; align-items: center; gap: 10px; color: var(--dm-text-secondary); font-size: 12px;">
                                        <div style="width: 8px; height: 8px; border-radius: 50%; background: #00cc66;"></div>
                                        <span>Encryption Active</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="padding: 12px 45px; border-radius: 4px; font-weight: 700; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">TRANSMIT RESPONSE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div style="padding: 50px; text-align: center; background: rgba(0,0,0,0.2); border-radius: 12px; border: 1px dashed var(--dm-border-color);">
                        <div style="font-size: 40px; margin-bottom: 20px; opacity: 0.5;">🗃️</div>
                        <h3 style="margin: 0; color: var(--dm-text-main); font-size: 18px; font-weight: 700;">Case Internal Archive</h3>
                        <p style="color: var(--dm-text-secondary); margin-top: 10px; font-size: 13px; max-width: 400px; margin-left: auto; margin-right: auto;">Communication is decommissioned for resolved cases. Transition status to "Active" to re-initiate outreach protocol.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Case Controls -->
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <div class="card" style="padding: 24px; border: 1px solid var(--dm-border-color); background: rgba(35, 47, 62, 0.3);">
                <h3 style="margin: 0 0 20px 0; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--dm-text-secondary);">Case Identification</h3>
                
                <div style="display: flex; flex-direction: column; gap: 18px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: var(--dm-text-secondary);">Reference:</span>
                        <span style="font-family: 'Inter', monospace; font-weight: 700; color: #fff;">#{{ strtoupper(substr($supportRequest->ticket_id, 0, 14)) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: var(--dm-text-secondary);">Deployment:</span>
                        <span style="font-weight: 500;">{{ $supportRequest->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    <div style="border-top: 1px solid var(--dm-border-color); margin: 5px 0; padding-top: 18px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="color: var(--dm-text-secondary);">User ID:</span>
                            <span style="font-weight: 800; color: var(--dm-primary-btn);">{{ $supportRequest->user->username }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--dm-text-secondary);">Clearance:</span>
                            <span style="font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: 4px; background: rgba(255,255,255,0.08); border: 1px solid var(--dm-border-color); text-transform: uppercase;">{{ $supportRequest->user->roles->first()->name ?? 'USER' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 24px; border: 1px solid var(--dm-border-color); border-top: 3px solid #00a8e1;">
                <h3 style="margin: 0 0 20px 0; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--dm-text-secondary);">Lifecycle Management</h3>
                
                <form action="{{ route('admin.support.status', $supportRequest->ticket_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-bottom: 20px;">
                        <select name="status" class="form-input" style="font-size: 13px; background: rgba(0,0,0,0.3); border-radius: 4px; font-weight: 600; color: #fff;">
                            <option value="open" {{ $supportRequest->status === 'open' ? 'selected' : '' }}>PENDING INITIAL REVIEW</option>
                            <option value="in_progress" {{ $supportRequest->status === 'in_progress' ? 'selected' : '' }}>ACTIVE INVESTIGATION</option>
                            <option value="closed" {{ $supportRequest->status === 'closed' ? 'selected' : '' }}>RESOLVED / ARCHIVED</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block" style="border-radius: 4px; font-weight: 700; padding: 12px; font-size: 12px; background: #37475a; color: #fff; border-color: #adb1b8;">COMMIT STATUS UPDATE</button>
                </form>
            </div>

            <div class="card" style="padding: 24px; border: 1px solid var(--dm-border-color); background: rgba(255, 153, 0, 0.03);">
                <h4 style="margin: 0 0 15px 0; font-size: 13px; font-weight: 800; color: #ff9900; text-transform: uppercase;">Platform Protocols</h4>
                <ul style="margin: 0; padding-left: 15px; font-size: 12px; color: var(--dm-text-secondary); line-height: 1.7;">
                    <li style="margin-bottom: 8px;">Validate PGP identity for credential resets.</li>
                    <li style="margin-bottom: 8px;">Shield internal infrastructure details.</li>
                    <li>Close resolved cases to purge memory buffers.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
