<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Appointment::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('preferred_date', $request->date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('confirmation_number', 'LIKE', "%{$search}%");
            });
        }

        $appointments = $query->paginate(20)->withQueryString();

        $statusCounts = [
            'pending'     => Appointment::pending()->count(),
            'confirmed'   => Appointment::confirmed()->count(),
            'completed'   => Appointment::completed()->count(),
        ];

        return view('admin.appointments.index', compact('appointments', 'statusCounts'));
    }

    public function show(Appointment $appointment): View
    {
        $appointment->load('service');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', Appointment::ALL_STATUSES)],
        ]);

        $appointment->update([
            'status'         => $request->status,
            'internal_notes' => $request->input('internal_notes', $appointment->internal_notes),
        ]);

        return back()->with('success', 'Appointment status updated to ' . ucfirst($request->status) . '.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
