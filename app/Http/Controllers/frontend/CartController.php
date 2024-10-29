<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request, $product_id)
{
    // Find the product by its ID
    $product = Product::findOrFail($product_id);

    // Check if the product is already in the cart
    $cart = Cart::where('user_id', auth()->id())
                ->where('product_id', $product_id)
                ->first();

    if ($cart) {
        // If the product already exists in the cart, increase the quantity
        $cart->quantity += 1;
    } else {
        // Add the product to the cart
        $cart = new Cart();
        $cart->user_id = auth()->id();
        $cart->product_id = $product->id;
        $cart->quantity = 1;
    }

    // Calculate the total amount for the cart item
    $cart->total = $product->selling_price * $cart->quantity;

    // Save the cart item
    $cart->save();

    return redirect()->back()->with('success', 'Product added to cart');
}


    // Update cart quantity
    public function updateCart(Request $request, $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back()->with('success', 'Cart updated');
    }

    // Remove product from cart
    public function removeFromCart($cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart->delete();

        return redirect()->back()->with('success', 'Product removed from cart');
    }

    // Display cart contents
    public function viewCart()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('frontend.cart', compact('carts'));
    }
}
