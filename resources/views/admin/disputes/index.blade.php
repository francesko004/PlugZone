@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Resolution Operations</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Marketplace Resolution Center</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Arbitrate platform disputes and oversee settlement proceedings.</p>
    </div>

    @if($disputes->isEmpty())
        <div class="card" style="padding: 60px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 15px;">⚖️</div>
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">No Active Cases</h2>
            <p style="color: var(--dm-text-secondary);">The resolution queue is currently clear. No disputes require administrative intervention.</p>
        </div>
    @else
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">{{ $disputes->total() }} Cases in Archive/Queue</span>
            </div>

            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: rgba(0,0,0,0.2); border-bottom: 1px solid var(--dm-border-color);">
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Reference</th>
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Parties Invoived</th>
                        <th style="text-align: left; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Order Context</th>
                        <th style="text-align: center; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Review Status</th>
                        <th style="text-align: right; padding: 15px 20px; font-size: 11px; font-weight: 700; color: var(--dm-text-secondary); text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disputes as $dispute)
                        <tr style="border-bottom: 1px solid var(--dm-border-color); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; color: #ff9900; font-family: monospace;">#DS-{{ substr($dispute->id, 0, 8) }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary);">Opened: {{ $dispute->created_at->format('Y-m-d') }}</div>
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <div style="font-size: 12px;"><span style="color: var(--dm-text-secondary);">Buyer:</span> <span style="font-weight: 700;">{{ $dispute->order->user->username }}</span></div>
                                    <div style="font-size: 12px;"><span style="color: var(--dm-text-secondary);">Vendor:</span> <span style="font-weight: 700;">{{ $dispute->order->vendor->username }}</span></div>
                                </div>
                            </td>
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; font-family: monospace;">#OR-{{ substr($dispute->order->id, 0, 8) }}</div>
                                <div style="font-size: 11px; color: var(--dm-text-secondary);">Type: {{ strtoupper($dispute->order->product->type) }}</div>
                            </td>
                            <td style="padding: 15px 20px; text-align: center;">
                                <span style="font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
                                    @if($dispute->status === \App\Models\Dispute::STATUS_ACTIVE) background: rgba(255, 153, 0, 0.1); color: #ff9900;
                                    @else background: rgba(255, 255, 255, 0.05); color: var(--dm-text-secondary);
                                    @endif
                                ">
                                    {{ strtoupper($dispute->status) }}
                                </span>
                                @if($dispute->status !== \App\Models\Dispute::STATUS_ACTIVE)
                                    <div style="font-size: 10px; color: var(--dm-text-secondary); margin-top: 5px;">RESO BY: {{ strtoupper($dispute->resolver->username) }}</div>
                                @endif
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <a href="{{ route('admin.disputes.show', $dispute->id) }}" class="btn btn-secondary btn-sm" style="padding: 5px 15px;">
                                    {{ $dispute->status === \App\Models\Dispute::STATUS_ACTIVE ? 'Manage' : 'Audit' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $disputes->links('components.pagination') }}
        </div>
    @endif
</div>
@endsection
