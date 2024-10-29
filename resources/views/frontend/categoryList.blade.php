@extends('frontend.layout')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item">{{$catageries->name}}</li>
            <li class="breadcrumb-item active">Product List</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <!-- Product List -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Product Filters -->


                    <!-- Product Items -->
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="{{ url('product-detail/' . Str::slug($product->product_name))  }}">{{ $product->product_name }}</a>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="{{ url('product-detail/' . Str::slug($product->product_name)) }}">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->product_name}}" height="140px">
                                </a>
                                <div class="product-action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="#"><i class="fa fa-heart"></i></a>

                                </div>
                            </div>
                            <div class="product-price">
                                <h6><strike>${{ $product->original_price }}</strike>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>$</span>{{ $product->selling_price }}</h6>
                                <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <div class="sidebar-widget category">
                    <h2 class="title">Categories</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            @foreach ($allCats as $c)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('category/'.$c->slug) }}">
                                    <i class="fa fa-tag"></i>{{ $c->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <!-- Brand Section -->

            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Product List End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-1.png') }}" alt="Brand 1"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-2.png') }}" alt="Brand 2"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-3.png') }}" alt="Brand 3"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-4.png') }}" alt="Brand 1"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-5.png') }}" alt="Brand 2"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-6.png') }}" alt="Brand 3"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-1.png') }}" alt="Brand 1"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-2.png') }}" alt="Brand 2"></div>
            <div class="brand-item"><img src="{{ asset('frontend/img/brand-3.png') }}" alt="Brand 3"></div>
        </div>
    </div>
</div>
<!-- Brand End -->
@endsection
