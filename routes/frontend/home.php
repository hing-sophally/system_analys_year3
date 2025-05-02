
<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;


// Route::get('/frontend', function () {
//     return view('frontend.home.index');
// });
Route::get('/home', [HomeController::class, 'index']);
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/productApi', [HomeController::class, 'productApi'])->name('productApi');
Route::post('/cart/add', [HomeController::class, 'add'])->name('cart.add');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
Route::post('/cart/update', [HomeController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [HomeController::class, 'remove'])->name('cart.remove');