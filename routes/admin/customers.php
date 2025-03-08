<?php
use App\Http\Controllers\CustomersController;

Route::get('admin/customers', [CustomersController::class, 'index'])->name('admin.customers');
Route::get('/admin/add-customers', [CustomersController::class, 'addcustomers']);
Route::get('/admin/edit-customers/{id}', [CustomersController::class, 'editcustomers'])->name('admin.edit-customers');
// Route::get('/admin/delete-customers/{id}', [CustomersController::class, 'deletecustomers'])->name('admin.delete-customers');

Route::get('/admin/get-customers', [CustomersController::class, 'fetchcustomers']);
Route::post('/admin/delete-customers', [CustomersController::class, 'deletecustomers']);
Route::post('/admin/edit-customers', [CustomersController::class, 'editcustomers']);
Route::post('/admin/add-customers', [CustomersController::class, 'addcustomers']);