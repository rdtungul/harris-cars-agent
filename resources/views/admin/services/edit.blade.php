@extends('layouts.admin')

@section('title', 'Edit Service: ' . $service->title)
@section('page-title', 'Edit Service')

@section('content')

<div class="max-w-3xl">
    <div class="mb-5">
        <a href="{{ route('admin.services.index') }}" class="text-sm text-brand-primary hover:text-[#003370] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Services
        </a>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-5">
            <h2 class="font-semibold text-brand-dark border-b border-gray-100 pb-3">Edit: {{ $service->title }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-brand-primary">*</span></label>
                    <select name="category_id" required class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $service->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-brand-primary">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <input type="text" name="price_range" value="{{ old('price_range', $service->price_range) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $service->duration) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                    <input type="number" name="order" value="{{ old('order', $service->order) }}" min="0"
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                <textarea name="short_description" rows="2" maxlength="500"
                          class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('short_description', $service->short_description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Description</label>
                <textarea name="description" rows="6"
                          class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-y">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Service Image</label>
                @if($service->image)
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-24 h-16 object-cover rounded mb-2">
                    <p class="text-xs text-gray-400 mb-2">Upload new to replace</p>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary">
                    <span class="text-sm text-gray-700">Featured (shows on homepage)</span>
                </label>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <h2 class="font-semibold text-brand-dark border-b border-gray-100 pb-3">SEO</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2"
                          class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('meta_description', $service->meta_description) }}</textarea>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-brand-primary hover:bg-[#003370] text-white px-8 py-3 font-semibold rounded transition-colors">
                Save Changes
            </button>
            <a href="{{ route('admin.services.index') }}" class="border border-gray-300 text-gray-600 px-8 py-3 font-semibold rounded hover:bg-gray-50 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
