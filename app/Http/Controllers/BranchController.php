<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch; // Ensure branch model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $module = 'branch';
        $branches = Branch::paginate(10); // Fetch 10 branches per page
        return view('admin.branch.branch', compact('module', 'branches'));
    }

    public function fetchbranch()
    {
        // $branches = Branch::paginate(10);
        $data = DB::table('branches')->select('*')->get();
    
        // Access only the data part (branches) and return it as JSON
        // dd(response()->json($branches->items()));
        return response()->json($data);
    }
    
    public function deletebranch(Request $request) // Use Request instead of Resqusst
        {
            $branch_id = $request->id;
            $res = DB::table('branches')->where('id', $branch_id)->delete();
            return response()->json(['res' => $res, 'message' => 'branch deleted successfully']);
        }

    public function editbranch( Request $request) {
        // @dd($request->all());
        $id = $request-> id;
        $name = $request->name;
        $logo = $request->logo;
        $location = $request->location;
        $phone = $request->phone;
        $alt_phone = $request->alt_phone;
        $email = $request->email;

        // @dd($id , $branch_name, $email, $role);

        $branch = DB::table('branches')
        ->where('id', $id)
        ->update(
            [
                'name' => $name,
                'logo' => $logo,
                'location' => $location,
                'phone' => $phone,
                'alt_phone' => $alt_phone,
                'email' => $email,
            ]   
        );
        // @dd($branch)
        $new_update = DB::table('branches')->where('id', $id)->first();
        return response()->json([$new_update, 'message' => 'branch updated successfully']);
        // return redirect()->route('admin.branch');

    }
    public function addbranch( Request $request) {
        // @dd($request->all());

        $name = $request->name;
        $logo = $request->logo;
        $location = $request->location;
        $phone = $request->phone;
        $alt_phone = $request->alt_phone;
        $email = $request->email;

        // @dd($id , $branch_name, $email, $role);

        $branch = DB::table('branches')
        ->insert(
            [
                'name' => $name,
                'logo' => $logo,
                'location' => $location,
                'phone' => $phone,
                'alt_phone' => $alt_phone,
                'email' => $email,
            ]   
        );
        // @dd($branch)
        return response()->json([$branch, 'message' => 'branch updated successfully']);
        // return redirect()->route('admin.branch');

    }
        

}
