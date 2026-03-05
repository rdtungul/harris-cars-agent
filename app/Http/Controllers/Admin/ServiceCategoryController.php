<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::withCount('services')->ordered()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255', 'unique:service_categories,slug'],
            'description'      => ['nullable', 'string', 'max:1000'],
            'icon'             => ['nullable', 'string', 'max:100'],
            'order'            => ['nullable', 'integer', 'min:0'],
            'is_active'        => ['boolean'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'image'            => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        ServiceCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, ServiceCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255', 'unique:service_categories,slug,' . $category->id],
            'description'      => ['nullable', 'string', 'max:1000'],
            'icon'             => ['nullable', 'string', 'max:100'],
            'order'            => ['nullable', 'integer', 'min:0'],
            'is_active'        => ['boolean'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'image'            => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $category): RedirectResponse
    {
        if ($category->services()->count() > 0) {
            return back()->with('error', 'Cannot delete category with associated services. Remove or reassign services first.');
        }

        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggle(ServiceCategory $category): RedirectResponse
    {
        $category->update(['is_active' => ! $category->is_active]);
        $status = $category->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Category {$status} successfully.");
    }
}
