@if(session('success'))
    <div style="background-color: rgba(0, 118, 0, 0.1); border: 1px solid #007600; border-left: 5px solid #007600; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; color: #007600;">
        <span style="font-size: 20px;">✓</span>
        <div style="font-size: 14px; font-weight: 500;">{{ session('success') }}</div>
    </div>
@endif

@if(session('status'))
    <div style="background-color: rgba(0, 102, 192, 0.1); border: 1px solid #0066c0; border-left: 5px solid #0066c0; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; color: #0066c0;">
        <span style="font-size: 20px;">ℹ️</span>
        <div style="font-size: 14px; font-weight: 500;">{{ session('status') }}</div>
    </div>
@endif

@if(session('error') || $errors->any())
    <div style="background-color: rgba(177, 39, 4, 0.1); border: 1px solid #b12704; border-left: 5px solid #b12704; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; color: #b12704;">
        <span style="font-size: 20px;">⚠️</span>
        <div>
            @if(session('error'))
                <div style="font-size: 14px; font-weight: 700; margin-bottom: 4px;">There was a problem</div>
                <div style="font-size: 13px;">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div style="font-size: 14px; font-weight: 700; margin-bottom: 4px;">There was a problem</div>
                <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endif

@if(session('info'))
    <div style="background-color: rgba(0, 102, 192, 0.1); border: 1px solid #0066c0; border-left: 5px solid #0066c0; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; color: #0066c0;">
        <span style="font-size: 20px;">ℹ️</span>
        <div style="font-size: 14px; font-weight: 500;">{{ session('info') }}</div>
    </div>
@endif
