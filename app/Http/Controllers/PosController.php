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
    public function getPosData(Request $request)
    {
        $category_obj = new CategoiresController();
        $categories = $category_obj->fetchcategories($request);

        $services = DB::table('services')
            ->join('categories', 'categories.id', '=', 'services.category_id')
            ->select('services.*', 'categories.name as category')
            ->get();
        
        return response()->json(
        data: [
                    'services' => $services,
                    'categories' => $categories,
                ]);
    }

}
