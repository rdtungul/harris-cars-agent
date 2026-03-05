@extends('layouts.admin')

@section('title', 'Appointment #' . $appointment->confirmation_number)
@section('page-title', 'Appointment Details')

@section('content')

<div class="max-w-4xl">
    <div class="mb-5">
        <a href="{{ route('admin.appointments.index') }}" class="text-sm text-brand-primary hover:text-[#003370] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Appointments
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="md:col-span-2 space-y-5">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-start justify-between mb-5">
                    <div>
                        <p class="font-mono text-brand-primary text-sm font-bold">{{ $appointment->confirmation_number }}</p>
                        <h2 class="font-display text-2xl text-brand-dark tracking-wider">{{ $appointment->customer_name }}</h2>
                    </div>
                    @php $color = $appointment->status_badge_color; @endphp
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold
                        {{ $color === 'yellow' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $color === 'blue' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $color === 'green' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $color === 'red' ? 'bg-red-100 text-red-800' : '' }}
                        {{ $color === 'brand-blue' ? 'bg-brand-blue-light text-brand-blue' : '' }}
                        {{ $color === 'gray' ? 'bg-gray-100 text-gray-800' : '' }}">
                        {{ $appointment->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><p class="text-gray-500 text-xs mb-0.5">Email</p><p class="font-medium">{{ $appointment->email }}</p></div>
                    <div><p class="text-gray-500 text-xs mb-0.5">Phone</p><p class="font-medium">{{ $appointment->phone }}</p></div>
                    <div><p class="text-gray-500 text-xs mb-0.5">Service</p><p class="font-medium">{{ $appointment->service?->title ?? 'General Service' }}</p></div>
                    <div><p class="text-gray-500 text-xs mb-0.5">Source</p><p class="font-medium capitalize">{{ $appointment->source }}</p></div>
                    <div><p class="text-gray-500 text-xs mb-0.5">Preferred Date</p><p class="font-medium">{{ $appointment->preferred_date?->format('l, F j, Y') ?? 'Not specified' }}</p></div>
                    <div><p class="text-gray-500 text-xs mb-0.5">Preferred Time</p><p class="font-medium">{{ $appointment->preferred_time ?? 'Not specified' }}</p></div>
                </div>

                @if($appointment->vehicle_full_name)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-500 text-xs mb-1">Vehicle</p>
                        <p class="font-medium text-sm">{{ $appointment->vehicle_full_name }}</p>
                        @if($appointment->vehicle_mileage)
                            <p class="text-gray-400 text-xs">{{ $appointment->vehicle_mileage }} miles</p>
                        @endif
                    </div>
                @endif

                @if($appointment->notes)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-500 text-xs mb-1">Customer Notes</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $appointment->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Status Update --}}
        <div class="space-y-5">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="font-semibold text-brand-dark text-sm mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.appointments.status', $appointment) }}">
                    @csrf @method('PATCH')
                    <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm mb-3 focus:ring-brand-primary focus:border-brand-primary">
                        @foreach(\App\Models\Appointment::ALL_STATUSES as $status)
                            <option value="{{ $status }}" {{ $appointment->status === $status ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                    <textarea name="internal_notes" rows="3" placeholder="Internal notes (optional)..."
                              class="w-full border border-gray-300 rounded px-3 py-2 text-sm mb-3 resize-none focus:ring-brand-primary focus:border-brand-primary">{{ $appointment->internal_notes }}</textarea>
                    <button type="submit" class="w-full bg-brand-primary text-white py-2.5 text-sm font-semibold rounded hover:bg-[#003370] transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-5">
                <p class="text-gray-500 text-xs mb-1">Submitted</p>
                <p class="text-sm font-medium">{{ $appointment->created_at->format('M j, Y \a\t g:i A') }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-5">
                <form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Permanently delete this appointment?')"
                            class="w-full border border-red-300 text-red-600 py-2 text-sm font-medium rounded hover:bg-[#eff6ff] transition-colors">
                        Delete Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
