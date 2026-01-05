@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('vendors.index') }}">All Vendors</a>
        <span>›</span>
        <span>{{ $vendor->username }}</span>
    </div>

    @if($vacation_mode)
        <div style="background-color: rgba(177, 39, 4, 0.1); border: 1px solid #b12704; border-radius: 8px; padding: 30px; text-align: center; margin-bottom: 30px;">
            <h2 style="color: #b12704; margin-top: 0;">Vendor is Currently on Vacation</h2>
            <p style="margin-bottom: 0;">This vendor is currently taking a break. Please check back later.</p>
        </div>
    @endif

    <!-- Vendor Header Card -->
    <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 30px;">
        <div style="height: 120px; background: linear-gradient(135deg, #232f3e 0%, #0f1111 100%); position: relative;">
            <div style="position: absolute; bottom: -40px; left: 30px; width: 120px; height: 120px; border-radius: 50%; border: 4px solid var(--dm-card-bg); overflow: hidden; background: var(--dm-page-bg); box-shadow: 0 4px 12px rgba(0,0,0,0.5);">
                <img src="{{ $vendor->profile ? $vendor->profile->profile_picture_url : asset('images/default-profile-picture.png') }}" 
                     alt="{{ $vendor->username }}"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
        
        <div style="padding: 50px 30px 25px 30px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
            <div>
                <h1 style="margin: 0 0 10px 0; font-size: 32px; font-weight: 700;">{{ $vendor->username }}</h1>
                <div style="display: flex; align-items: center; gap: 15px;">
                    @if($vendor->pgpKey && $vendor->pgpKey->verified)
                        <span style="font-size: 11px; background: rgba(0, 118, 0, 0.1); color: #007600; padding: 2px 10px; border-radius: 12px; border: 1px solid #007600; font-weight: 700;">TRUSTED SELLER</span>
                    @else
                        <span style="font-size: 11px; background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary); padding: 2px 10px; border-radius: 12px; border: 1px solid var(--dm-border-color);">REGISTERED VENDOR</span>
                    @endif
                    <span style="font-size: 13px; color: var(--dm-text-secondary);">Member since {{ $vendor->created_at ? $vendor->created_at->format('M Y') : 'N/A' }}</span>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('messages.create', ['recipient' => $vendor->username]) }}" class="btn btn-outline" style="border-radius: 20px;">Contact Vendor</a>
                @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.details', $vendor->username) }}" class="btn btn-secondary" style="border-radius: 20px;">Admin View</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 30px;">
        <!-- Left Side: Description & Products -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <!-- Store Profile -->
            <div class="card" style="padding: 25px;">
                <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Store Description</h2>
                @if($vendor->vendorProfile && $vendor->vendorProfile->description)
                    <div style="font-size: 14px; line-height: 1.6; color: var(--dm-text-main); white-space: pre-wrap;">{{ $vendor->vendorProfile->description }}</div>
                @else
                    <p style="color: var(--dm-text-secondary); font-style: italic;">No store description provided.</p>
                @endif
            </div>

            <!-- Products -->
            <div>
                <h2 style="font-size: 22px; font-weight: 400; margin-bottom: 20px;">Available Products</h2>
                @if($products->isEmpty())
                    <div class="card" style="padding: 40px; text-align: center; color: var(--dm-text-secondary);">
                        No products available from this vendor at the moment.
                    </div>
                @else
                    <x-products :products="$products" />
                @endif
            </div>

            <!-- Policy -->
            @if($vendor->vendorProfile && $vendor->vendorProfile->vendor_policy)
                <div class="card" style="padding: 25px;">
                    <h2 style="font-size: 18px; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Vendor Policy</h2>
                    <div style="font-size: 14px; line-height: 1.6; color: var(--dm-text-main); white-space: pre-wrap;">{{ $vendor->vendorProfile->vendor_policy }}</div>
                </div>
            @endif

            <!-- Reviews Section -->
            @if(!$vacation_mode && isset($allReviews) && !$allReviews->isEmpty())
                <div>
                    <h2 style="font-size: 22px; font-weight: 400; margin-bottom: 20px; margin-top: 20px;">Customer Feedback</h2>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        @foreach($allReviews as $review)
                            <div class="card" style="padding: 20px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--dm-page-bg); overflow: hidden;">
                                            <img src="{{ $review->user->profile ? $review->user->profile->profile_picture_url : asset('images/default-profile-picture.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div>
                                            <div style="font-size: 13px; font-weight: 700;">{{ $review->user->username }}</div>
                                            <div style="font-size: 11px; color: var(--dm-text-secondary);">verified purchase for <a href="{{ route('products.show', $review->product->slug) }}" style="color: var(--link-color);">{{ $review->product->name }}</a></div>
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 13px; color: {{ $review->sentiment === 'positive' ? '#007600' : ($review->sentiment === 'negative' ? '#b12704' : '#f08804') }}; font-weight: 700;">
                                            {{ ucfirst($review->sentiment) }}
                                        </div>
                                        <div style="font-size: 11px; color: var(--dm-text-secondary);">{{ $review->getFormattedDate() }}</div>
                                    </div>
                                </div>
                                <div style="font-size: 14px; line-height: 1.5; color: var(--dm-text-main);">
                                    {{ $review->review_text }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin-top: 20px;">
                        {{ $allReviews->appends(request()->except('reviews_page'))->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Side: Stats & PGP -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <!-- Review Stats -->
            <div class="card" style="padding: 20px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Review Statistics</h3>
                @if($totalReviews > 0)
                    <div style="text-align: center; margin-bottom: 20px;">
                        <div style="font-size: 32px; font-weight: 700; color: #ff9900;">{{ number_format($positivePercentage, 1) }}%</div>
                        <div style="font-size: 12px; color: var(--dm-text-secondary);">Positive Feedback</div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span style="color: #007600;">Positive</span>
                            <span>{{ $positiveCount }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span style="color: #f08804;">Mixed</span>
                            <span>{{ $mixedCount }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span style="color: #b12704;">Negative</span>
                            <span>{{ $negativeCount }}</span>
                        </div>
                        <div style="border-top: 1px solid var(--dm-border-color); padding-top: 10px; margin-top: 5px; display: flex; justify-content: space-between; font-weight: 700; font-size: 14px;">
                            <span>Total</span>
                            <span>{{ $totalReviews }}</span>
                        </div>
                    </div>
                @else
                    <p style="font-size: 13px; color: var(--dm-text-secondary); text-align: center;">No reviews yet.</p>
                @endif
            </div>

            <!-- Dispute Stats -->
            <div class="card" style="padding: 20px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px;">Dispute History</h3>
                @if($totalDisputes > 0)
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span>Won</span>
                            <span>{{ $disputesWon }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span>Lost</span>
                            <span>{{ $disputesLost }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span>Pending</span>
                            <span>{{ $disputesOpen }}</span>
                        </div>
                        <div style="border-top: 1px solid var(--dm-border-color); padding-top: 10px; margin-top: 5px; display: flex; justify-content: space-between; font-weight: 700; font-size: 14px;">
                            <span>Total Cases</span>
                            <span>{{ $totalDisputes }}</span>
                        </div>
                    </div>
                @else
                    <p style="font-size: 13px; color: var(--dm-text-secondary); text-align: center;">No disputes recorded.</p>
                @endif
            </div>

            <!-- PGP Key -->
            <div class="card" style="padding: 20px;">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 15px;">PGP Public Key</h3>
                @if($vendor->pgpKey)
                    <div style="background: var(--dm-page-bg); padding: 10px; border-radius: 6px; border: 1px solid var(--dm-border-color);">
                        <pre style="margin: 0; font-size: 10px; overflow-x: auto; color: var(--dm-text-secondary);">{{ $vendor->pgpKey->public_key }}</pre>
                    </div>
                @else
                    <p style="font-size: 13px; color: var(--dm-text-secondary); text-align: center;">No PGP key on file.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
