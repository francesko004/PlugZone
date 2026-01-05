@extends('layouts.app')
@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Your Profile</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Update Your Profile</h1>

    <div class="card" style="padding: 30px;">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 200px 1fr; gap: 40px;">
                <!-- Left Column: Picture -->
                <div style="text-align: center;">
                    <div style="margin-bottom: 20px;">
                        <img src="{{ $profile->profile_picture_url }}" 
                             alt="Profile Picture" 
                             style="width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 3px solid var(--dm-border-color); background: var(--dm-page-bg);">
                    </div>
                    
                    <div class="form-group">
                        <label class="btn btn-secondary btn-sm btn-block" style="cursor: pointer;">
                            Change Photo
                            <input type="file" name="profile_picture" style="display: none;">
                        </label>
                        <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 8px;">
                            JPEG, PNG, WebP<br>Max 800KB
                        </p>
                    </div>

                    <div class="divider"></div>

                    <div style="margin-top: 15px;">
                        <span style="font-size: 12px; font-weight: 500; display: block; margin-bottom: 8px;">PGP STATUS</span>
                        @if(Auth::user()->pgpKey)
                            @if(Auth::user()->pgpKey->verified)
                                <div class="badge badge-success">✓ Verified Key</div>
                            @else
                                <div class="badge badge-danger">⚠ Unverified Key</div>
                                <a href="{{ route('pgp.confirm') }}" class="btn btn-primary btn-sm btn-block" style="margin-top: 10px;">Verify Now</a>
                            @endif
                        @else
                            <div class="badge badge-neutral">No Key Found</div>
                            <a href="{{ route('settings') }}" class="btn btn-outline btn-sm btn-block" style="margin-top: 10px;">Add PGP Key</a>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Info -->
                <div>
                    <div class="form-group">
                        <label class="form-label" for="description">About You (Bio)</label>
                        <textarea name="description" id="description" rows="12" class="form-input" style="line-height: 1.6;" required minlength="4" maxlength="800" placeholder="Tell the market about yourself...">{{ old('description', $profile->description ? e(Crypt::decryptString($profile->description)) : '') }}</textarea>
                        <p style="font-size: 12px; color: var(--dm-text-secondary); margin-top: 8px;">
                            Between 4 and 800 characters. Note: A bio is required to upload a profile picture.
                        </p>
                    </div>

                    <div style="margin-top: 30px; display: flex; gap: 15px;">
                        <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
