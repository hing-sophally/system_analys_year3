<?php
use App\Http\Controllers\DeliveryController;

Route::get('admin/deliveries', [DeliveryController::class, 'index'])->name('admin.deliveries');
Route::get('/admin/add-deliveries', [DeliveryController::class, 'adddeliveries']);
Route::get('/admin/edit-deliveries/{id}', [DeliveryController::class, 'editdeliveries'])->name('admin.edit-deliveries');
// Route::get('/admin/delete-deliveries/{id}', [DeliveryController::class, 'deletedeliveries'])->name('admin.delete-deliveries');

Route::get('/admin/get-deliveries', [DeliveryController::class, 'fetchdeliveries']);
Route::post('/admin/delete-deliveries', [DeliveryController::class, 'deletedeliveries']);
Route::post('/admin/edit-deliveries', [DeliveryController::class, 'editdeliveries']);
Route::post('/admin/add-deliveries', [DeliveryController::class, 'adddeliveries']);