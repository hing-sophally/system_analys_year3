<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure User model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function index(Request $request)
    {
    return view('admin.login');
    }
    public function doLogin(Request $request)
    {
        // dd($request->all());
        $user = User::where('username', $request->username)->first();
    
        if (!$user) {
            return back()->with(key: 'error', value: 'User not found');
        }
    
        // Debug: Check if password is hashed properly
        // dd([
        //     'entered_password' => $request->password,
        //     'hashed_password_in_db' => $user->password,
        //     'password_matches' => Hash::check($request->password, $user->password),
        // ]);
    
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/admin/dashboard');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }
    
    

      

}
