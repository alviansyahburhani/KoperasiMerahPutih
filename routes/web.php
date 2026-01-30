<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

// Landing Page Routes (Public)
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/tentang', [LandingController::class, 'about'])->name('landing.about');
Route::get('/fitur', [LandingController::class, 'features'])->name('landing.features');
Route::get('/harga', [LandingController::class, 'pricing'])->name('landing.pricing');
Route::get('/blog', [LandingController::class, 'blog'])->name('landing.blog');
Route::get('/blog/{slug}', [LandingController::class, 'blogShow'])->name('landing.blog.show');
Route::get('/kontak', [LandingController::class, 'contact'])->name('landing.contact');
Route::post('/kontak', [LandingController::class, 'contactStore'])->name('landing.contact.store');
Route::get('/daftar', [LandingController::class, 'register'])->name('landing.register');
Route::post('/daftar', [LandingController::class, 'registerStore'])->name('landing.register.store');
Route::get('/daftar/sukses', [LandingController::class, 'registerSuccess'])->name('landing.register.success');