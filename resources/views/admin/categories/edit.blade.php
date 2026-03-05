@extends('layouts.admin')

@section('title', 'Edit Category: ' . $category->name)
@section('page-title', 'Edit Service Category')

@section('content')
<div class="max-w-2xl">
    <div class="mb-5">
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-brand-primary hover:text-[#003370] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Categories
        </a>
    </div>
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-6 space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-brand-primary">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                <input type="number" name="order" value="{{ old('order', $category->order) }}" min="0"
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                <input type="text" name="icon" value="{{ old('icon', $category->icon) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('description', $category->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
            @if($category->image)
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-20 h-14 object-cover rounded mb-2">
                <p class="text-xs text-gray-400 mb-2">Upload new to replace current image</p>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm">
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary">
            <span class="text-sm text-gray-700">Active</span>
        </label>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="bg-brand-primary hover:bg-[#003370] text-white px-8 py-3 font-semibold rounded transition-colors">
                Save Changes
            </button>
            <a href="{{ route('admin.categories.index') }}" class="border border-gray-300 text-gray-600 px-8 py-3 font-semibold rounded hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
