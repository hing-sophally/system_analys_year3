<?php
use App\Http\Controllers\InvoicesController;

Route::get('/admin/invoices', [InvoicesController::class, 'index'])->name('admin.invoices');
Route::get('/admin/add-invoices', [InvoicesController::class, 'addinvoices']);
Route::get('/admin/edit-invoices/{id}', [InvoicesController::class, 'editinvoices'])->name('admin.edit-invoices');
// Route::get('/admin/delete-invoices/{id}', [InvoicesController::class, 'deleteinvoices'])->name('admin.delete-invoices');

Route::get('/admin/get-invoices', [InvoicesController::class, 'fetchinvoices']);
Route::post('/admin/delete-invoices', [InvoicesController::class, 'deleteInvoice']);
Route::post('/admin/edit-invoices', [InvoicesController::class, 'editInvoice']);
Route::post('/admin/add-invoices', [InvoicesController::class, 'addInvoice']);