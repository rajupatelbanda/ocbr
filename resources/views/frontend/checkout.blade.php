@extends('frontend.layout')

@section('content')

<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('all-products-list') }}">Products</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="checkout-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-inner">
                    <h1>Billing Information</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form to handle checkout -->
                    <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="form-group">
                            <label for="billing_first_name">First Name</label>
                            <input type="text" name="billing_first_name" class="form-control" required value="{{ auth()->user()->username }}">
                        </div>

                        <div class="form-group">
                            <label for="billing_last_name">Last Name</label>
                            <input type="text" name="billing_last_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_email">Email</label>
                            <input type="email" name="billing_email" class="form-control" required value="{{ auth()->user()->email }}">
                        </div>

                        <div class="form-group">
                            <label for="billing_phone">Phone</label>
                            <input type="text" name="billing_phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_address">Address</label>
                            <input type="text" name="billing_address" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_city">City</label>
                            <input type="text" name="billing_city" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_state">State</label>
                            <input type="text" name="billing_state" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_country">Country</label>
                            <input type="text" name="billing_country" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_zipcode">Zip Code</label>
                            <input type="text" name="billing_zipcode" class="form-control" required>
                        </div>

                        <!-- Payment Method Section -->
                        <div class="form-group">
                            <h2>Payment Method</h2>
                            <div class="payment-methods">
                                <div>
                                    <input type="radio" id="cod" name="payment_method" value="cod" required>
                                    <label for="cod">Cash on Delivery</label>
                                </div>
                                <div>
                                    <input type="radio" id="paypal" name="payment_method" value="paypal" required>
                                    <label for="paypal">PayPal</label>
                                </div>
                                <div>
                                    <input type="radio" id="razorpay" name="payment_method" value="razorpay" required>
                                    <label for="razorpay">Razorpay</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>Cart Total</h1>
                        @php
                            $subTotal = 0; // Initialize subtotal
                            foreach ($carts as $cart) {
                                $subTotal += $cart->product->selling_price * $cart->quantity; // Calculate subtotal
                            }
                            $shippingCost = 0; // Set a fixed shipping cost (can be dynamic)
                            $grandTotal = $subTotal + $shippingCost; // Calculate grand total
                        @endphp

                        @foreach($carts as $cart)
                            <p>{{ $cart->product->product_name }} <span>${{ $cart->product->selling_price }} x {{ $cart->quantity }}</span></p>
                        @endforeach

                        <p class="sub-total">Sub Total <span>${{ number_format($subTotal, 2) }}</span></p>
                        <p class="ship-cost">Shipping Cost <span>${{ number_format($shippingCost, 2) }}</span></p>
                        <h2>Grand Total <span>${{ number_format($grandTotal, 2) }}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
