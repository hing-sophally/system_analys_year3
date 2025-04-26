<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services; // Ensure services model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $module = 'services';
        $services = Services::paginate(10); // Fetch 10 services per page
        return view('admin.services.services', compact('module', 'services'));
    }

    public function fetchservices( Request $request)
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
    
    public function deleteservices(Request $request) // Use Request instead of Resqusst
        {
            $services_id = $request->id;
            $res = DB::table('services')->where('id', operator: $services_id)->delete();
            return response()->json(['res' => $res, 'message' => 'services deleted successfully']);
        }

    // public function editservices( Request $request) {
    //     // @dd($request->all());
    //     $id = $request-> id;
    //     $name = $request->name;
    //     $logo = $request->logo;
    //     $location = $request->location;
    //     $phone = $request->phone;
    //     $alt_phone = $request->alt_phone;
    //     $email = $request->email;

    //     // @dd($id , $services_name, $email, $role);

    //     $services = DB::table('services')
    //     ->where('id', operator: $id)
    //     ->update(
    //         [
    //             'name' => $name,
                
    //         ]   
    //     );
    //     // @dd($services)
    //     $new_update = DB::table('services')->where('id', $id)->first();
    //     return response()->json([$new_update, 'message' => 'services updated successfully']);
    //     // return redirect()->route('admin.services');

    // }
    // public function addservices( Request $request) {
    //     // @dd($request->all());

    //     $name = $request->name;
        

    //     // @dd($id , $services_name, $email, $role);

    //     $services = DB::table('services')
    //     ->insert(
    //         values: [
    //             'name' => $name,
                
    //         ]   
    //     );
    //     // @dd($services)
    //     return response()->json([$services, 'message' => 'services updated successfully']);
    //     // return redirect()->route('admin.services');

    // }
        
    public function addServices(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'image_url' => 'nullable|image|max:2048',
        ]);
        
        $imagePath = null;
    
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('services_images', 'public'); // Store the image in 'services_images' folder
        }
    
        $service = new Services();
        $service->name = $request->name;
        $service->cost = $request->cost;
        $service->price = $request->price;
        $service->discount = $request->discount;
        $service->image_url = $imagePath;
        $service->save();
    
        return response()->json($service);
    }
    
    public function editServices(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image_url' => 'nullable|image|max:2048', // Validate the image
        ]);
    
        $service = Services::find($request->id);
        $service->name = $request->name;
        $service->cost = $request->cost;
        $service->price = $request->price;
        $service->discount = $request->discount;
    
        if ($request->hasFile('image_url')) {
            // Delete the old image if exists
            if ($service->image_url) {
                Storage::delete(paths: 'public/' . $service->image_url);
            }
    
            $service->image_url = $request->file('image_url')->store('services_images', 'public');
        }
    
        $service->save();
    
        return response()->json($service);
    }
}
