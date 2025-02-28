<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('admin/dashboard', [DashboardController::class, 'index']);
Route::get('/', [DashboardController::class,'index']);