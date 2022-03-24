@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-md-center">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="Name" name="name" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <span class="text-danger" for="name">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email" value="{{old('email')}}">
                                    @error('email')
                                                <span class="text-danger" for="email">{{ $message }}</span>
                                            @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password" >
                                        @error('password')
                                                <span class="text-danger" for="password">{{ $message }}</span>
                                            @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                                        @error('password_confirmation')
                                                <span class="text-danger" for="password_confirmation">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-user btn-block" type="submit">Register Account</button>

                            <hr>

                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
