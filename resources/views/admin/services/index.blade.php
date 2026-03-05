@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $services->total() }} services total</p>
    <a href="{{ route('admin.services.create') }}"
       class="inline-flex items-center bg-brand-primary hover:bg-[#003370] text-white px-5 py-2.5 text-sm font-semibold rounded transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Service
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Service</th>
                <th class="px-5 py-3 text-left">Category</th>
                <th class="px-5 py-3 text-left">Price Range</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Featured</th>
                <th class="px-5 py-3 text-left">Order</th>
                <th class="px-5 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($services as $service)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center">
                            @if($service->image)
                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}"
                                     class="w-10 h-10 object-cover rounded mr-3">
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-brand-dark">{{ $service->title }}</p>
                                <p class="text-xs text-gray-400 font-mono">{{ $service->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-sm text-gray-600">{{ $service->category?->name ?? '—' }}</td>
                    <td class="px-5 py-4 text-sm text-gray-600">{{ $service->price_range ?? '—' }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        @if($service->is_featured)
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">Featured</span>
                        @else
                            <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-sm text-gray-500">{{ $service->order }}</td>
                    <td class="px-5 py-4">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors text-center">Edit</a>
                            <form method="POST" action="{{ route('admin.services.toggle', $service) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full text-xs {{ $service->is_active ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-700' }} hover:bg-gray-200 px-2 py-1 rounded transition-colors">
                                    {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.services.feature', $service) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full text-xs bg-yellow-100 text-yellow-700 hover:bg-yellow-200 px-2 py-1 rounded transition-colors">
                                    {{ $service->is_featured ? 'Unfeature' : 'Feature' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete {{ addslashes($service->title) }}?')"
                                        class="w-full text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-gray-400 text-sm">
                        No services yet. <a href="{{ route('admin.services.create') }}" class="text-brand-primary hover:underline">Add your first service</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($services->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $services->links() }}</div>
    @endif
</div>

@endsection
