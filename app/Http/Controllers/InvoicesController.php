<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    // Show Invoice Page
    public function index(Request $request)
    {
        $module = 'invoices';
        $invoices = Invoice::with(['customer', 'user'])->paginate(10);
        return view('admin.invoices.invoice-form', compact('module', 'invoices'));
    }

    // Fetch invoices (for Vue.js)
    public function fetchInvoices()
    {
        $invoices = DB::table('invoices')
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->select(
                'invoices.*', 
                'users.username as user_name', // Fix user name
                'customers.name as customer_name' // Fix customer name
            )
            ->get();

        $customers = DB::table('customers')->select('id', 'name')->get();
        $users = DB::table('users')->select('id', 'username')->get();

        return response()->json([
            'invoices' => $invoices,
            'customers' => $customers,
            'users' => $users
        ]);
    }



    // Add a new invoice
    public function addInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'grand_total' => 'required|numeric|min:0',
            'delivery_id' => 'nullable|string',
            'pick_up_date_time' => 'required|date',
            'status' => 'required|in:on_hold,processing,completed'
        ]);

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
            'grand_total' => $request->grand_total,
            'delivery_id' => $request->delivery_id,
            'pick_up_date_time' => $request->pick_up_date_time,
            'status' => $request->status
        ]);

        return response()->json([
            'invoice' => $invoice,
            'message' => 'Invoice added successfully!'
        ]);
    }

    // Edit an existing invoice
    public function editInvoice(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoices,id',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'grand_total' => 'required|numeric|min:0',
            'delivery_id' => 'nullable|string',
            'pick_up_date_time' => 'required|date',
            'status' => 'required|in:on_hold,processing,completed'
        ]);

        $invoice = Invoice::findOrFail($request->id);
        $invoice->update([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
            'grand_total' => $request->grand_total,
            'delivery_id' => $request->delivery_id,
            'pick_up_date_time' => $request->pick_up_date_time,
            'status' => $request->status
        ]);

        return response()->json([
            'invoice' => $invoice,
            'message' => 'Invoice updated successfully!'
        ]);
    }

    // Delete an invoice
    public function deleteInvoice(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:invoices,id'
        ]);

        Invoice::where('id', $request->id)->delete();

        return response()->json([
            'message' => 'Invoice deleted successfully!'
        ]);
    }
}
