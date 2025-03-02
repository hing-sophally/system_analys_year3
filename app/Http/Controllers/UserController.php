<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure User model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $module = 'user';
        $users = User::paginate(10); // Fetch 10 users per page
        return view('admin.user.user', compact('module', 'users'));
    }

    public function fetchUser()
    {
        // $users = User::paginate(10);
        $data = DB::table('users')->select('*')->get();
    
        // Access only the data part (users) and return it as JSON
        // dd(response()->json($users->items()));
        return response()->json($data);
    }
    
    public function deleteUser(Request $request) // Use Request instead of Resqusst
        {
            $user_id = $request->id;
            $res = DB::table('users')->where('id', $user_id)->delete();
            return response()->json(['res' => $res, 'message' => 'User deleted successfully']);
        }

        public function edituser(Request $request) {
            // Retrieve the id and other fields from the request
            $id = $request->id;
            $username = $request->username;
            $email = $request->email;
            $gender = $request->gender;
            $password = $request->password;
            $role = $request->role;
        
            // Update the user in the database
            $user = DB::table('users')
                ->where('id', $id)
                ->update([
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make('password'), // Hash the password
                    'gender' => $gender,
                    'role' => $role,
                ]);
        
            // Retrieve the updated user
            $new_update = DB::table('users')->where(column: 'id', operator: $id)->first();
        
            // Return the updated user as a JSON response
            return response()->json([$new_update, 'message' => 'User updated successfully']);
        }
        public function addUser(Request $request) {
            // Log request data for debugging
            Log::info('Add User Request:', $request->all());
        
            // Validate request data
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'gender' => 'required|string',
                'role' => 'required|string'
            ]);
        
            // Insert user into the database with hashed password
            $user = DB::table('users')->insert([
                'username' => $request->username,
                'email' => $request->email,
                'gender' => $request->gender,
                'password' => Hash::make($request->password), // ✅ Hashing password properly
                'role' => $request->role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        
            return response()->json([
                'success' => (bool) $user,
                'message' => $user ? 'User added successfully' : 'Failed to add user'
            ]);
        }
        
        

}
