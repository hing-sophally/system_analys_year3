<?php
use App\Http\Controllers\DashboardController;

Route::get('admin/dashboard', [DashboardController::class, 'index']);
