@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Marketplace Analytics</span>
    </div>

    <div style="margin-bottom: 35px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Global Marketplace Vitals</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Aggregate platform metrics, security adoption, and inventory distribution.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px;">
        
        <!-- User Demographics -->
        <div class="card" style="padding: 30px; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg); border-top: 3px solid #ff9900;">
            <h3 style="margin-top: 0; font-size: 13px; font-weight: 800; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; color: var(--dm-text-secondary);">User infrastructure</h3>
            
            <div style="display: flex; flex-direction: column; gap: 24px;">
                @foreach($usersByRole as $role)
                    @php 
                        $percentage = $totalUsers > 0 ? ($role->users_count / $totalUsers) * 100 : 0;
                    @endphp
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; align-items: flex-end;">
                            <span style="font-weight: 700; color: #fff;">{{ ucfirst($role->name) }} Units</span>
                            <span style="font-weight: 800; color: #fff;">{{ number_format($role->users_count) }} <small style="color: var(--dm-text-secondary); font-weight: 400; font-size: 11px;">({{ number_format($percentage, 1) }}%)</small></span>
                        </div>
                        <div style="height: 6px; background: rgba(255, 255, 255, 0.05); border-radius: 10px; overflow: hidden; border: 1px solid rgba(255,255,255,0.02);">
                            <div style="height: 100%; width: {{ $percentage }}%; background: #00a8e1; box-shadow: 0 0 12px rgba(0, 168, 225, 0.4);"></div>
                        </div>
                    </div>
                @endforeach

                <div style="margin-top: 10px; padding: 18px; background: rgba(255, 68, 68, 0.04); border: 1px solid rgba(255, 68, 68, 0.15); border-radius: 4px;">
                    <div style="display: flex; justify-content: space-between; font-size: 12px; align-items: center;">
                        <span style="color: #ff6666; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Decommissioned Units</span>
                        <span style="font-weight: 900; color: #ff6666; font-size: 16px;">{{ number_format($bannedUsersCount) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Adoption -->
        <div class="card" style="padding: 30px; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg); border-top: 3px solid #ff9900;">
            <h3 style="margin-top: 0; font-size: 13px; font-weight: 800; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; color: var(--dm-text-secondary);">Security Integrity</h3>
            
            <div style="display: flex; flex-direction: column; gap: 28px;">
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; align-items: flex-end;">
                        <span style="font-weight: 700; color: #fff;">PGP Identity Adoption</span>
                        <span style="font-weight: 800; color: #fff;">{{ number_format($totalPgpKeys) }} <small style="color: var(--dm-text-secondary); font-weight: 400; font-size: 11px;">({{ number_format($totalUsers > 0 ? ($totalPgpKeys / $totalUsers) * 100 : 0, 1) }}%)</small></span>
                    </div>
                    <div style="height: 6px; background: rgba(255, 255, 255, 0.05); border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalUsers > 0 ? ($totalPgpKeys / $totalUsers) * 100 : 0 }}%; background: #ff9900;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; align-items: flex-end;">
                        <span style="font-weight: 700; color: #fff;">Case Verification Protocol</span>
                        <span style="font-weight: 800; color: #fff;">{{ number_format($pgpVerificationRate, 1) }}%</span>
                    </div>
                    <div style="height: 6px; background: rgba(255, 255, 255, 0.05); border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $pgpVerificationRate }}%; background: #00cc66;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; align-items: flex-end;">
                        <span style="font-weight: 700; color: #fff;">Multi-Factor Enrollment</span>
                        <span style="font-weight: 800; color: #fff;">{{ number_format($twoFaAdoptionRate, 1) }}%</span>
                    </div>
                    <div style="height: 6px; background: rgba(255, 255, 255, 0.05); border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $twoFaAdoptionRate }}%; background: #00cc66;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Classification -->
        <div class="card" style="padding: 30px; border: 1px solid var(--dm-border-color); background: var(--dm-card-bg); border-top: 3px solid #ff9900;">
            <h3 style="margin-top: 0; font-size: 13px; font-weight: 800; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; color: var(--dm-text-secondary);">Inventory Classification</h3>
            
            <div style="display: flex; flex-direction: column; gap: 24px;">
                @foreach(['digital' => '#ac39ff', 'cargo' => '#3399ff', 'deaddrop' => '#00cc66'] as $type => $color)
                    @php 
                        $percentage = $totalProducts > 0 ? (($productsByType[$type] ?? 0) / $totalProducts) * 100 : 0;
                    @endphp
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; align-items: flex-end;">
                            <span style="font-weight: 700; color: #fff;">{{ ucfirst($type) }} Assets</span>
                            <span style="font-weight: 800; color: #fff;">{{ number_format($productsByType[$type] ?? 0) }} <small style="color: var(--dm-text-secondary); font-weight: 400; font-size: 11px;">({{ number_format($percentage, 1) }}%)</small></span>
                        </div>
                        <div style="height: 6px; background: rgba(255, 255, 255, 0.05); border-radius: 10px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $percentage }}%; background: {{ $color }};"></div>
                        </div>
                    </div>
                @endforeach
                
                <div style="margin-top: 5px; text-align: center; border-top: 1px solid var(--dm-border-color); padding-top: 20px;">
                    <span style="font-size: 11px; color: var(--dm-text-secondary); text-transform: uppercase; letter-spacing: 2px;">Total Marketplace Volume</span>
                    <div style="font-size: 28px; font-weight: 900; color: #fff; margin-top: 5px;">{{ number_format($totalProducts) }}</div>
                </div>
            </div>
        </div>

    </div>

    <div style="margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <div class="card" style="padding: 24px; border: 1px solid var(--dm-border-color); background: rgba(0, 168, 225, 0.03);">
            <h3 style="margin: 0 0 12px 0; font-size: 13px; font-weight: 800; color: #00a8e1; text-transform: uppercase; letter-spacing: 0.5px;">Audit Integrity Protocol</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.7; margin: 0;">Marketplace vitals are cryptographic snapshots of current state. Historical performance drift is observed via internal telemetric logs. Security metrics are re-indexed every cycle to ensure absolute data parity.</p>
        </div>
        <div class="card" style="padding: 24px; border: 1px solid var(--dm-border-color); background: rgba(255, 153, 0, 0.03);">
            <h3 style="margin: 0 0 12px 0; font-size: 13px; font-weight: 800; color: #ff9900; text-transform: uppercase; letter-spacing: 0.5px;">Operational Intel</h3>
            <p style="font-size: 12px; color: var(--dm-text-secondary); line-height: 1.7; margin: 0;">Total population count includes dormant accounts. High Verified PGP adoption is the primary trust metric. Decryption failures and low 2FA adoption rates correlate with increased support vector volume.</p>
        </div>
    </div>
</div>
@endsection
@endsection
