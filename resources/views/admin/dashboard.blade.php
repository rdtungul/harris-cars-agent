@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    <div class="bg-white rounded-lg border-l-4 border-yellow-500 p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pending Appointments</p>
                <p class="text-3xl font-bold text-brand-dark mt-1">{{ $stats['pending_appointments'] }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="text-xs text-yellow-600 hover:text-yellow-700 mt-2 inline-block">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-lg border-l-4 border-blue-500 p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Appointments</p>
                <p class="text-3xl font-bold text-brand-dark mt-1">{{ $stats['total_appointments'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-blue-600 mt-2">{{ $stats['appointments_today'] }} today</p>
    </div>

    <div class="bg-white rounded-lg border-l-4 border-brand-blue p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pending Reviews</p>
                <p class="text-3xl font-bold text-brand-dark mt-1">{{ $stats['pending_reviews'] }}</p>
            </div>
            <div class="w-12 h-12 bg-brand-blue-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
        </div>
        <a href="{{ route('admin.testimonials.index', ['filter' => 'pending']) }}" class="text-xs text-brand-blue hover:text-brand-blue mt-2 inline-block">Review queue &rarr;</a>
    </div>

    <div class="bg-white rounded-lg border-l-4 border-green-500 p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Active Services</p>
                <p class="text-3xl font-bold text-brand-dark mt-1">{{ $stats['active_services'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-2">{{ $stats['total_services'] }} total, {{ $stats['categories'] }} categories</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">

    {{-- Recent Appointments --}}
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold text-brand-dark">Recent Appointments</h2>
            <a href="{{ route('admin.appointments.index') }}" class="text-sm text-brand-primary hover:text-[#003370]">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-left">Service</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentAppointments as $appt)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">
                                <p class="text-sm font-medium text-brand-dark">{{ $appt->customer_name }}</p>
                                <p class="text-xs text-gray-400">{{ $appt->phone }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $appt->service?->title ?? 'General Service' }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">
                                {{ $appt->preferred_date?->format('M j') ?? 'TBD' }}
                            </td>
                            <td class="px-4 py-3">
                                @php $color = $appt->status_badge_color; @endphp
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold
                                    {{ $color === 'yellow' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $color === 'blue' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $color === 'green' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $color === 'red' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $color === 'brand-blue' ? 'bg-brand-blue-light text-brand-blue' : '' }}
                                    {{ $color === 'gray' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $appt->status_label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400 text-sm">No appointments yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pending Reviews --}}
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold text-brand-dark">Pending Reviews</h2>
            <a href="{{ route('admin.testimonials.index', ['filter' => 'pending']) }}" class="text-sm text-brand-primary hover:text-[#003370]">View all</a>
        </div>
        @forelse($pendingReviews as $review)
            <div class="px-6 py-4 border-b border-gray-100 last:border-0">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <p class="font-medium text-sm text-brand-dark">{{ $review->customer_name }}</p>
                            <span class="text-yellow-500 text-xs">{{ str_repeat('★', $review->rating) }}</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed">{{ Str::limit($review->review, 100) }}</p>
                    </div>
                    <div class="flex gap-2 ml-4">
                        <form method="POST" action="{{ route('admin.testimonials.approve', $review) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-xs bg-green-100 text-green-700 hover:bg-green-200 px-2 py-1 rounded transition-colors">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $review) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors"
                                    onclick="return confirm('Delete this review?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">No pending reviews.</div>
        @endforelse
    </div>
</div>

{{-- Upcoming Appointments --}}
@if($upcomingAppointments->isNotEmpty())
<div class="mt-6 bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="font-semibold text-brand-dark">Upcoming Appointments</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Confirmation #</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Vehicle</th>
                    <th class="px-6 py-3 text-left">Service</th>
                    <th class="px-6 py-3 text-left">Date / Time</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($upcomingAppointments as $appt)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-xs font-mono text-brand-primary">{{ $appt->confirmation_number }}</td>
                        <td class="px-6 py-3">
                            <p class="text-sm font-medium text-brand-dark">{{ $appt->customer_name }}</p>
                            <p class="text-xs text-gray-400">{{ $appt->phone }}</p>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $appt->vehicle_full_name ?: 'Not specified' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $appt->service?->title ?? 'General' }}</td>
                        <td class="px-6 py-3 text-sm">
                            <p class="text-brand-dark font-medium">{{ $appt->preferred_date?->format('M j, Y') }}</p>
                            <p class="text-gray-400 text-xs">{{ $appt->preferred_time }}</p>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.appointments.show', $appt) }}" class="text-xs text-brand-primary hover:text-[#003370]">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
