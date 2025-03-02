<?php
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'index'])->name('admin.user');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('doLogin');
