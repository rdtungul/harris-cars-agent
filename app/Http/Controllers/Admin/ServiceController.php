<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::with('category')
            ->ordered()
            ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $categories = ServiceCategory::active()->ordered()->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id'       => ['required', 'exists:service_categories,id'],
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'icon'              => ['nullable', 'string', 'max:100'],
            'price_range'       => ['nullable', 'string', 'max:100'],
            'duration'          => ['nullable', 'string', 'max:100'],
            'is_active'         => ['boolean'],
            'is_featured'       => ['boolean'],
            'order'             => ['nullable', 'integer', 'min:0'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'image'             => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function show(Service $service): View
    {
        $service->load(['category', 'testimonials' => fn($q) => $q->approved()->latest()]);
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service): View
    {
        $categories = ServiceCategory::active()->ordered()->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'category_id'       => ['required', 'exists:service_categories,id'],
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'icon'              => ['nullable', 'string', 'max:100'],
            'price_range'       => ['nullable', 'string', 'max:100'],
            'duration'          => ['nullable', 'string', 'max:100'],
            'is_active'         => ['boolean'],
            'is_featured'       => ['boolean'],
            'order'             => ['nullable', 'integer', 'min:0'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'image'             => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image) {
                \Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->image) {
            \Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function toggle(Service $service): RedirectResponse
    {
        $service->update(['is_active' => ! $service->is_active]);

        $status = $service->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Service {$status} successfully.");
    }

    public function feature(Service $service): RedirectResponse
    {
        $service->update(['is_featured' => ! $service->is_featured]);

        $status = $service->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "Service {$status} successfully.");
    }
}
