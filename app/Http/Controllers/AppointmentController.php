<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentNotification;

class AppointmentController extends Controller
{
    public function create(): View
    {
        $categories = ServiceCategory::active()
            ->ordered()
            ->with('activeServices')
            ->get();

        $services = Service::active()->ordered()->get();

        $timeSlots = [
            '08:00 AM', '08:30 AM', '09:00 AM', '09:30 AM',
            '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
            '12:00 PM', '12:30 PM', '01:00 PM', '01:30 PM',
            '02:00 PM', '02:30 PM', '03:00 PM', '03:30 PM',
            '04:00 PM', '04:30 PM',
        ];

        return view('pages.book', compact('categories', 'services', 'timeSlots'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name'  => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255'],
            'phone'          => ['required', 'string', 'max:20'],
            'service_id'     => ['nullable', 'exists:services,id'],
            'vehicle_year'   => ['nullable', 'digits:4', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'vehicle_make'   => ['nullable', 'string', 'max:100'],
            'vehicle_model'  => ['nullable', 'string', 'max:100'],
            'vehicle_trim'   => ['nullable', 'string', 'max:100'],
            'vehicle_mileage'=> ['nullable', 'string', 'max:20'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'string', 'max:20'],
            'notes'          => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['source'] = 'website';

        $appointment = Appointment::create($validated);

        // Send confirmation email to customer
        try {
            Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment));
        } catch (\Exception $e) {
            \Log::error('Failed to send appointment confirmation email: ' . $e->getMessage());
        }

        // Send notification email to shop
        try {
            $shopEmail = setting('email', config('mail.from.address'));
            Mail::to($shopEmail)->send(new AppointmentNotification($appointment));
        } catch (\Exception $e) {
            \Log::error('Failed to send appointment notification email: ' . $e->getMessage());
        }

        return redirect()->route('appointments.confirmation')
            ->with('appointment_id', $appointment->id)
            ->with('confirmation_number', $appointment->confirmation_number)
            ->with('success', 'Your appointment request has been submitted! We will contact you shortly to confirm.');
    }

    public function confirmation(): View
    {
        return view('pages.booking-confirmation');
    }
}
