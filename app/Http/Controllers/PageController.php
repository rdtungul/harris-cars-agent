<?php

namespace App\Http\Controllers;

use App\Models\Special;
use App\Models\ServiceCategory;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function specials(): View
    {
        $specials = Special::active()
            ->orderBy('order')
            ->get();

        $expiredSpecials = Special::where('is_active', true)
            ->where('valid_until', '<', now()->toDateString())
            ->orderBy('valid_until', 'desc')
            ->limit(3)
            ->get();

        return view('pages.specials', compact('specials', 'expiredSpecials'));
    }

    public function vehiclesServiced(): View
    {
        $domesticBrands = [
            'Chevrolet', 'Ford', 'GMC', 'Dodge', 'Chrysler', 'Jeep', 'Buick', 'Cadillac',
            'Lincoln', 'Ram', 'Pontiac', 'Oldsmobile',
        ];

        $foreignBrands = [
            'Honda', 'Toyota', 'Nissan', 'Mazda', 'Subaru', 'Mitsubishi', 'Hyundai', 'Kia',
            'BMW', 'Mercedes-Benz', 'Audi', 'Volkswagen', 'Volvo', 'Lexus', 'Acura', 'Infiniti',
            'MINI', 'Jaguar', 'Land Rover', 'Porsche',
        ];

        return view('pages.vehicles-serviced', compact('domesticBrands', 'foreignBrands'));
    }

    public function quote(): View
    {
        $categories = ServiceCategory::active()->ordered()->with('activeServices')->get();
        return view('pages.quote', compact('categories'));
    }
}
