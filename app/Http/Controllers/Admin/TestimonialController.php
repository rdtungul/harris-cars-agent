<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $query = Testimonial::with('service')->latest();

        if ($request->filled('filter')) {
            match ($request->filter) {
                'pending'  => $query->pending(),
                'approved' => $query->approved(),
                'featured' => $query->featured(),
                default    => null,
            };
        }

        $testimonials = $query->paginate(20)->withQueryString();

        $counts = [
            'pending'  => Testimonial::pending()->count(),
            'approved' => Testimonial::approved()->count(),
            'featured' => Testimonial::featured()->count(),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'counts'));
    }

    public function show(Testimonial $testimonial): View
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_approved' => ! $testimonial->is_approved]);

        $status = $testimonial->is_approved ? 'approved' : 'unapproved';
        return back()->with('success', "Review {$status} successfully.");
    }

    public function feature(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_featured' => ! $testimonial->is_featured]);

        $status = $testimonial->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "Review {$status} successfully.");
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Review deleted successfully.');
    }
}
