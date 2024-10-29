<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;  // Corrected import statement
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    private $provider;

    public function __construct()
    {
        // Initialize PayPal client
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
    }

    /**
     * Process the payment with PayPal.
     */
    public function processPayment($orderId)
    {
        $order = Order::findOrFail($orderId);

        // PayPal order data
        $paypalOrder = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $order->order_total,
                    ],
                    'description' => "Order #{$order->id}",
                ],
            ],
            'application_context' => [
                'cancel_url' => route('paypal.cancel', $order->id),
                'return_url' => route('paypal.success', $order->id),
            ],
        ];

        // Create the order in PayPal
        $response = $this->provider->createOrder($paypalOrder);

        // Log the response for debugging
        Log::info('PayPal Create Order Response: ', $response);

        if (isset($response['id'])) {
            // Redirect to PayPal for approval
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('order.failed')->with('error', 'Error in creating PayPal order. Please try again.');
    }

    /**
     * Handle PayPal success response.
     */
    public function successPayment(Request $request, $orderId)
    {
        if (!$request->has('token') || !$request->has('PayerID')) {
            Log::error('Payment failed. Missing token or PayerID.');
            return redirect()->route('order.failed')->with('error', 'Payment failed. Please try again.');
        }

        $order = Order::findOrFail($orderId);

        // Capture the order
        $response = $this->provider->capturePaymentOrder($request->token);

        // Log the response for debugging
        Log::info('PayPal Capture Payment Response: ', $response);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $order->update([
                'payment_status' => 'Paid',
                'payment_method' => 'PayPal',
            ]);

            return redirect()->route('order.success')->with('success', 'Payment successful and order placed!');
        }

        return redirect()->route('order.failed')->with('error', 'Payment failed. Please try again.');
    }

    /**
     * Handle PayPal cancellation.
     */
    public function cancelPayment($orderId)
    {
        return redirect()->route('order.failed')->with('error', 'Payment was cancelled.');
    }
}
