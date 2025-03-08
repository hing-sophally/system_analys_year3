<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers; // Ensure you're using the correct model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $module = 'customers';
        $customers = Customers::paginate(10); // Fetch 10 customers per page
        return view('admin.customers.customers', compact('module', 'customers'));
    }

    public function fetchCustomers()
    {
        // Fetch all customers from the database
        $data = DB::table('customers')->select('*')->get();

        return response()->json($data);
    }

    public function deleteCustomers(Request $request)
    {
        // Retrieve the customer id from the request
        $customer_id = $request->id;

        // Delete the customer record from the database
        $res = DB::table('customers')->where('id', $customer_id)->delete();

        return response()->json(['res' => $res, 'message' => 'Customer deleted successfully']);
    }

    public function editCustomers(Request $request)
    {
        // Retrieve the id and all necessary fields from the request
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $gender = $request->gender;
        $alt_phone = $request->alt_phone;
        $point = $request->point;
        $current_location = $request->current_location;

        // Update the customer record in the database
        $customer = DB::table('customers')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'gender' => $gender,
                'alt_phone' => $alt_phone,
                'point' => $point,
                'current_location' => $current_location,
                'updated_at' => now()
            ]);

        // Fetch the updated customer record
        $updated_customer = DB::table('customers')->where('id', $id)->first();

        return response()->json([$updated_customer, 'message' => 'Customer updated successfully']);
    }

    public function addCustomers(Request $request)
    {
        // Log request data for debugging
        Log::info('Add Customer Request:', $request->all());

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'required|email|unique:customers,email',
            'gender' => 'required|string|in:male,female,other',
            'alt_phone' => 'nullable|string|max:20',
            'point' => 'nullable|integer|min:0',
            'current_location' => 'required|string|max:255',
        ]);

        // Insert customer into the database
        $customer = DB::table('customers')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'alt_phone' => $request->alt_phone, // Nullable field
            'point' => $request->point ?? 0, // Default to 0 if not provided
            'current_location' => $request->current_location,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => (bool) $customer,
            'message' => $customer ? 'Customer added successfully' : 'Failed to add customer'
        ]);
    }
}
