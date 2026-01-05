@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <span>All Vendors</span>
    </div>

    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Verified Marketplace Vendors</h1>

    @if($vendors->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 20px;">🏪</div>
            <h2 style="font-size: 24px; font-weight: 400; margin-bottom: 10px;">No vendors found</h2>
            <p style="color: var(--dm-text-secondary);">Our marketplace is growing. Check back soon for new stores!</p>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            @foreach($vendors as $vendor)
                <div class="card" style="padding: 20px; display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--dm-border-color); transition: border-color 0.2s;" onmouseover="this.style.borderColor='#ff9900'" onmouseout="this.style.borderColor='var(--dm-border-color)'">
                    <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin-bottom: 15px; border: 2px solid var(--dm-border-color); background: var(--dm-page-bg);">
                        <img src="{{ $vendor->profile ? $vendor->profile->profile_picture_url : asset('images/default-profile-picture.png') }}" 
                             alt="{{ $vendor->username }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    
                    <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #fff;">{{ $vendor->username }}</h3>
                    
                    <div style="margin-bottom: 20px;">
                        @if($vendor->pgpKey && $vendor->pgpKey->verified)
                            <span style="font-size: 11px; background: rgba(0, 118, 0, 0.1); color: #007600; padding: 2px 8px; border-radius: 4px; border: 1px solid #007600;">VERIFIED PGP</span>
                        @else
                            <span style="font-size: 11px; color: var(--dm-text-secondary);">Est. {{ $vendor->created_at ? $vendor->created_at->format('Y') : 'N/A' }}</span>
                        @endif
                    </div>

                    <a href="{{ route('vendors.show', $vendor->username) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 20px;">Visit Store</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
