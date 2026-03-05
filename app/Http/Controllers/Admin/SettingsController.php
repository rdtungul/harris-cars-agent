<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'settings'   => ['required', 'array'],
            'settings.*' => ['nullable', 'string'],
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            Setting::set($key, $value);
        }

        // Handle any file uploads (logos, images)
        if ($request->hasFile('logo')) {
            $request->validate(['logo' => ['image', 'max:2048']]);
            $path = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', $path, 'image', 'appearance');
        }

        if ($request->hasFile('favicon')) {
            $request->validate(['favicon' => ['image', 'max:512']]);
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $path, 'image', 'appearance');
        }

        // Clear all settings cache
        Setting::clearCache();

        return back()->with('success', 'Settings saved successfully.');
    }
}
