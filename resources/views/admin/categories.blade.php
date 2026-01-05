@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Administration</a>
        <span>›</span>
        <span>Department Management</span>
    </div>

    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 400; margin: 0;">Taxonomy & Department Console</h1>
        <p style="color: var(--dm-text-secondary); font-size: 14px; margin-top: 5px;">Configure the marketplace classification hierarchy for optimal product discovery.</p>
    </div>

    <div style="display: grid; grid-template-columns: 350px 1fr; gap: 30px; align-items: start;">
        <!-- Department Creation Console -->
        <div class="card" style="padding: 25px;">
            <h3 style="margin-top: 0; font-size: 16px; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px;">Registry Entry</h3>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Classification Name</label>
                    <input type="text" name="name" class="form-input" required minlength="1" maxlength="16" value="{{ old('name') }}" placeholder="e.g. Electronics">
                    <p style="font-size: 11px; color: var(--dm-text-secondary); margin-top: 5px;">Maximum 16 characters for navigation density.</p>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label class="form-label">Parent Classification</label>
                    <select name="parent_id" class="form-input">
                        <option value="">Root Department (Main)</option>
                        @foreach($mainCategories as $category)
                            <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Commit to Registry</button>
            </form>

            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--dm-border-color);">
                <h4 style="margin: 0 0 10px 0; font-size: 13px; font-weight: 700; color: var(--dm-text-secondary);">Taxonomy Rules</h4>
                <ul style="margin: 0; padding-left: 18px; font-size: 11px; color: var(--dm-text-secondary); line-height: 1.6;">
                    <li>Keep titles concise and descriptive.</li>
                    <li>Subcategories inherit root visibility settings.</li>
                    <li>Deleting a category archives associated paths.</li>
                </ul>
            </div>
        </div>

        <!-- Taxonomy Tree View -->
        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 15px 20px; border-bottom: 1px solid var(--dm-border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 14px; font-weight: 700;">Active Classifications</span>
                <span style="font-size: 11px; font-weight: 700; color: var(--dm-text-secondary);">{{ $mainCategories->count() }} ROOT BRANCHES</span>
            </div>
            
            @if($mainCategories->isEmpty())
                <div style="padding: 60px; text-align: center;">
                    <p style="color: var(--dm-text-secondary); font-size: 14px;">The platform registry is currently empty.</p>
                </div>
            @else
                <div style="padding: 20px;">
                    @foreach($mainCategories as $mainCategory)
                        <div style="margin-bottom: 15px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                            <div style="background: rgba(255,255,255,0.02); padding: 12px 20px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 16px;">📁</span>
                                    <span style="font-weight: 700; font-size: 15px;">{{ $mainCategory->name }}</span>
                                </div>
                                <form action="{{ route('admin.categories.delete', $mainCategory) }}" method="POST" onsubmit="return confirm('Cascade delete: This will also remove sub-classifications. Proceed?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 2px 10px; font-size: 11px;">Archive</button>
                                </form>
                            </div>

                            @if($mainCategory->children->isNotEmpty())
                                <div style="padding: 10px 20px 15px 50px; background: rgba(0,0,0,0.1);">
                                    @foreach($mainCategory->children as $subCategory)
                                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px dashed rgba(255,255,255,0.05);">
                                            <div style="display: flex; align-items: center; gap: 10px; color: var(--dm-text-secondary);">
                                                <span style="font-size: 12px;">└─</span>
                                                <span style="font-size: 13px;">{{ $subCategory->name }}</span>
                                            </div>
                                            <form action="{{ route('admin.categories.delete', $subCategory) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: transparent; border: none; color: #ff4444; font-size: 11px; cursor: pointer; text-decoration: underline;">Remove</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
