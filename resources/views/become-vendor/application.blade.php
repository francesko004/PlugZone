@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('become.vendor') }}">Vendor Center</a>
        <span>›</span>
        <span>Submit Application</span>
    </div>

    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 30px;">Submit Your Seller Application</h1>

        <form action="{{ route('become.vendor.submit-application') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="card" style="padding: 30px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Business Details</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 20px;">Please provide a detailed overview of your business. Our administrators will use this information to determine your eligibility.</p>

                <div class="form-group">
                    <label for="application_text" class="form-label">Tell us about your business</label>
                    <textarea 
                        name="application_text" 
                        id="application_text" 
                        rows="12" 
                        required 
                        minlength="80" 
                        maxlength="4000" 
                        class="form-input" 
                        style="resize: vertical; font-size: 14px;"
                        placeholder="Please include:&#10;• What categories of products do you intend to sell?&#10;• What is your average shipping timeframe?&#10;• Do you have references from other reputable marketplaces? (Provide PGP-verifiable links if possible)&#10;• How do you handle customer support inquiries?">{{ old('application_text') }}</textarea>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                        <span style="font-size: 11px; color: var(--dm-text-secondary);">Min: 80 characters</span>
                        <span style="font-size: 11px; color: var(--dm-text-secondary);">Max: 4000 characters</span>
                    </div>
                </div>
            </div>

            <div class="card" style="padding: 30px; margin-bottom: 30px;">
                <h3 style="margin-top: 0; font-size: 18px; font-weight: 700; margin-bottom: 10px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Verification Photos</h3>
                <p style="font-size: 13px; color: var(--dm-text-secondary); margin-bottom: 25px;">Upload representative photos of your products or stock. At least one photo is required to verify your business existence.</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
                    @for($i = 0; $i < 4; $i++)
                        <div style="border: 2px dashed var(--dm-border-color); border-radius: 8px; padding: 15px; text-align: center; position: relative; background: rgba(255, 255, 255, 0.02);">
                            <div style="font-size: 24px; margin-bottom: 10px;">📸</div>
                            <div style="font-size: 11px; font-weight: 700; margin-bottom: 8px;">{{ $i === 0 ? 'REQUIRED IMAGE' : 'OPTIONAL IMAGE' }}</div>
                            <input 
                                type="file" 
                                name="product_images[]" 
                                accept="image/*"
                                style="position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;"
                                {{ $i === 0 ? 'required' : '' }}
                            >
                            <div style="font-size: 10px; color: var(--dm-text-secondary);">Click or drop photo here</div>
                        </div>
                    @endfor
                </div>
                <div style="margin-top: 20px; font-size: 11px; color: var(--dm-text-secondary);">
                    Supported: JPEG, PNG, GIF, WebP. Max 800KB per image.
                </div>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 50px; padding: 25px; background: var(--dm-card-bg); border: 1px solid var(--dm-border-color); border-radius: 8px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 40px;">Submit Application for Review</button>
                <a href="{{ route('become.vendor') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
