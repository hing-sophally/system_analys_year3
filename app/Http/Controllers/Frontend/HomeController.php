<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Define the module identifier for view purposes
    $module = 'home';

    // Fetch all categories from the 'categories' table
    $categories = DB::table('categories')->select('*')->get();
    $products = DB::table('products')->select('*')->get();

    // Return the home view with the fetched data
    return view('frontend.home.index', compact('module', 'categories','products'));    }

    public function product(Request $request)
{
    // Define the module identifier for view purposes
    $module = 'product';

    // Fetch categories
    $categories = Categories::all();
    
    // Fetch products, optionally filtering by category if provided
    $products = Product::when($request->category, function($query) use ($request) {
        $query->where('category_id', $request->category);
    })->get();

    // Check if the request is an AJAX request to return data in JSON format
    if ($request->ajax()) {
        return response()->json([
            'products' => $products
        ]);
    }

    // Return the home view with the fetched data for non-AJAX requests
    return view('frontend.product_list.index', compact('module', 'categories', 'products'));
}
public function productApi(Request $request)
{
    $categories = Categories::all();
    $products = Product::when($request->category, function($query) use ($request) {
        $query->where('category_id', $request->category);
    })->get();

    // Ensure you are returning JSON, not HTML.
    return response()->json([
        'products' => $products,
        'categories' => $categories
    ]);
}

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Get the existing cart from session
        $cart = Session::get('cart', []);

        // Add or update the product in the cart
        if (isset($cart[$productId])) {
            $cart[$productId] += 1;
        } else {
            $cart[$productId] = 1;
        }

        // Save it back to the session
        Session::put('cart', $cart);

        // Return new cart count
        return response()->json([
            'cartCount' => array_sum($cart)
        ]);
    }
    public function cart()
{
    $cart = Session::get('cart', []);

    $products = Product::whereIn('id', array_keys($cart))->get();

    $cartItems = [];

    foreach ($products as $product) {
        $quantity = $cart[$product->id] ?? 1;
        $subtotal = $product->price * $quantity; // 🛠️ calculate subtotal correctly

        $cartItems[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'subtotal' => $subtotal, // 🛠️ Add subtotal to the array
        ];
    }

    return view('frontend.cart.index', [
        'cart' => $cartItems
    ]);
}

    
    // Update quantity
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
    
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
        }
    
        session()->put('cart', $cart);
    
        return response()->json(['success' => true]);
    }
    

// Remove item
public function remove(Request $request)
{
    $productId = $request->input('product_id');

    // Get the current cart from session
    $cart = session()->get('cart', []);

    // Remove the item from the cart if it exists
    if(isset($cart[$productId])) {
        unset($cart[$productId]);

        // Update the session with the new cart
        session()->put('cart', $cart);
    }

    // Return a success response
    return response()->json(['success' => true]);
}

    
}
