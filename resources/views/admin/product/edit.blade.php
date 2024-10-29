@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Product'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="cate_id">Category</label>
                                <select class="form-control" id="cate_id" name="cate_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->cate_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="small_description">Small Description</label>
                                <input type="text" class="form-control" id="small_description" name="small_description" value="{{ $product->small_description }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="original_price">Original Price</label>
                                <input type="number" step="0.01" class="form-control" id="original_price" name="original_price" value="{{ $product->original_price }}" required>
                            </div>

                            <div class="form-group">
                                <label for="selling_price">Selling Price</label>
                                <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($product->image)
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Product Image" width="100">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tax">Tax (%)</label>
                                <input type="number" step="0.01" class="form-control" id="tax" name="tax" value="{{ $product->tax }}">
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="trending">Trending</label>
                                <select class="form-control" id="trending" name="trending">
                                    <option value="1" {{ $product->trending ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$product->trending ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $product->meta_title }}">
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $product->meta_keywords }}">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description">{{ $product->meta_description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
