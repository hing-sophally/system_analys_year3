<?php
use App\Http\Controllers\ServicesController;

Route::get('/admin/services', [ServicesController::class, 'index'])->name('admin.services');
Route::get('/admin/add-services', [ServicesController::class, 'addservices']);
Route::get('/admin/edit-services/{id}', [ServicesController::class, 'editservices'])->name('admin.edit-services');
// Route::get('/admin/delete-services/{id}', [ServicesController::class, 'deleteservices'])->name('admin.delete-services');

Route::get('/admin/get-services', [ServicesController::class, 'fetchservices']);
Route::post('/admin/delete-services', [ServicesController::class, 'deleteservices']);
Route::post('/admin/edit-services', [ServicesController::class, 'editservices']);
Route::post('/admin/add-services', [ServicesController::class, 'addservices']);