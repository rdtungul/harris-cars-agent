<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ZohoFormSubmission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'pending_appointments'  => Appointment::pending()->count(),
            'total_appointments'    => Appointment::count(),
            'appointments_today'    => Appointment::where('preferred_date', today()->toDateString())->count(),
            'pending_reviews'       => Testimonial::pending()->count(),
            'total_reviews'         => Testimonial::approved()->count(),
            'active_services'       => Service::active()->count(),
            'total_services'        => Service::count(),
            'categories'            => ServiceCategory::active()->count(),
        ];

        $recentAppointments = Appointment::with('service')
            ->latest()
            ->limit(8)
            ->get();

        $pendingReviews = Testimonial::pending()
            ->latest()
            ->limit(5)
            ->get();

        $upcomingAppointments = Appointment::with('service')
            ->upcoming()
            ->limit(5)
            ->get();

        $monthlyAppointments = Appointment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'stats',
            'recentAppointments',
            'pendingReviews',
            'upcomingAppointments',
            'monthlyAppointments'
        ));
    }
}
