<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ServiceCategory;
use App\Models\Special;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredServices = Service::with('category')
            ->active()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get();

        $featuredTestimonials = Testimonial::approved()
            ->featured()
            ->highRated(4)
            ->latest()
            ->limit(3)
            ->get();

        $serviceCategories = ServiceCategory::active()
            ->ordered()
            ->withCount(['services' => fn($q) => $q->active()])
            ->get();

        $activeSpecials = Special::active()
            ->orderBy('order')
            ->limit(3)
            ->get();

        $stats = [
            'years_experience' => setting('years_experience', '15+'),
            'vehicles_serviced' => setting('vehicles_serviced', '10,000+'),
            'happy_customers' => setting('happy_customers', '5,000+'),
            'ase_certified' => setting('ase_certified', 'Yes'),
        ];

        return view('pages.home', compact(
            'featuredServices',
            'featuredTestimonials',
            'serviceCategories',
            'activeSpecials',
            'stats'
        ));
    }
}
