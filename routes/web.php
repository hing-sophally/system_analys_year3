<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin
include 'admin/dashboard.php';
include 'admin/user.php';
include 'admin/branch.php';