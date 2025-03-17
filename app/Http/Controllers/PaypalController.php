<?php

namespace App\Http\Controllers;

use App\Models\Payment; // Use the Payment model instead of Report
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalController extends Controller
{
    private $client;

    public function __construct()
    {
        $clientId = 'AfyevkOJC7ssBshzLuD_uOPE7ntONyzmXnq0KU4ThJ0XhakWhmnzWXTq2cvfCiRxTQuW3shLW03doI6H';
        $clientSecret = 'ECMoPioSOLnmroEmsyf_WRfXI2SK9w-A_aqLJCT9_CwyOWNw0LE93uRph5ArJMGqMfv7BPvJljde3GrM';
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $this->client = new PayPalHttpClient($environment);
    }

    // Create PayPal Order
    public function createOrder(Request $request)
    {
        $order = new OrdersCreateRequest();
        $order->prefer('return=representation');
        $order->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $request->amount
                ]
            ]],
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ]
        ];

        try {
            $response = $this->client->execute($order);
            return response()->json([
                'approval_url' => collect($response->result->links)->firstWhere('rel', 'approve')->href
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Capture Payment after user returns from PayPal
    public function success(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return view('paypal.success', ['message' => 'Order ID missing in request.']);
        }

        $captureRequest = new OrdersCaptureRequest($token);
        $captureRequest->prefer('return=representation');

        try {
            $response = $this->client->execute($captureRequest);

            if ($response->result->status === 'COMPLETED') {
                // Save the payment details in the Payment table
                Payment::create([
                    'user_id' => 1, // You can dynamically get this from the user (if logged in)
                    'amount' => $response->result->purchase_units[0]->payments->captures[0]->amount->value,
                    'payment_method' => 'PayPal',
                    'status' => 'completed',
                    'paid_at' => now(), // Set the paid_at timestamp
                ]);

                return view('paypal.success', [
                    'message' => 'Payment captured successfully.',
                    'details' => $response->result
                ]);
            } else {
                return view('paypal.success', [
                    'message' => 'Payment was not completed.',
                    'details' => $response->result
                ]);
            }
        } catch (\Exception $e) {
            return view('paypal.success', [
                'message' => 'Payment failed: ' . $e->getMessage()
            ]);
        }
    }

    // Cancel Payment screen
    public function cancel(Request $request)
    {
        return view('paypal.cancel', [
            'message' => 'You cancelled the payment.'
        ]);
    }
}
