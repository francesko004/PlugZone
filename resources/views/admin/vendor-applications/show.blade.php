@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <a href="{{ route('admin.vendor-applications.index') }}">Onboarding Queue</a>
        <span>›</span>
        <span>Case ID: {{ $application->id }}</span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Vendor Verification Review</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Applicant: <span style="font-weight: 700; color: #ff9900;">{{ $application->user->username }}</span></p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.vendor-applications.index') }}" class="btn btn-outline btn-sm">Return to Queue</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Left: Application Evidence -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            <div class="card" style="padding: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Applicant Statement</h3>
                <div style="background: rgba(255, 255, 255, 0.02); padding: 25px; border-radius: 8px; border: 1px solid var(--dm-border-color); line-height: 1.6; font-size: 14px; white-space: pre-wrap;">{{ $application->application_text }}</div>
            </div>

            @if($application->application_images)
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Proof of Capability</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                        @foreach(json_decode($application->application_images) as $image)
                            <div style="border: 1px solid var(--dm-border-color); border-radius: 4px; overflow: hidden; background: #fff; height: 180px;">
                                <img src="{{ route('admin.vendor-applications.show', ['application' => $application, 'image' => $image]) }}" 
                                     style="width: 100%; height: 100%; object-fit: contain;" 
                                     alt="Security Proof">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($application->application_status !== 'waiting')
                <div class="card" style="padding: 30px;">
                    <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; margin-bottom: 25px;">Final Determination</h3>
                    <div style="padding: 25px; border-radius: 8px; border: 1px solid {{ $application->application_status === 'accepted' ? '#00cc66' : '#ff4444' }}; background: {{ $application->application_status === 'accepted' ? 'rgba(0, 204, 102, 0.05)' : 'rgba(255, 68, 68, 0.05)' }};">
                        <div style="font-weight: 700; font-size: 16px; color: {{ $application->application_status === 'accepted' ? '#00cc66' : '#ff4444' }}; margin-bottom: 10px;">
                            Verdict: {{ strtoupper($application->application_status) }}
                        </div>
                        <p style="font-size: 14px; margin: 0;">Reviewed and processed on <strong>{{ $application->admin_response_at->format('Y-m-d H:i') }}</strong>.</p>
                        
                        @if($application->application_status === 'denied' && $application->refund_amount)
                            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(255, 68, 68, 0.2);">
                                <div style="font-weight: 700; font-size: 13px; margin-bottom: 5px;">Return Funds Progress</div>
                                <div style="font-size: 13px;">{{ $application->refund_amount }} XMR issued to: <span style="font-family: monospace; font-size: 11px;">{{ $application->refund_address }}</span></div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Right: Case Metadata & Actions -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Identity Metadata</h3>
                
                <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Application ID:</span>
                        <span style="font-family: monospace;">{{ $application->id }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Submitted:</span>
                        <span>{{ $application->application_submitted_at->format('Y-m-d') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--dm-border-color); padding-top: 15px;">
                        <span style="color: var(--dm-text-secondary);">Financial Stake:</span>
                        <span style="font-weight: 700;">{{ $application->total_received }} XMR</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--dm-text-secondary);">Role Status:</span>
                        <span>{{ strtoupper($application->user->role) }}</span>
                    </div>
                </div>
            </div>

            @if($application->application_status === 'waiting')
                <div class="card" style="padding: 25px; border-top: 4px solid #ff9900;">
                    <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 25px;">Administrative Verdict</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <form action="{{ route('admin.vendor-applications.accept', $application) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return confirm('Authorize this user for vendor privileges?')">Approve Merchant</button>
                        </form>
                        <form action="{{ route('admin.vendor-applications.deny', $application) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Deny this application and initiate refund process?')">Deny Application</button>
                        </form>
                    </div>
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 20px; line-height: 1.4; text-align: center;">Decisions are permanent and will be communicated to the user via platform notification.</p>
                </div>
            @endif

            <div class="card" style="padding: 20px; background: rgba(51, 153, 255, 0.03); border: 1px solid rgba(51, 153, 255, 0.1);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: #3399ff;">Audit Log Protection</h4>
                <p style="font-size: 11px; line-height: 1.5; color: var(--dm-text-secondary); margin: 0;">This review session is recorded. Administrative overrides and final verdicts are archived for marketplace integrity auditing.</p>
            </div>
        </div>
    </div>
</div>
@endsection
