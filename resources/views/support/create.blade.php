@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('support.index') }}">Your Support Requests</a>
        <span>›</span>
        <span>Contact Customer Service</span>
    </div>

    <div style="max-width: 650px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 700; margin: 0;">Initiate Support Consultation</h1>
            <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Provide detailed information to ensure rapid resolution by our security staff.</p>
        </div>

        <div class="card" style="padding: 35px; border-top: 4px solid #3399ff;">
            <form action="{{ route('support.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label" style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--dm-text-secondary); margin-bottom: 10px; display: block;">Subject of Inquiry</label>
                    <input type="text" name="title" id="title" required
                        class="form-input"
                        value="{{ old('title') }}"
                        placeholder="e.g. Order #8271 Transaction Discrepancy"
                        minlength="8" maxlength="160"
                        style="padding: 12px 15px;">
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 8px;">A specific title allows our team to categorize and prioritize your request immediately.</p>
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="message" class="form-label" style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--dm-text-secondary); margin-bottom: 10px; display: block;">Detailed Logistics / Inquiry Message</label>
                    <textarea name="message" id="message" required
                        class="form-input"
                        style="min-height: 250px; resize: vertical; padding: 15px; line-height: 1.6;"
                        placeholder="Please include order IDs, PGP signatures, or specific timestamps relevant to your inquiry..."
                        minlength="8" maxlength="4000">{{ old('message') }}</textarea>
                </div>

                <div class="form-group" style="margin-top: 25px;">
                    <label for="captcha" class="form-label" style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--dm-text-secondary); margin-bottom: 10px; display: block;">Security Verification</label>
                    <div style="display: flex; align-items: center; gap: 20px; background: rgba(0,0,0,0.2); padding: 15px; border-radius: 8px; border: 1px solid var(--dm-border-color);">
                        <img src="{{ $captchaImage }}" alt="CAPTCHA" style="border-radius: 4px; height: 38px; border: 1px solid rgba(255,255,255,0.1);">
                        <input type="text" name="captcha" id="captcha" required
                            class="form-input"
                            style="width: 140px; padding: 10px; text-align: center; letter-spacing: 2px; font-weight: 700;"
                            placeholder="CODE"
                            minlength="2" maxlength="8">
                    </div>
                </div>

                <div style="display: flex; gap: 15px; margin-top: 40px; border-top: 1px solid var(--dm-border-color); padding-top: 25px;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 40px; font-size: 15px;">Deploy Request</button>
                    <a href="{{ route('support.index') }}" class="btn btn-secondary" style="padding: 12px 25px;">Abort</a>
                </div>
            </form>
        </div>
        
        <div style="margin-top: 20px; padding: 15px; background: rgba(51, 153, 255, 0.03); border: 1px solid rgba(51, 153, 255, 0.1); border-radius: 8px; display: flex; gap: 15px; align-items: center;">
            <div style="font-size: 20px;">🛡️</div>
            <p style="margin: 0; font-size: 11px; color: var(--dm-text-secondary); line-height: 1.5;">All support communications are encrypted and purged after resolution. Never share your mnemonic or private credentials with staff.</p>
        </div>
    </div>
</div>
@endsection