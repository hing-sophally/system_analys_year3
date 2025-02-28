<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure User model is included
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $name = $request->name;
            $email = $request->email;
            $gender = $request->gender;
            $role = $request->role;
        
            // Update the user in the database
            $user = DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                    'gender' => $gender,
                    'role' => $role,
                ]);
        
            // Retrieve the updated user
            $new_update = DB::table('users')->where('id', $id)->first();
        
            // Return the updated user as a JSON response
            return response()->json([$new_update, 'message' => 'User updated successfully']);
        }
    public function adduser( Request $request) {
        // @dd($request->all());

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $gender = $request->gender;
        $role = $request->role;

        // @dd($id , $user_name, $email, $role);

        $user = DB::table('users')
        ->insert(
            [
                'name' => $name,
                'email' => $email,
                'gender' => $gender,
                'password' => Hash::make($password),
                'role' => $role,
            ]   
        );
        // @dd($user)
        return response()->json([$user, 'message' => 'User updated successfully']);
        // return redirect()->route('admin.user');

    }
        

}
