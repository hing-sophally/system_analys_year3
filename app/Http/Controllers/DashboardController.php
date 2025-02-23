<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $module = 'dashboard';
        return view('admin.dashboard',['module' => $module]);
    }
}
