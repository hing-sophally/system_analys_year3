<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'km'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return redirect()->back();
});

// Admin
include'admin/auth.php';
Route::middleware(['auth'])->group(function () {
        include 'admin/dashboard.php';
        include 'admin/user.php';
        include 'admin/branch.php';
        include 'admin/categories.php';
        include 'admin/services.php';
        include 'admin/customers.php';
        include 'admin/suppliers.php';
        include 'admin/deliveries.php';
});