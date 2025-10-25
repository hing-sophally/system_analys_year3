<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ensure products model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $module = 'products';

    // Fetch products with their associated category name
    $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->paginate(10); // Fetch 10 products per page

    // Debugging: Dump the data
    // dd($products);

    return view('admin.products.products', compact('module', 'products'));
}

public function fetchproducts()
{
    // Join the products table with the categories table
    $data = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name') // Select products columns and category name
        ->get();
    
    // Return the data as JSON, including the category name
    return response()->json($data);
}

    
    public function deleteproducts(Request $request) // Use Request instead of Resqusst
        {
            $products_id = $request->id;
            $res = DB::table('products')->where('id', $products_id)->delete();
            return response()->json(['res' => $res, 'message' => 'products deleted successfully']);
        }

        
        public function addproducts(Request $request) {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id', // Ensure category_id exists in the categories table
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'discount' => 'nullable|numeric|min:0|max:100', // Discount percentage (0-100)
                'stock' => 'required|integer',
                'status' => 'nullable|boolean',  // Optional, default to 1 (active)
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Only validate if image is provided
            ]);
        
            $category_id = $request->category_id;
            $name = $request->name;
            $description = $request->description;
            $price = $request->price;
            $discount = $request->discount ?? 0;  // Default to 0 if no discount is provided
            $stock = $request->stock;
            $status = $request->status ?? 1;  // Default to 1 if no status is provided
        
            // Handle file upload if an image is provided
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imagePath = $image->store('products', 'public'); // Save image to 'storage/app/public/products'
            } else {
                $imagePath = null;  // Or use a default image path
            }
        
            // Insert the new product into the database
            DB::table('products')
                ->insert([
                    'name' => $name,
                    'category_id' => $category_id,  // Insert category_id
                    'image_url' => $imagePath,
                    'description' => $description,
                    'price' => $price,
                    'discount' => $discount,
                    'stock' => $stock,
                    'status' => $status,
                ]);
        
            return response()->json(['message' => 'Product added successfully']);
        }
        
    
        public function editproducts(Request $request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',  // Ensure category_id exists in the categories table
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'discount' => 'nullable|numeric|min:0|max:100', // Discount percentage (0-100)
                'stock' => 'required|integer',
                'status' => 'nullable|boolean',  // Optional, default to 1 (active)
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $name = $request->name;
            $category_id = $request->category_id;
            $description = $request->description;
            $price = $request->price;
            $discount = $request->discount ?? 0;  // Default to 0 if no discount is provided
            $stock = $request->stock;
            $status = $request->status ?? 1;  // Default to 1 if no status is provided
        
            // Get the current product to preserve existing image if no new one is uploaded
            $currentProduct = DB::table('products')->where('id', $request->id)->first();
            $imagePath = $currentProduct->image_url; // Keep existing image by default
        
            // Handle file upload if a new file is uploaded
            if ($request->hasFile('image_url')) {
                // Delete old image if it exists and is not a placeholder URL
                if ($currentProduct->image_url && !str_starts_with($currentProduct->image_url, 'http')) {
                    Storage::delete('public/' . $currentProduct->image_url);
                }
                $imagePath = $request->file('image_url')->store('products', 'public');
            }
        
            // Update the product in the database
            DB::table('products')->where('id', $request->id)->update([
                'name' => $name,
                'category_id' => $category_id,  // Update category_id
                'image_url' => $imagePath,
                'description' => $description,
                'price' => $price,
                'discount' => $discount,
                'stock' => $stock,
                'status' => $status,
            ]);
        
            return response()->json(['message' => 'Product updated successfully']);
        }
        
        

     
    

}
