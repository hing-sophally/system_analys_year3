<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure User model is included

class UserController extends Controller
{
    public function index(Request $request)
    {
        $module = 'user';
        $users = User::paginate(10); // Fetch 10 users per page
        return view('admin.user.user', compact('module', 'users'));
    }

    public function addUser(Request $request)
    {
        $module = 'user';
        return view('admin.user.add', compact('module'));
    }

    public function editUser(Request $request, $id) // Accept $id parameter
    {
        $module = 'user';
        $user = User::findOrFail($id); // Fetch user by ID
        return view('admin.user.edit', compact('module', 'user'));
    }

    public function deleteUser(Request $request, $id) // Accept $id parameter
    {
        $module = 'user';
        $user = User::findOrFail($id); // Fetch user by ID
        return view('admin.user.delete', compact('module', 'user'));
    }
    public function fetchUser()
    {
        $users = User::paginate(10);
    
        // Access only the data part (users) and return it as JSON
        // dd(response()->json($users->items()));
        return response()->json($users->items());
    }
    
    public function dodeleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
