<?php
use App\Http\Controllers\PosController;

Route::get('/admin/pos', [PosController::class, 'index'])->name('admin.pos');
Route::get('/admin/pos/getPosData', [PosController::class, 'getPosData'])->name('admin.getPosData');