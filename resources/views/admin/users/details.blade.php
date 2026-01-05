@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.users') }}">User Directory</a>
        <span>›</span>
        <span>Account Details</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Account: <span style="font-weight: 700;">{{ $user->username }}</span></h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('dashboard', ['username' => $user->username]) }}" class="btn btn-secondary btn-sm" target="_blank">View Profile</a>
            <a href="{{ route('admin.users') }}" class="btn btn-outline btn-sm">Return to List</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Left: Account Details & Roles -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="card" style="padding: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Account Metadata</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Unique Identifier</label>
                        <div style="font-family: monospace; font-size: 14px;">{{ $user->id }}</div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Reference ID</label>
                        <div style="font-family: monospace; font-size: 14px;">{{ $user->reference_id }}</div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Referred By</label>
                        <div style="font-size: 14px;">{{ $user->referred_by ? $user->referrer->username : 'Direct signup' }}</div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Account Type</label>
                        <div style="font-size: 14px; font-weight: 700;">{{ strtoupper($user->role) }}</div>
                    </div>
                </div>

                <div style="margin-top: 30px; padding-top: 25px; border-top: 1px solid var(--dm-border-color); display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Registration Date</label>
                        <div style="font-size: 14px;">{{ $user->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; margin-bottom: 5px;">Last Activity</label>
                        <div style="font-size: 14px;">{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</div>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Permissions & Roles</h3>
                <form action="{{ route('admin.users.update-roles', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="display: flex; gap: 40px; margin-bottom: 30px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="roles[]" value="admin" {{ $user->hasRole('admin') ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #ff9900;">
                            <span style="font-size: 15px;">Administrator Access</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="roles[]" value="vendor" {{ $user->hasRole('vendor') ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #ff9900;">
                            <span style="font-size: 15px;">Vendor Privileges</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update User Roles</button>
                </form>
            </div>
        </div>

        <!-- Right: Enforcement & Banning -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="card" style="padding: 30px; border-top: 4px solid #ff4444;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 25px;">Account Enforcement</h3>

                @if ($user->isBanned())
                    <div style="padding: 20px; background: rgba(255, 68, 68, 0.1); border: 1px solid rgba(255, 68, 68, 0.2); border-radius: 8px; margin-bottom: 25px;">
                        <div style="font-weight: 700; color: #ff4444; margin-bottom: 10px;">🛡️ Account Suspended</div>
                        <div style="font-size: 13px; margin-bottom: 5px;"><strong>Expires:</strong> {{ $user->bannedUser->banned_until->format('Y-m-d H:i') }}</div>
                        <div style="font-size: 13px;"><strong>Reason:</strong> {{ $user->bannedUser->reason }}</div>
                    </div>
                    <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" style="width: 100%;">Reactivate Account</button>
                    </form>
                @else
                    <form action="{{ route('admin.users.ban', $user) }}" method="POST">
                        @csrf
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="form-label">Suspension Reason</label>
                            <input type="text" name="reason" class="form-input" required placeholder="e.g. Terms of Service violation">
                        </div>
                        <div class="form-group" style="margin-bottom: 25px;">
                            <label class="form-label">Duration (Days)</label>
                            <input type="number" name="duration" class="form-input" min="1" required value="7">
                        </div>
                        <button type="submit" class="btn btn-danger" style="width: 100%;">Suspend Account</button>
                    </form>
                @endif
            </div>

            <div class="card" style="padding: 25px; background: rgba(255, 153, 0, 0.02);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700;">Account Auditing</h4>
                <p style="font-size: 11px; line-height: 1.5; color: var(--dm-text-secondary); margin: 0;">Any changes to user roles or suspension status are logged in the system security audit trails for accountability.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
