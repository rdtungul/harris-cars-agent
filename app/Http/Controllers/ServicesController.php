<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ServiceCategory::active()
            ->ordered()
            ->with(['activeServices' => fn($q) => $q->ordered()])
            ->get();

        $allServices = Service::with('category')
            ->active()
            ->ordered()
            ->get();

        return view('pages.services', compact('categories', 'allServices'));
    }

    public function show(string $slug): View
    {
        $service = Service::with(['category', 'testimonials' => fn($q) => $q->approved()->latest()->limit(3)])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::with('category')
            ->active()
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('pages.service-detail', compact('service', 'relatedServices'));
    }
}
