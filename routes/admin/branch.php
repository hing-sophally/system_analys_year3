<?php
use App\Http\Controllers\BranchController;

Route::get('/admin/branch', [BranchController::class, 'index'])->name('admin.branch');
Route::get('/admin/add-branch', [BranchController::class, 'addbranch']);
Route::get(uri: '/admin/edit-branch/{id}', action: [BranchController::class, 'editbranch'])->name('admin.edit-branch');
// Route::get('/admin/delete-branch/{id}', [branchController::class, 'deletebranch'])->name('admin.delete-branch');

Route::get('/admin/get-branch', [BranchController::class, 'fetchbranch']);
Route::post('/admin/delete-branch', [BranchController::class, 'deletebranch']);
Route::post('/admin/edit-branch', [BranchController::class, 'editbranch']);
Route::post('/admin/add-branch', [BranchController::class, 'addbranch']);