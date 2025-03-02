<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories; // Ensure categories model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoiresController extends Controller
{
    public function index(Request $request)
    {
        $module = 'categories';
        $categories = Categories::paginate(10); // Fetch 10 categories per page
        return view('admin.categories.categories', compact('module', 'categories'));
    }

    public function fetchcategories()
    {
        // $categories = categories::paginate(10);
        $data = DB::table('categories')->select('*')->get();
    
        // Access only the data part (categories) and return it as JSON
        // dd(response()->json($categories->items()));
        return response()->json($data);
    }
    
    public function deletecategories(Request $request) // Use Request instead of Resqusst
        {
            $categories_id = $request->id;
            $res = DB::table('categories')->where('id', $categories_id)->delete();
            return response()->json(['res' => $res, 'message' => 'categories deleted successfully']);
        }

    public function editcategories( Request $request) {
        // @dd($request->all());
        $id = $request-> id;
        $name = $request->name;
        $logo = $request->logo;
        $location = $request->location;
        $phone = $request->phone;
        $alt_phone = $request->alt_phone;
        $email = $request->email;

        // @dd($id , $categories_name, $email, $role);

        $categories = DB::table('categories')
        ->where('id', operator: $id)
        ->update(
            [
                'name' => $name,
                
            ]   
        );
        // @dd($categories)
        $new_update = DB::table('categories')->where('id', $id)->first();
        return response()->json([$new_update, 'message' => 'categories updated successfully']);
        // return redirect()->route('admin.categories');

    }
    public function addcategories( Request $request) {
        // @dd($request->all());

        $name = $request->name;
        

        // @dd($id , $categories_name, $email, $role);

        $categories = DB::table('categories')
        ->insert(
            values: [
                'name' => $name,
                
            ]   
        );
        // @dd($categories)
        return response()->json([$categories, 'message' => 'categories updated successfully']);
        // return redirect()->route('admin.categories');

    }
        

}
