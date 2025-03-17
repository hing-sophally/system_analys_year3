<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    // Show Invoice Page
    public function index(Request $request)
    {
        $module = 'pos';
        return view('admin.pos.pos', compact('module'));
    }
}
