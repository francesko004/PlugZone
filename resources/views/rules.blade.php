@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Your Account</a>
        <span>›</span>
        <span>Marketplace Rules</span>
    </div>

    <div class="card" style="padding: 40px; max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 400; margin-bottom: 30px; text-align: center;">PlugZone Marketplace Guidelines</h1>

        @if(request()->get('page', 1) == 1)
            <div style="line-height: 1.6;">
                <h2 style="font-size: 20px; font-weight: 500; margin-bottom: 15px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 10px;">Welcome to PlugZone</h2>
                <p style="color: var(--dm-text-secondary); margin-bottom: 25px;">
                    Welcome to our secure Monero-based marketplace. These rules are designed to ensure a safe, private, and efficient trading environment for all users. Compliance with these rules is mandatory for all marketplace participants.
                </p>

                <div style="background: rgba(255, 153, 0, 0.05); border: 1px solid #ff9900; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                    <h3 style="margin-top: 0; font-size: 16px; color: #ff9900; display: flex; align-items: center; gap: 10px;">
                        ⚠️ Important Notice
                    </h3>
                    <p style="margin: 10px 0 0 0; font-size: 14px;">
                        The marketplace reserves the right to modify these rules as needed to maintain security and improve user experience. Users are responsible for staying updated with current rules. Violations may result in account suspension or permanent ban. Your security and privacy are our top priorities.
                    </p>
                </div>
            </div>
        @else
            <div style="line-height: 1.6;">
                @if(request()->get('page') == 2)
                    <div style="display: flex; flex-direction: column; gap: 30px;">
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">1. Transaction Security</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">All transactions must use the platform's built-in escrow system. Direct trades or external escrow services are strictly prohibited to ensure user safety and prevent fraud. The platform escrow system is the only authorized method for conducting transactions.</p>
                        </div>
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">2. Privacy Protection</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">Users must maintain strict privacy standards. Sharing personal information, attempting to deanonymize users (doxxing), or requesting personal details is strictly prohibited. Protect your privacy by using strong encryption and secure communication methods.</p>
                        </div>
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">3. Secure Communication</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">All communication must occur through the platform's encrypted messaging system. External communication methods are prohibited to maintain user privacy and transaction security. Never share contact information or communicate through external channels.</p>
                        </div>
                    </div>
                @elseif(request()->get('page') == 3)
                    <div style="display: flex; flex-direction: column; gap: 30px;">
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">4. Monero Transactions</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">All payments must be made exclusively in Monero (XMR). Ensure your wallet is properly secured and maintain good operational security practices. Double-check all transaction details before confirming any transfers.</p>
                        </div>
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">5. Listing Standards</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">All listings must be clear, accurate, and compliant with marketplace standards. Misrepresenting products or services is prohibited. Prices must be clearly displayed, and all terms of sale must be explicitly stated.</p>
                        </div>
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">6. Account Security</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">Users are responsible for maintaining their account security. Enable PGP 2FA, use strong passwords, and never share account credentials. Report any suspicious activity immediately to marketplace administration.</p>
                        </div>
                    </div>
                @elseif(request()->get('page') == 4)
                    <div style="display: flex; flex-direction: column; gap: 30px;">
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">7. Feedback Integrity</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">Provide honest and accurate feedback after transactions. Manipulation of the feedback system, including fake reviews or rating extortion, is prohibited. Feedback should be based solely on the actual transaction experience.</p>
                        </div>
                        <div class="rule-item">
                            <h3 style="font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 10px;">8. Professional Conduct</h3>
                            <p style="color: var(--dm-text-secondary); font-size: 14px;">Maintain professional conduct in all interactions. Harassment, threats, or any form of abusive behavior will not be tolerated. Respect other users and resolve disputes through official channels.</p>
                        </div>
                    </div>
                @elseif(request()->get('page') == 5)
                    <div>
                        <h2 style="font-size: 20px; font-weight: 500; margin-bottom: 20px; color: #ff9900;">Dispute Resolution & Terms</h2>
                        <ul style="display: flex; flex-direction: column; gap: 12px; font-size: 14px; padding-left: 20px; color: var(--dm-text-secondary);">
                            <li>All marketplace rules apply to dispute resolution processes.</li>
                            <li>Disputes must be opened within the allowed timeframe after transaction completion.</li>
                            <li>Both parties must respond to dispute mediator requests promptly.</li>
                            <li>All evidence must be submitted through the platform's secure system.</li>
                            <li>Moderator decisions are final but may be appealed through official channels.</li>
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid var(--dm-border-color); display: flex; justify-content: center;">
            {{ $paginatedRules->links() }}
        </div>
    </div>
</div>
@endsection
