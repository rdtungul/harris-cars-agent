<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->get('category', 'all');

        $query = Gallery::active()->ordered();

        if ($category !== 'all' && array_key_exists($category, Gallery::CATEGORIES)) {
            $query->inCategory($category);
        }

        $images = $query->paginate(18);

        $categories = Gallery::CATEGORIES;

        return view('pages.gallery', compact('images', 'categories', 'category'));
    }
}
