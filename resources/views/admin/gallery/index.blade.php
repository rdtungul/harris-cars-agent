@extends('layouts.admin')

@section('title', 'Gallery')
@section('page-title', 'Photo Gallery')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $images->total() }} photos total</p>
    <a href="{{ route('admin.gallery.create') }}"
       class="inline-flex items-center bg-brand-primary hover:bg-[#003370] text-white px-5 py-2.5 text-sm font-semibold rounded transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Upload Photos
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Image</th>
                <th class="px-5 py-3 text-left">Caption</th>
                <th class="px-5 py-3 text-left">Category</th>
                <th class="px-5 py-3 text-left">Order</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($images as $image)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3">
                        <img src="{{ $image->image_url }}" alt="{{ $image->alt }}"
                             class="w-16 h-12 object-cover rounded">
                    </td>
                    <td class="px-5 py-3 text-sm text-gray-600 max-w-xs">{{ $image->caption ?? '—' }}</td>
                    <td class="px-5 py-3 text-sm text-gray-600">{{ $image->category_label }}</td>
                    <td class="px-5 py-3 text-sm text-gray-500">{{ $image->order }}</td>
                    <td class="px-5 py-3">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold {{ $image->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                            {{ $image->is_active ? 'Visible' : 'Hidden' }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('admin.gallery.edit', $image) }}"
                               class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors text-center">Edit</a>
                            <form method="POST" action="{{ route('admin.gallery.toggle', $image) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full text-xs {{ $image->is_active ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-700' }} px-2 py-1 rounded transition-colors">
                                    {{ $image->is_active ? 'Hide' : 'Show' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this image?')"
                                        class="w-full text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-gray-400 text-sm">
                        No photos yet. <a href="{{ route('admin.gallery.create') }}" class="text-brand-primary hover:underline">Upload your first photo</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($images->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $images->links() }}</div>
    @endif
</div>

@endsection
