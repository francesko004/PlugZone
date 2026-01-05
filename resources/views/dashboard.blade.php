@extends('layouts.app')
@section('content')


    <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 25px;">Your Account</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <!-- Orders Card -->
        <a href="{{ route('orders.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">📦</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Your Orders</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">Track, return, or buy things again</p>
                </div>
            </div>
        </a>

        <!-- Settings Card (Login & Security) -->
        <a href="{{ route('settings') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">🛡️</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Login & Security</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">Edit login info, PGP keys, and PIN</p>
                </div>
            </div>
        </a>

        <!-- Profile Card -->
        <a href="{{ route('profile') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">👤</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Your Profile</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">Update your bio, name, and picture</p>
                </div>
            </div>
        </a>

        <!-- Messages Card -->
        <a href="{{ route('messages.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">✉️</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Messages</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">View communications with vendors</p>
                </div>
            </div>
        </a>

         <!-- Wishlist Card -->
         <a href="{{ route('wishlist.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">♥</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Wishlist</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">Items you've saved for later</p>
                </div>
            </div>
        </a>

        <!-- Support Card -->
        <a href="{{ route('support.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card" style="display: flex; gap: 20px; align-items: center; padding: 20px; transition: background 0.2s;">
                <div style="font-size: 40px;">🎧</div>
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 500;">Customer Service</h3>
                    <p style="margin: 5px 0 0 0; color: var(--dm-text-secondary); font-size: 14px;">Help with orders or account issues</p>
                </div>
            </div>
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- Profile Summary -->
        <div class="card" style="padding: 25px;">
            <div style="text-align: center; margin-bottom: 25px;">
                <img src="{{ $profile ? $profile->profile_picture_url : asset('images/default-profile-picture.png') }}" 
                     alt="Profile Picture" 
                     style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid var(--dm-border-color); margin-bottom: 15px;">
                <h2 style="margin: 0; font-size: 20px;">{{ e($user->username) }}</h2>
                <div class="badge badge-neutral" style="margin-top: 8px;">{{ ucfirst($userRole) }}</div>
            </div>

            <div class="divider"></div>

            <div style="margin-top: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--dm-text-secondary);">Member Since</span>
                    <span>{{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--dm-text-secondary);">Last Login</span>
                    <span>{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--dm-text-secondary);">PGP Key</span>
                    @if($pgpKey)
                        <span class="badge badge-success">Verified</span>
                    @else
                        <span class="badge badge-danger">Not Set</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description and Details -->
        <div>
            <div class="card" style="margin-bottom: 25px; padding: 25px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">Profile Bio</h3>
                <div style="line-height: 1.6; font-size: 14px; color: var(--dm-text-main);">
                    @if($description)
                        {!! $description !!}
                    @else
                        <p style="color: var(--dm-text-secondary); font-style: italic;">No profile bio added yet. Tell people about yourself!</p>
                    @endif
                </div>
            </div>

            <div class="card" style="padding: 25px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 500; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px; margin-bottom: 15px;">PGP Public Key</h3>
                <div style="background: var(--dm-page-bg); padding: 15px; border-radius: 4px; border: 1px solid var(--dm-border-color); max-height: 300px; overflow-y: auto;">
                    @if($pgpKey)
                        <pre style="margin: 0; font-family: monospace; font-size: 12px; white-space: pre-wrap; word-break: break-all; color: var(--dm-text-secondary);">{{ $pgpKey->public_key }}</pre>
                    @else
                        <div style="text-align: center; padding: 20px;">
                            <p style="color: var(--dm-text-secondary);">No PGP key added.</p>
                            <a href="{{ route('settings') }}" class="btn btn-outline btn-sm">Add PGP Key</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


