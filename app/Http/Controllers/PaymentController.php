<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    // Display the main report page
    public function index()
    {
        $module = "reports";
        // Fetch payments with related user, ordered by the created_at date
        $reports = Payment::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.report.report', compact('reports', 'module'));
    }

    // Fetch payment reports for AJAX requests
    public function getReports(Request $request)
    {
        $reports = Payment::with('user')
            ->select('id', 'user_id', 'amount', 'payment_method', 'status', 'paid_at', 'created_at', 'updated_at')
            ->paginate(10);

        return response()->json([
            'data' => $reports->items(),
            'pagination' => [
                'current_page' => $reports->currentPage(),
                'last_page' => $reports->lastPage(),
                'total' => $reports->total()
            ]
        ]);
    }

    // Add a new payment report
    public function addReport(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'paid_at' => 'nullable|date'
        ]);

        // Create a new payment record
        Payment::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'paid_at' => $request->paid_at, // Paid date can be nullable
        ]);

        return response()->json(['success' => true]);
    }

    // Edit an existing payment report
    public function editReport(Request $request)
    {
        // Find the payment by ID
        $payment = Payment::findOrFail($request->id);

        // Update the payment details
        $payment->update([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'paid_at' => $request->paid_at, // Ensure the `paid_at` field is also updated
        ]);

        return response()->json(['success' => true]);
    }

    // Delete a payment report
    public function deleteReport(Request $request)
    {
        // Find and delete the payment record
        Payment::findOrFail($request->id)->delete();

        return response()->json(['success' => true]);
    }
}
