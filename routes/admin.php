<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ServiceCategoryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin routes are protected by 'auth' and 'admin' middleware.
| Controllers live in App\Http\Controllers\Admin namespace.
|
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Service Categories
    Route::resource('categories', ServiceCategoryController::class)->except(['show']);
    Route::patch('categories/{category}/toggle', [ServiceCategoryController::class, 'toggle'])->name('categories.toggle');

    // Services
    Route::resource('services', ServiceController::class);
    Route::patch('services/{service}/toggle', [ServiceController::class, 'toggle'])->name('services.toggle');
    Route::patch('services/{service}/feature', [ServiceController::class, 'feature'])->name('services.feature');

    // Appointments
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show', 'destroy']);
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');

    // Testimonials / Reviews
    Route::resource('testimonials', TestimonialController::class)->only(['index', 'show', 'destroy']);
    Route::patch('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::patch('testimonials/{testimonial}/feature', [TestimonialController::class, 'feature'])->name('testimonials.feature');

    // Gallery
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::patch('gallery/{gallery}/toggle', [GalleryController::class, 'toggle'])->name('gallery.toggle');

    // Settings / CMS
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});
