<div class="sidebar-right">
    <div style="padding: 10px 15px; font-size: 12px; font-weight: 700; color: var(--dm-text-secondary); border-bottom: 1px solid var(--dm-border-color); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
        Quick Links
    </div>
    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 5px;">
        <li>
            <a href="{{ route('dashboard') }}" style="display: flex; flex-direction: column; align-items: center; padding: 10px 5px; border-radius: 6px; text-decoration: none; color: var(--dm-text-secondary); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,153,0,0.1)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--dm-text-secondary)'">
                <span style="font-size: 18px; margin-bottom: 4px;">📊</span>
                <span style="font-size: 10px; text-align: center;">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('settings') }}" style="display: flex; flex-direction: column; align-items: center; padding: 10px 5px; border-radius: 6px; text-decoration: none; color: var(--dm-text-secondary); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,153,0,0.1)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--dm-text-secondary)'">
                <span style="font-size: 18px; margin-bottom: 4px;">⚙️</span>
                <span style="font-size: 10px; text-align: center;">Settings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('messages.index') }}" style="display: flex; flex-direction: column; align-items: center; padding: 10px 5px; border-radius: 6px; text-decoration: none; color: var(--dm-text-secondary); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,153,0,0.1)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--dm-text-secondary)'">
                <span style="font-size: 18px; margin-bottom: 4px;">💬</span>
                <span style="font-size: 10px; text-align: center;">Messages</span>
            </a>
        </li>
        <li>
            <a href="{{ route('support.index') }}" style="display: flex; flex-direction: column; align-items: center; padding: 10px 5px; border-radius: 6px; text-decoration: none; color: var(--dm-text-secondary); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,153,0,0.1)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--dm-text-secondary)'">
                <span style="font-size: 18px; margin-bottom: 4px;">❓</span>
                <span style="font-size: 10px; text-align: center;">Support</span>
            </a>
        </li>
        @if(auth()->user()->isVendor())
        <li>
            <a href="{{ route('vendor.index') }}" style="display: flex; flex-direction: column; align-items: center; padding: 10px 5px; border-radius: 8px; background: rgba(255, 153, 0, 0.1); text-decoration: none; color: #ff9900; border: 1px solid rgba(255, 153, 0, 0.2); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,153,0,0.2)'" onmouseout="this.style.background='rgba(255, 153, 0, 0.1)'">
                <span style="font-size: 18px; margin-bottom: 4px;">🏪</span>
                <span style="font-size: 10px; text-align: center; font-weight: 700;">Vendor</span>
            </a>
        </li>
        @endif
    </ul>
</div>
