@extends('frontend.layout');
@section('content')

<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="register-form">

                        <form method="POST" action="{{ route('register.perform') }}">
                            @csrf
                            <div class="row">
                        <div class="col-md-12">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="username" name="username" value="{{ old('username') }}">
                            @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12">
                            <label>Email</label>
                            <input class="form-control" type="text" placeholder="email" name="email" value="{{ old('email') }}">
                            @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Password</label>
                            <input class="form-control" type="password" placeholder="Password" name="password">
                            @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                            Conditions</a>
                                    </label>
                                    @error('terms') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn">Submit</button>
                        </div>
                    </form>
                    </div>
                <a href="{{url('user-login')}}">Login</a>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection
