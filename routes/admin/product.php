<?php
use App\Http\Controllers\ProductController;

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
Route::get('/admin/add-products', [ProductController::class, 'addproducts']);
Route::get('/admin/edit-products/{id}', [ProductController::class, 'editproducts'])->name('admin.edit-products');
// Route::get('/admin/delete-products/{id}', [ProductController::class, 'deleteproducts'])->name('admin.delete-products');

Route::get('/admin/get-products', [ProductController::class, 'fetchproducts']);
Route::post('/admin/delete-products', [ProductController::class, 'deleteproducts']);
Route::post('/admin/edit-products', [ProductController::class, 'editproducts']);
Route::post('/admin/add-products', [ProductController::class, 'addproducts']);