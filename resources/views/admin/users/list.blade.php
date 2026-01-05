@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>User Directory</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 5px;">User Directory</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin: 0;">Total platform accounts: {{ $users->total() }}</p>
        </div>
        
        <!-- Search placeholder - assuming form logic exists or can be added -->
        <form action="{{ route('admin.users') }}" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="search" class="form-input" placeholder="Search by username..." value="{{ request('search') }}" style="width: 250px;">
            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
        </form>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background: rgba(255, 255, 255, 0.03); border-bottom: 1px solid var(--dm-border-color);">
                    <th style="text-align: left; padding: 15px 20px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; font-size: 11px;">Username</th>
                    <th style="text-align: left; padding: 15px 20px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; font-size: 11px;">Role</th>
                    <th style="text-align: left; padding: 15px 20px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; font-size: 11px;">Creation Date</th>
                    <th style="text-align: right; padding: 15px 20px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase; font-size: 11px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 15px 20px;">
                            <div style="font-weight: 700;">{{ $user->username }}</div>
                        </td>
                        <td style="padding: 15px 20px;">
                            <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; 
                                @if($user->isAdmin()) background: rgba(255, 68, 68, 0.1); color: #ff4444; border: 1px solid rgba(255, 68, 68, 0.2); 
                                @elseif($user->isVendor()) background: rgba(255, 153, 0, 0.1); color: #ff9900; border: 1px solid rgba(255, 153, 0, 0.2);
                                @else background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); border: 1px solid var(--dm-border-color);
                                @endif
                            ">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td style="padding: 15px 20px; color: var(--dm-text-secondary);">
                            {{ $user->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td style="padding: 15px 20px; text-align: right;">
                            <a href="{{ route('admin.users.details', $user->username) }}" class="btn btn-outline btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        {{ $users->appends(request()->input())->links('components.pagination') }}
    </div>
</div>
@endsection
