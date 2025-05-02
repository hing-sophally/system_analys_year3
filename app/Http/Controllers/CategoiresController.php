<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories; // Ensure categories model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        
        public function addCategories(Request $request) {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Only validate if image is provided
            ]);
        
            $name = $request->name;
            $description = $request->description;
        
            // Handle file upload if an image is provided
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imagePath = $image->store('categories', 'public'); // Save image to 'storage/app/public/categories'
            } else {
                // If no image is uploaded, you can set a default image or handle accordingly
                $imagePath = null;  // Or use a default image path
            }
        
            // Insert the new category into the database
            DB::table('categories')
                ->insert([
                    'name' => $name,
                    'image_url' => $imagePath, // Store the image path in the database
                    'description' => $description,
                ]);
        
            return response()->json(['message' => 'Category added successfully']);
        }
        
    
        public function editCategories(Request $request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            // Handle file upload if a new file is uploaded
            if ($request->hasFile('image_url')) {
                $imagePath = $request->file('image_url')->store('categories', 'public');
            } else {
                // Use the existing image if no new file is uploaded
                $imagePath = $request->input('existing_image'); // Ensure you pass this from the frontend if editing
            }
        
            DB::table('categories')->where('id', $request->id)->update([
                'name' => $request->name,
                'image_url' => $imagePath,
                'description' => $request->description,
            ]);
        
            return response()->json(['message' => 'Category updated successfully']);
        }
        
        
    

}
