@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Security & Compliance</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Warrant Canary Management</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Maintain platform transparency and verify operational integrity for the community.</p>
    </div>

    <div style="max-width: 900px;">
        <div class="card" style="padding: 35px; border-top: 4px solid #ff9900;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                <div style="font-size: 32px;">🕊️</div>
                <h2 style="margin: 0; font-size: 20px; font-weight: 700;">Operational Integrity Disclosure</h2>
            </div>

            <form method="POST" action="{{ route('admin.canary.post') }}">
                @csrf

                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="canary" class="form-label" style="display: flex; justify-content: space-between;">
                        <span>Current Canary Payload</span>
                        <span style="font-weight: 400; color: var(--dm-text-secondary); font-size: 11px;">Recommended Update: Weekly</span>
                    </label>
                    <textarea id="canary" class="form-input" name="canary" required rows="10" 
                              style="font-family: monospace; font-size: 13px; line-height: 1.5;"
                              placeholder="Assemble the latest canary disclosure including news headlines and PGP signatures...">{{ old('canary', $currentCanary) }}</textarea>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--dm-border-color); padding-top: 25px;">
                    <div style="font-size: 12px; color: var(--dm-text-secondary);">
                        Last Published: <strong style="color: #fff;">{{ now()->format('Y-m-d') }}</strong>
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 40px;">Update Security Disclosure</button>
                </div>
            </form>
        </div>

        <div style="margin-top: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="card" style="padding: 25px; background: rgba(51, 153, 255, 0.03); border: 1px solid rgba(51, 153, 255, 0.1);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: #3399ff;">Compliance Protocol</h4>
                <p style="font-size: 11px; color: var(--dm-text-secondary); line-height: 1.6; margin: 0;">The canary is a statement that the platform has not received secret government subpoenas or warrants. Its removal serves as a silent alert to the community in the event of platform compromise.</p>
            </div>
            <div class="card" style="padding: 25px; background: rgba(255, 153, 0, 0.03); border: 1px solid rgba(255, 153, 0, 0.1);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: #ff9900;">Verification Criteria</h4>
                <p style="font-size: 11px; color: var(--dm-text-secondary); line-height: 1.6; margin: 0;">Each update should include recent world news headlines to prove the date of publication. The entire payload MUST be signed with the platform's Master PGP Key to ensure authenticity.</p>
            </div>
        </div>
    </div>
</div>
@endsection
