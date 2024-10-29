@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Category Details'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Category: {{ $category->name }}</h4>
                        <p>Slug: {{ $category->slug }}</p>
                        <p>Status: {{ $category->status ? 'Active' : 'Inactive' }}</p>
                        <p>Description: {{ $category->description }}</p>
                        <p>Meta Title: {{ $category->meta_title }}</p>
                        <p>Meta Description: {{ $category->meta_description }}</p>
                        <p>Meta Keywords: {{ $category->meta_keywords }}</p>
                        <img src="{{ asset('images/categories/' . $category->category_image) }}" width="150px" alt="Category Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
