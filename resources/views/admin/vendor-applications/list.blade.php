@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Onboarding Queue</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Seller Verification Queue</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Review and process incoming applications for vendor privileges.</p>
    </div>

    @if($applications->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 15px;">📥</div>
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">Queue Clear</h2>
            <p style="color: var(--dm-text-secondary);">No pending vendor applications require attention at this time.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">{{ $applications->total() }} Applications Found</span>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: rgba(0,0,0,0.2); border-bottom: 1px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Applicant</th>
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Submission Date</th>
                        <th style="text-align: center; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Review Status</th>
                        <th style="text-align: right; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; color: #ff9900;">{{ $application->user->username }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary);">UID: {{ $application->user->id }}</div>
                            </td>
                            <td style="padding: 15px 20px; color: var(--dm-text-secondary);">
                                {{ $application->application_submitted_at->format('Y-m-d H:i') }}
                            </td>
                            <td style="padding: 15px 20px; text-align: center;">
                                <span style="font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
                                    @if($application->application_status === 'waiting') background: rgba(51, 153, 255, 0.1); color: #3399ff;
                                    @elseif($application->application_status === 'accepted') background: rgba(0, 204, 102, 0.1); color: #00cc66;
                                    @else background: rgba(255, 68, 68, 0.1); color: #ff4444;
                                    @endif
                                ">
                                    @if($application->application_status === 'waiting') PENDING REVIEW
                                    @elseif($application->application_status === 'accepted') VERIFIED
                                    @else DENIED
                                    @endif
                                </span>
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <a href="{{ route('admin.vendor-applications.show', $application) }}" class="btn btn-secondary btn-sm" style="padding: 5px 15px;">Review Case</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $applications->links('components.pagination') }}
        </div>
    @endif
</div>
@endsection
