@extends('frontend.layout')

@section('content')
    <h1>Your Cart</h1>

    @if($carts->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{ $cart->product->product_name }}</td>
                        <td>${{ $cart->product->selling_price }}</td>
                        <td>
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>${{ $cart->product->selling_price * $cart->quantity }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $cart->id) }}">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total: ${{ $carts->sum(fn($cart) => $cart->product->price * $cart->quantity) }}</p>
        <a href="#" class="btn btn-primary">Checkout</a>
    @else
        <p>Your cart is empty</p>
    @endif
@endsection
