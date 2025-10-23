<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.contact');
Route::get('/products', [HomeController::class, 'products'])->name('frontend.products');
// Cart and wishlist routes removed - using popup modals only
Route::get('/profile', [HomeController::class, 'profile'])->name('frontend.profile');
Route::get('/orders', [HomeController::class, 'orders'])->name('frontend.orders');
Route::get('/register', [HomeController::class, 'register'])->name('frontend.register');