@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Login & Security</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Login & Security</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(450px, 1fr)); gap: 30px;">
        <!-- Password Change -->
        <div class="card" style="padding: 25px;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; margin-bottom: 20px;">Change Password</h3>
            <form method="POST" action="{{ route('settings.changePassword') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input class="form-input" id="current_password" type="password" name="current_password" required minlength="8" maxlength="40">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input class="form-input" id="password" type="password" name="password" required minlength="8" maxlength="40">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm New Password</label>
                    <input class="form-input" id="password_confirmation" type="password" name="password_confirmation" required minlength="8" maxlength="40">
                </div>
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </form>
        </div>

        <!-- PGP Management -->
        <div class="card" style="padding: 25px;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; margin-bottom: 20px;">Manage PGP Key</h3>
            <form method="POST" action="{{ route('settings.updatePgpKey') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="public_key">PGP Public Key</label>
                    <textarea class="form-input" id="public_key" name="public_key" rows="8" style="font-family: monospace; font-size: 12px;" required minlength="100" maxlength="8000" placeholder="-----BEGIN PGP PUBLIC KEY BLOCK-----">{{ old('public_key', $user->pgpKey->public_key ?? '') }}</textarea>
                </div>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">
                    Required for 2FA and secure communication. Check our <a href="{{ route('guides.tor') }}" style="color: var(--link-color);">PGP Guide</a> if you're new to this.
                </p>
                <button class="btn btn-primary" type="submit">
                    {{ $user->pgpKey ? 'Update PGP Key' : 'Add PGP Key' }}
                </button>
            </form>
        </div>

        <!-- 2FA Toggle -->
        <div class="card" style="padding: 25px;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; margin-bottom: 20px;">Two-Step Verification (2FA)</h3>
            @if (!$user->pgpKey || !$user->pgpKey->verified)
                <div style="background: rgba(240, 136, 4, 0.1); border: 1px solid #f08804; border-radius: 4px; padding: 15px;">
                    <p style="margin: 0; font-size: 14px; color: #f08804;">
                        <strong>Action Needed:</strong> You must add and verify a PGP key before you can enable 2FA.
                    </p>
                </div>
            @else
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-size: 16px;">Status: <strong>{{ $user->pgpKey->two_fa_enabled ? 'Enabled' : 'Disabled' }}</strong></span>
                        <form method="POST" action="{{ route('pgp.2fa.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="two_fa_enabled" value="{{ $user->pgpKey->two_fa_enabled ? '0' : '1' }}">
                            <button class="btn {{ $user->pgpKey->two_fa_enabled ? 'btn-danger' : 'btn-success' }}" type="submit">
                                {{ $user->pgpKey->two_fa_enabled ? 'Disable 2FA' : 'Enable 2FA' }}
                            </button>
                        </form>
                    </div>
                </div>
                <p style="font-size: 13px; color: var(--dm-text-secondary);">
                    When enabled, we'll challenge you with a PGP-encrypted message during login. This provides a critical second layer of protection.
                </p>
            @endif
        </div>

        <!-- Anti-Phishing -->
        <div class="card" style="padding: 25px;">
            <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; margin-bottom: 20px;">Anti-Phishing Secret</h3>
            @if ($user->secretPhrase)
                <div style="background: var(--dm-page-bg); border: 1px solid var(--dm-border-color); border-radius: 4px; padding: 20px; text-align: center;">
                    <p style="font-size: 14px; color: var(--dm-text-secondary); margin-bottom: 10px;">Your Secret Phrase:</p>
                    <div style="font-size: 24px; font-weight: 700; color: var(--color-success-light); letter-spacing: 2px;">{{ strtoupper($user->secretPhrase->phrase) }}</div>
                </div>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-top: 20px;">
                    This phrase is shown on all sensitive pages. If you don't see it exactly as above, you are likely on a phishing site.
                </p>
            @else
                <form method="POST" action="{{ route('settings.updateSecretPhrase') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="secret_phrase">Choose Secret Phrase</label>
                        <input class="form-input" id="secret_phrase" type="text" name="secret_phrase" required minlength="4" maxlength="16" placeholder="e.g. SILVER FOX">
                    </div>
                    <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">
                        Choose 4-16 letters. No numbers or special characters. This cannot be changed once set.
                    </p>
                    <button class="btn btn-primary" type="submit">Set Phrase</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
