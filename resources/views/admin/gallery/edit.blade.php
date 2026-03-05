@extends('layouts.admin')

@section('title', 'Edit Gallery Image')
@section('page-title', 'Edit Gallery Image')

@section('content')
<div class="max-w-2xl">
    <div class="mb-5">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-brand-primary hover:text-[#003370] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Gallery
        </a>
    </div>

    <form method="POST" action="{{ route('admin.gallery.update', $gallery) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6 space-y-5">
        @csrf @method('PUT')
        <div class="mb-4">
            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->alt }}" class="w-full max-h-48 object-cover rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Replace Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category', $gallery->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
            <input type="text" name="caption" value="{{ old('caption', $gallery->caption) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
            <input type="text" name="alt_text" value="{{ old('alt_text', $gallery->alt_text) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
            <input type="number" name="order" value="{{ old('order', $gallery->order) }}" min="0"
                   class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="bg-brand-primary hover:bg-[#003370] text-white px-8 py-3 font-semibold rounded transition-colors">Save Changes</button>
            <a href="{{ route('admin.gallery.index') }}" class="border border-gray-300 text-gray-600 px-8 py-3 font-semibold rounded hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
