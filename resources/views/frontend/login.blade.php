@extends('frontend.layout');
@section('content')

<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="login-form">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST" action="{{ route('login.perform') }}">
                                @csrf
                                @method('post')
                            <label>E-mail / Username</label>
                            <input class="form-control" type="text" placeholder="E-mail / Username" name="email">
                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input class="form-control" type="text" placeholder="Password" name="password">
                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn">Submit</button>
                        </div>
                    </form>
                    </div>
                    <a href="{{url('/user-register')}}">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection
