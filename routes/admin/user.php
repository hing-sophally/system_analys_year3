<?php
use App\Http\Controllers\UserController;

Route::get('admin/user', [UserController::class, 'index']);
Route::get('/admin/add-user', [UserController::class, 'addUser']);
Route::get('/admin/edit-user/{id}', [UserController::class, 'editUser'])->name('admin.edit-user');
Route::get('/admin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('admin.delete-user');

Route::get('/admin/get-user', [UserController::class, 'fetchUser']);
Route::delete('/admin/delete-user/{id}', [UserController::class, 'dodeleteUser']);