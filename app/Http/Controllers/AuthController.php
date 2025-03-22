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
    return view(view: 'admin.login');
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

    public function logout(Request $request)
    {
        Auth::logout(); // Logout the currently authenticated user
        
        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate CSRF token for security

        return redirect('/login')->with('success', 'Logout successfully!');
    }
    
    

      

}
