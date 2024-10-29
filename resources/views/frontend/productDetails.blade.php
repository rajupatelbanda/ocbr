@extends('frontend.layout')
@section('content')

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <!-- Product Images Section -->
            <div class="col-lg-12">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <!-- Product Image Slider -->
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image">
                            </div>
                            <div class="product-slider-single-nav normal-slider">
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                                <div class="slider-nav-img"><img src="{{ asset('images/products/'.$product->image) }}" alt="Product Image"></div>
                            </div>
                        </div>

                        <!-- Product Info Section -->
                        <div class="col-md-7">
                            <div class="product-content">
                                <!-- Product Title -->
                                <div class="title">

                                    <h2>{{ $product->product_name }} </h2>
                                </div>

                                <!-- Product Rating -->
                                {{-- <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div> --}}

                                <!-- Product Price -->
                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>${{ $product->selling_price }} <span>${{ $product->original_price }}</span></p>
                                </div>

                                <!-- Quantity Selector -->
                                <div class="quantity">
                                    <h4>Quantity:</h4>
                                    <div class="qty">
                                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1">
                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                                <!-- Product Size Options -->


                                <!-- Product Color Options -->


                                <!-- Action Buttons -->
                                <div class="action">
                                    
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                    </form>
                                    {{-- <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a> --}}
                                </div>

                            </div>
                            <strong>Small Description:</strong>
                            <p>{{$product->small_description}}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Description, Specification, and Reviews Tabs -->
                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#specification">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Description Tab -->
                            <div id="description" class="container tab-pane active">
                                {{-- <h4>Product description</h4> --}}
                                <p>
                                    {{$product->description}}
                                </p>
                            </div>

                            <!-- Specification Tab -->
                            <div id="specification" class="container tab-pane fade">
                                <h4>Product specification</h4>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Lorem ipsum dolor sit amet</li>
                                </ul>
                            </div>

                            <!-- Reviews Tab -->
                            <div id="reviews" class="container tab-pane fade">
                                <div class="reviews-submitted">
                                    <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
                                    </p>
                                </div>

                                <!-- Submit a Review -->
                                <div class="reviews-submit">
                                    <h4>Give your Review:</h4>
                                    <div class="ratting">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <div class="row form">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" placeholder="Email">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea placeholder="Review"></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <button>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Products Section -->
                {{-- <div class="product">
                    <div class="section-header">
                        <h1>Related Products</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">
                        <!-- Product Item Template -->
                        @foreach($relatedProducts as $relatedProduct)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="{{ url('product-detail/' . $relatedProduct->id) }}">{{ $relatedProduct->product_name }}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="{{ url('product-detail/' . $relatedProduct->id) }}">
                                        <img src="{{ asset('img/' . $relatedProduct->image) }}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>{{ $relatedProduct->price }}</h3>
                                    <a class="btn" href="{{ url('product-detail/' . $relatedProduct->id) }}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
<!-- Product Detail End -->

@endsection
