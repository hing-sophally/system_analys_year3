<?php
use App\Http\Controllers\PosController;

Route::get('/admin/pos', [PosController::class, 'index'])->name('admin.pos');