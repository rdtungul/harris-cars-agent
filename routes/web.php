<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ZohoWebhookController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Services
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('services.show');

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/specials', [PageController::class, 'specials'])->name('specials');
Route::get('/vehicles-serviced', [PageController::class, 'vehiclesServiced'])->name('vehicles.serviced');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Testimonials / Reviews
Route::get('/reviews', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/reviews', [TestimonialController::class, 'store'])->name('testimonials.store');

// Appointments / Booking
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointment/confirmation', [AppointmentController::class, 'confirmation'])->name('appointments.confirmation');

// Quote
Route::get('/quote', [PageController::class, 'quote'])->name('quote');

/*
|--------------------------------------------------------------------------
| Zoho Webhook (CSRF exempt — added to VerifyCsrfToken $except)
|--------------------------------------------------------------------------
*/
Route::post('/zoho/webhook', [ZohoWebhookController::class, 'handle'])->name('zoho.webhook');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
