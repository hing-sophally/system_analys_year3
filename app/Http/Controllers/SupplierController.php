<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $module = 'suppliers';
        $suppliers = Suppliers::paginate(10) ;// Fetch 10 suppliers per page
        return view('admin.suppliers.suppliers', compact('module', 'suppliers'));
    }

    public function fetchsuppliers()
    {
        // Fetch all suppliers from the database
        $data = DB::table('suppliers')->select('*')->get();

        return response()->json($data);
    }

    public function deletesuppliers(Request $request)
    {
        // Retrieve the customer id from the request
        $customer_id = $request->id;

        // Delete the customer record from the database
        $res = DB::table('suppliers')->where('id', $customer_id)->delete();

        return response()->json(['res' => $res, 'message' => 'Customer deleted successfully']);
    }

    public function editsuppliers(Request $request)
    {
        // Retrieve the id and all necessary fields from the request
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $gender = $request->gender;
        $alt_phone = $request->alt_phone;
        $current_location = $request->current_location;

        // Update the customer record in the database
        $customer = DB::table('suppliers')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'gender' => $gender,
                'alt_phone' => $alt_phone,
                'current_location' => $current_location,
                'updated_at' => now()
            ]);

        // Fetch the updated customer record
        $updated_customer = DB::table('suppliers')->where('id', $id)->first();

        return response()->json([$updated_customer, 'message' => 'Customer updated successfully']);
    }

    public function addsuppliers(Request $request)
    {
        // Log request data for debugging
        Log::info('Add Customer Request:', $request->all());

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:suppliers,phone',
            'email' => 'required|email|unique:suppliers,email',
            'gender' => 'required|string|in:male,female,other',
            'alt_phone' => 'nullable|string|max:20',
            'current_location' => 'required|string|max:255',
        ]);

        // Insert customer into the database
        $customer = DB::table('suppliers')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'alt_phone' => $request->alt_phone, // Nullable field
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
