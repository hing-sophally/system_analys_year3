<?php

use App\Http\Controllers\PaymentController;
    Route::get('/reports', [PaymentController::class, 'index'])->name('admin.reports');
    Route::get('/get-reports', [PaymentController::class, 'getReports']);
    Route::post('/add-reports', [PaymentController::class, 'addReport']);
    Route::post('/edit-reports', [PaymentController::class, 'editReport']);
    Route::post('/delete-reports', [PaymentController::class, 'deleteReport']);