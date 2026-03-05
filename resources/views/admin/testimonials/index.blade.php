@extends('layouts.admin')

@section('title', 'Reviews')
@section('page-title', 'Customer Reviews')

@section('content')

{{-- Filter Tabs --}}
<div class="flex flex-wrap gap-3 mb-6">
    <a href="{{ route('admin.testimonials.index') }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ !request('filter') ? 'bg-brand-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        All
    </a>
    <a href="{{ route('admin.testimonials.index', ['filter' => 'pending']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('filter') === 'pending' ? 'bg-brand-blue text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Pending ({{ $counts['pending'] }})
    </a>
    <a href="{{ route('admin.testimonials.index', ['filter' => 'approved']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('filter') === 'approved' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Approved ({{ $counts['approved'] }})
    </a>
    <a href="{{ route('admin.testimonials.index', ['filter' => 'featured']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('filter') === 'featured' ? 'bg-yellow-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Featured ({{ $counts['featured'] }})
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Customer</th>
                <th class="px-5 py-3 text-left">Rating</th>
                <th class="px-5 py-3 text-left">Review</th>
                <th class="px-5 py-3 text-left">Source</th>
                <th class="px-5 py-3 text-left">Date</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($testimonials as $review)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="text-sm font-medium text-brand-dark">{{ $review->customer_name }}</p>
                        @if($review->customer_location)
                            <p class="text-xs text-gray-400">{{ $review->customer_location }}</p>
                        @endif
                        @if($review->customer_vehicle)
                            <p class="text-xs text-gray-400">{{ $review->customer_vehicle }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-yellow-500 text-base">{{ str_repeat('★', $review->rating) }}<span class="text-gray-300">{{ str_repeat('★', 5 - $review->rating) }}</span></span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="text-sm text-gray-600 leading-relaxed">{{ Str::limit($review->review, 120) }}</p>
                    </td>
                    <td class="px-5 py-4 text-xs text-gray-500 capitalize">{{ $review->source }}</td>
                    <td class="px-5 py-4 text-xs text-gray-500">{{ $review->created_at->format('M j, Y') }}</td>
                    <td class="px-5 py-4">
                        <div class="flex flex-col gap-1">
                            @if($review->is_approved)
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-800">Approved</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-brand-blue-light text-brand-blue">Pending</span>
                            @endif
                            @if($review->is_featured)
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">Featured</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex flex-col gap-1.5">
                            <form method="POST" action="{{ route('admin.testimonials.approve', $review) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full text-xs {{ $review->is_approved ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-700 hover:bg-green-200' }} px-2 py-1 rounded transition-colors">
                                    {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                                </button>
                            </form>
                            @if($review->is_approved)
                                <form method="POST" action="{{ route('admin.testimonials.feature', $review) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="w-full text-xs {{ $review->is_featured ? 'bg-gray-100 text-gray-600' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }} px-2 py-1 rounded transition-colors">
                                        {{ $review->is_featured ? 'Unfeature' : 'Feature' }}
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $review) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this review?')"
                                        class="w-full text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-gray-400 text-sm">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($testimonials->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $testimonials->links() }}</div>
    @endif
</div>

@endsection
