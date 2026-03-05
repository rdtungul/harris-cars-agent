@extends('layouts.admin')

@section('title', 'Upload Photos')
@section('page-title', 'Upload Gallery Photos')

@section('content')
<div class="max-w-2xl">
    <div class="mb-5">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-brand-primary hover:text-[#003370] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Gallery
        </a>
    </div>

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Photos <span class="text-brand-primary">*</span></label>
            <input type="file" name="images[]" accept="image/*" multiple required
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm">
            <p class="text-xs text-gray-400 mt-1">You can select multiple images at once. Max 8MB per image.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-brand-primary">*</span></label>
            <select name="category" required class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Caption <span class="text-gray-400 font-normal text-xs">(applied to all uploaded images)</span></label>
            <input type="text" name="caption" value="{{ old('caption') }}" placeholder="Optional caption..."
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text <span class="text-gray-400 font-normal text-xs">(for accessibility)</span></label>
            <input type="text" name="alt_text" value="{{ old('alt_text') }}" placeholder="Describe the image for screen readers..."
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="bg-brand-primary hover:bg-[#003370] text-white px-8 py-3 font-semibold rounded transition-colors">
                Upload Photos
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="border border-gray-300 text-gray-600 px-8 py-3 font-semibold rounded hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
