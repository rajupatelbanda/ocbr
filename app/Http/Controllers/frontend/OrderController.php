<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display the checkout page with the cart items.
     */
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to access checkout.');
        }

        // Fetch cart items for the authenticated user
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        // Pass cart items to the checkout view
        return view('frontend.checkout', compact('carts'));
    }

    /**
     * Process the checkout and create an order.
     */
    public function checkout(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:15',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',
            'billing_zipcode' => 'required|string|max:10',
            'payment_method' => 'required|string',  // COD, PayPal, Razorpay, etc.
        ]);

        // Check if the cart is empty
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate the total cart amount
        $cartTotal = 0;
        foreach ($carts as $cart) {
            $cartTotal += $cart->product->selling_price * $cart->quantity;
        }

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->billing_first_name = $request->billing_first_name;
        $order->billing_last_name = $request->billing_last_name;
        $order->billing_email = $request->billing_email;
        $order->billing_phone = $request->billing_phone;
        $order->billing_address = $request->billing_address;
        $order->billing_city = $request->billing_city;
        $order->billing_state = $request->billing_state;
        $order->billing_country = $request->billing_country;
        $order->billing_zipcode = $request->billing_zipcode;

        // If shipping is different from billing
        if ($request->has('shipto')) {
            $order->shipping_first_name = $request->shipping_first_name;
            $order->shipping_last_name = $request->shipping_last_name;
            $order->shipping_email = $request->shipping_email;
            $order->shipping_phone = $request->shipping_phone;
            $order->shipping_address = $request->shipping_address;
            $order->shipping_city = $request->shipping_city;
            $order->shipping_state = $request->shipping_state;
            $order->shipping_country = $request->shipping_country;
            $order->shipping_zipcode = $request->shipping_zipcode;
        }

        // Set payment method and total
        $order->payment_method = $request->payment_method;
        $order->order_total = $cartTotal;

        // Save the order to the database
        $order->save();

        // Handle payment methods
        if ($request->payment_method == 'paypal') {
            // Redirect to PayPal payment process
            return redirect()->route('paypal.payment', $order->id);
        } elseif ($request->payment_method == 'razorpay') {
            // Redirect to Razorpay payment process
            return redirect()->route('razorpay.payment', $order->id);
        } else {
            // COD or other methods
            $this->completeOrder($order);
            return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
        }
    }

    /**
     * Complete the order for non-online payment methods.
     */
    private function completeOrder($order)
    {
        // Clear the user's cart
        Cart::where('user_id', Auth::id())->delete();

        // Any additional order completion logic can go here
    }

    /**
     * Display the order success page.
     */
    public function orderSuccess()
    {
        return view('order.success')->with('success', 'Your order has been placed successfully!');
    }

    public function orderFailed()
    {
        return view('order.failed')->with('error', 'Payment failed. Please try again.');
    }














    public function success()
    {
        return view('frontend.success');
    }
    public function userLogin()
    {
        return view('frontend.login');
    }
    public function userRegister()
    {
        return view('frontend.register');
    }
}
