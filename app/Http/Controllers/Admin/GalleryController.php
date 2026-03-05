<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = Gallery::ordered()->paginate(24);
        $categories = Gallery::CATEGORIES;

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function create(): View
    {
        $categories = Gallery::CATEGORIES;
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'images'      => ['required', 'array', 'min:1'],
            'images.*'    => ['required', 'image', 'max:8192'],
            'category'    => ['required', 'string', 'in:' . implode(',', array_keys(Gallery::CATEGORIES))],
            'caption'     => ['nullable', 'string', 'max:255'],
            'alt_text'    => ['nullable', 'string', 'max:255'],
        ]);

        $uploaded = 0;
        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'public');
            Gallery::create([
                'image_path' => $path,
                'category'   => $request->category,
                'caption'    => $request->caption,
                'alt_text'   => $request->alt_text ?? $request->caption,
                'is_active'  => true,
            ]);
            $uploaded++;
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', "{$uploaded} image(s) uploaded successfully.");
    }

    public function edit(Gallery $gallery): View
    {
        $categories = Gallery::CATEGORIES;
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $request->validate([
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(Gallery::CATEGORIES))],
            'caption'  => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'order'    => ['nullable', 'integer', 'min:0'],
            'image'    => ['nullable', 'image', 'max:8192'],
        ]);

        $data = $request->only(['category', 'caption', 'alt_text', 'order']);

        if ($request->hasFile('image')) {
            \Storage::disk('public')->delete($gallery->image_path);
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        \Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted successfully.');
    }

    public function toggle(Gallery $gallery): RedirectResponse
    {
        $gallery->update(['is_active' => ! $gallery->is_active]);
        $status = $gallery->is_active ? 'shown' : 'hidden';

        return back()->with('success', "Image {$status} successfully.");
    }
}
