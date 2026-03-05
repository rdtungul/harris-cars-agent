@extends('layouts.admin')

@section('title', 'Appointments')
@section('page-title', 'Appointments')

@section('content')

{{-- Status Filter Pills --}}
<div class="flex flex-wrap gap-3 mb-6">
    <a href="{{ route('admin.appointments.index') }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ !request('status') ? 'bg-brand-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        All ({{ array_sum($statusCounts) }})
    </a>
    <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Pending ({{ $statusCounts['pending'] }})
    </a>
    <a href="{{ route('admin.appointments.index', ['status' => 'confirmed']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('status') === 'confirmed' ? 'bg-blue-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Confirmed ({{ $statusCounts['confirmed'] }})
    </a>
    <a href="{{ route('admin.appointments.index', ['status' => 'completed']) }}"
       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request('status') === 'completed' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
        Completed ({{ $statusCounts['completed'] }})
    </a>
</div>

{{-- Search --}}
<div class="bg-white rounded-lg shadow-sm mb-5 p-4">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex gap-3">
        @if(request('status'))<input type="hidden" name="status" value="{{ request('status') }}">@endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone, or confirmation #..."
               class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:ring-brand-primary focus:border-brand-primary">
        <input type="date" name="date" value="{{ request('date') }}"
               class="border border-gray-300 rounded px-3 py-2 text-sm focus:ring-brand-primary focus:border-brand-primary">
        <button type="submit" class="bg-brand-primary text-white px-5 py-2 text-sm font-medium rounded hover:bg-[#003370] transition-colors">Search</button>
        @if(request('search') || request('date'))
            <a href="{{ route('admin.appointments.index', request()->only('status')) }}" class="border border-gray-300 text-gray-600 px-4 py-2 text-sm rounded hover:bg-gray-50 transition-colors">Clear</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left">Confirmation</th>
                <th class="px-5 py-3 text-left">Customer</th>
                <th class="px-5 py-3 text-left">Vehicle</th>
                <th class="px-5 py-3 text-left">Service</th>
                <th class="px-5 py-3 text-left">Preferred Date</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Source</th>
                <th class="px-5 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($appointments as $appt)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-xs font-mono text-brand-primary">{{ $appt->confirmation_number }}</td>
                    <td class="px-5 py-3">
                        <p class="text-sm font-medium text-brand-dark">{{ $appt->customer_name }}</p>
                        <p class="text-xs text-gray-400">{{ $appt->email }}</p>
                        <p class="text-xs text-gray-400">{{ $appt->phone }}</p>
                    </td>
                    <td class="px-5 py-3 text-sm text-gray-600">{{ $appt->vehicle_full_name ?: '—' }}</td>
                    <td class="px-5 py-3 text-sm text-gray-600">{{ $appt->service?->title ?? 'General Service' }}</td>
                    <td class="px-5 py-3 text-sm">
                        @if($appt->preferred_date)
                            <p class="text-brand-dark">{{ $appt->preferred_date->format('M j, Y') }}</p>
                            @if($appt->preferred_time)<p class="text-xs text-gray-400">{{ $appt->preferred_time }}</p>@endif
                        @else
                            <span class="text-gray-400">TBD</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
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
                    <td class="px-5 py-3 text-xs text-gray-500 capitalize">{{ $appt->source }}</td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.appointments.show', $appt) }}"
                               class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded transition-colors">View</a>
                            <form method="POST" action="{{ route('admin.appointments.destroy', $appt) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this appointment?')"
                                        class="text-xs bg-red-100 text-red-700 hover:bg-[#dbeafe] px-2 py-1 rounded transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-5 py-10 text-center text-gray-400 text-sm">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($appointments->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $appointments->links() }}
        </div>
    @endif
</div>

@endsection
