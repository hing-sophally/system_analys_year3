<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;

class HomeController extends Controller
{
    public function index()
    {
        // Get active products (since there's no featured column, we'll use status)
        $featuredProducts = Product::where('status', true)
            ->with('category')
            ->limit(8)
            ->get();
        
        // Get categories with their products for tab functionality
        $categories = Categories::with(['products' => function($query) {
            $query->where('status', true)->limit(8);
        }])->limit(6)->get();
        
        return view('frontend.index', compact('featuredProducts', 'categories'));
    }
    
    public function about()
    {
        return view('frontend.about');
    }
    
    public function contact()
    {
        return view('frontend.contact');
    }
    
    public function products()
    {
        $products = Product::where('status', true)->with('category')->paginate(12);
        return view('frontend.products', compact('products'));
    }
    
    // Cart and wishlist methods removed - using popup modals only
    
    public function profile()
    {
        return view('frontend.profile');
    }
    
    public function orders()
    {
        return view('frontend.orders');
    }
    
    public function register()
    {
        return view('frontend.register');
    }
}