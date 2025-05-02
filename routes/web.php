<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\UserController;

// Route::get('/frontend', function () {
//     return view('frontend.home.index');
// });

Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'km'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return redirect()->back();
});

Route::post('/create-paypal-order', [PayPalController::class, 'createOrder']);
Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');
// Admin
include'admin/auth.php';
Route::middleware(['auth'])->group(function () {
        include 'admin/dashboard.php';
        include 'admin/user.php';
        include 'admin/branch.php';
        include 'admin/categories.php';
        include 'admin/product.php';
        include 'admin/services.php';
        include 'admin/customers.php';
        include 'admin/suppliers.php';
        include 'admin/deliveries.php';
        include 'admin/invoices.php';
        include 'admin/pos.php';
        include 'admin/payment.php';
});

// frontendroutes
include 'frontend/home.php';


Route::get('/clear-cart', function() {
    session()->forget('cart');
    return 'Cart cleared!';
});
