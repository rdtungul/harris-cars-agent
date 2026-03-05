@extends('layouts.admin')

@section('title', 'Service Categories')
@section('page-title', 'Service Categories')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $categories->total() }} categories</p>
    <a href="{{ route('admin.categories.create') }}"
       class="inline-flex items-center bg-brand-primary hover:bg-[#003370] text-white px-5 py-2.5 text-sm font-semibold rounded transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Category
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Category</th>
                <th class="px-5 py-3 text-left">Slug</th>
                <th class="px-5 py-3 text-left">Services</th>
                <th class="px-5 py-3 text-left">Order</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="text-sm font-medium text-brand-dark">{{ $category->name }}</p>
                        @if($category->description)
                            <p class="text-xs text-gray-400">{{ Str::limit($category->description, 60) }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-xs font-mono text-gray-500">{{ $category->slug }}</td>
                    <td class="px-5 py-4 text-sm text-gray-600">{{ $category->services_count }}</td>
                    <td class="px-5 py-4 text-sm text-gray-500">{{ $category->order }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors text-center">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.toggle', $category) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full text-xs {{ $category->is_active ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-700' }} px-2 py-1 rounded transition-colors">
                                    {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete this category? All associated services will lose their category.')"
                                        class="w-full text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-gray-400 text-sm">
                        No categories yet. <a href="{{ route('admin.categories.create') }}" class="text-brand-primary hover:underline">Add your first category</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($categories->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $categories->links() }}</div>
    @endif
</div>

@endsection
