@extends('frontend.layout')

@section('content')


    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('all-products-list') }}">Products</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    @if($carts->count())
    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @php
                                        $subTotal = 0;
                                    @endphp

                                    @foreach($carts as $cart)
                                        @php
                                            // Calculate total for each product
                                            $total = $cart->product->selling_price * $cart->quantity;
                                            // Accumulate subTotal
                                            $subTotal += $total;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="{{ asset('images/products/'.$cart->product->image) }}" alt="Image"></a>
                                                    <p>{{ $cart->product->product_name }}</p>
                                                </div>
                                            </td>
                                            <td>${{ $cart->product->selling_price }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                                                    <button type="submit">Update</button>
                                                </form>
                                            </td>
                                            <td>${{ $total }}</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $cart->id) }}">
                                                    <button><i class="fa fa-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Cart Summary</h1>
                                        <p>Sub Total <span>${{ $subTotal }}</span></p>
                                        <p>Shipping Cost <span>$10</span></p> <!-- Set shipping cost if applicable -->
                                        @php
                                            $shippingCost = 10; // Example shipping cost
                                            $grandTotal = $subTotal + $shippingCost;
                                        @endphp
                                        <h2>Grand Total <span>${{ $grandTotal }}</span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <a href="{{url('/checkout')}}"><button>Checkout</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Cart End -->
    @else
        <p>Your cart is empty</p>
    @endif
@endsection
