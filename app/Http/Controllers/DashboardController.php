<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\Services;
use App\Models\Categories ;
use App\Models\Customers;
use App\Models\Deliveries;

class DashboardController extends Controller
{
    // public function index()
    // {

    //     $module = 'dashboard';
    //     return view('admin.dashboard',['module' => $module]);
    // }
    public function index()
    {
        // Get count of each entity
        $usersCount = User::count(); // Assuming you have a User model
        $branchesCount = Branch::count(); // Assuming you have a Branch model
        $servicesCount = Services::count(); // Assuming you have a Service model
        $categoriesCount = Categories::count(); // Assuming you have a Category model
        $customersCount = Customers::count(); // Assuming you have a Customer model
        $suppliersCount = Suppliers::count(); // Assuming you have a Customer model
        $deliveriesCount = Deliveries::count(); // Assuming you have a Customer model
        $module = 'dashboard';

        // Pass counts to the view
        return view('admin.dashboard', compact('usersCount','deliveriesCount', 'suppliersCount','branchesCount', 'servicesCount', 'categoriesCount', 'customersCount') ,['module' => $module]);
    }
}
