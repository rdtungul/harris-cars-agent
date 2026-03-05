<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::approved()
            ->highRated(1)
            ->latest()
            ->paginate(12);

        $averageRating = Testimonial::approved()->avg('rating');
        $totalReviews  = Testimonial::approved()->count();

        $ratingBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = Testimonial::approved()->where('rating', $i)->count();
            $ratingBreakdown[$i] = [
                'count'   => $count,
                'percent' => $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0,
            ];
        }

        $services = Service::active()->ordered()->get();

        return view('pages.testimonials', compact(
            'testimonials',
            'averageRating',
            'totalReviews',
            'ratingBreakdown',
            'services'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name'     => ['required', 'string', 'max:255'],
            'customer_location' => ['nullable', 'string', 'max:100'],
            'customer_vehicle'  => ['nullable', 'string', 'max:100'],
            'service_id'        => ['nullable', 'exists:services,id'],
            'rating'            => ['required', 'integer', 'min:1', 'max:5'],
            'review'            => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $validated['source']      = 'website';
        $validated['is_approved'] = false; // requires admin approval

        Testimonial::create($validated);

        return back()->with('success', 'Thank you for your review! It will be published after review.');
    }
}
