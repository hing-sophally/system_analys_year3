<?php
use App\Http\Controllers\CategoiresController;

Route::get('/admin/categories', [CategoiresController::class, 'index'])->name('admin.categories');
Route::get('/admin/add-categories', [CategoiresController::class, 'addcategories']);
Route::get('/admin/edit-categories/{id}', [CategoiresController::class, 'editcategories'])->name('admin.edit-categories');
// Route::get('/admin/delete-categories/{id}', [CategoiresController::class, 'deletecategories'])->name('admin.delete-categories');

Route::get('/admin/get-categories', [CategoiresController::class, 'fetchcategories']);
Route::post('/admin/delete-categories', [CategoiresController::class, 'deletecategories']);
Route::post('/admin/edit-categories', [CategoiresController::class, 'editcategories']);
Route::post('/admin/add-categories', [CategoiresController::class, 'addcategories']);