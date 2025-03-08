<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('doLogin');
