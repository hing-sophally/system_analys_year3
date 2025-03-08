<?php
use App\Http\Controllers\SupplierController;

Route::get('admin/suppliers', [SupplierController::class, 'index'])->name('admin.suppliers');
Route::get('/admin/add-suppliers', [SupplierController::class, 'addsuppliers']);
Route::get('/admin/edit-suppliers/{id}', [SupplierController::class, 'editsuppliers'])->name('admin.edit-suppliers');
// Route::get('/admin/delete-suppliers/{id}', [SupplierController::class, 'deletesuppliers'])->name('admin.delete-suppliers');

Route::get('/admin/get-suppliers', [SupplierController::class, 'fetchsuppliers']);
Route::post('/admin/delete-suppliers', [SupplierController::class, 'deletesuppliers']);
Route::post('/admin/edit-suppliers', [SupplierController::class, 'editsuppliers']);
Route::post('/admin/add-suppliers', [SupplierController::class, 'addsuppliers']);