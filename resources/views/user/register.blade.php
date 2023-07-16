<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User Register</title>
        @include('./include/header-css-js')
        
    </head>
    <body >
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row px-3 justify-content-center mt-5 mb-5 border-line">
                                <img src="{{ url('/images/register.svg') }}" class="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="row mb-4 px-3">
                                <h6 class="mb-0 mr-4 mt-2">Sign in with</h6>
                                <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
                                <div class="google text-center mr-3"><div class="fa fa-google"></div></div>
                                
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="line"></div>
                                <small class="or text-center">Or</small>
                                <div class="line"></div>
                            </div>
                            <form action="{{route('user-register')}}" method="POST">

@if(session()->has('success_'))
<div class="alert alert-success show" role="alert"  id="success_" >
    {{ session()->get('success_') }}
    <button type="button" class="btn" style="margin-top: -16px; float: right; font-size: x-large;position: absolute;" data-dismiss="alert" aria-label="Close" onclick="{$('#failed_').fadeOut('slow');}">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif 

@if(session()->has('failed_'))
<div class="alert alert-danger show" role="alert"  id="failed_" >
    {{ session()->get('failed_') }}
    <button type="button" class="btn" style="margin-top: -16px; float: right; font-size: x-large;position: absolute;" data-dismiss="alert" aria-label="Close" onclick="{$('#failed_').fadeOut('slow');}">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

                                @csrf
                                <div class="row px-3">
                                    <label class="mt-3 mb-1"><h6 class="mb-0 text-sm">Full Name</h6></label>
                                    <input class="mb-1" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Full Name">
                                    <label class="text-danger">@error('name') {{$message}} @enderror</label>
                                </div>
                                <div class="row px-3">
                                    <label class="mt-3 mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                                    <input class="mb-1" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter a valid email address">
                                    <label class="text-danger">@error('email') {{$message}} @enderror</label>
                                </div>
                                <div class="row px-3">
                                    <label class="mt-3 mb-1"><h6 class="mb-0 text-sm">Phone Number</h6></label>
                                    <input class="mb-1" type="number" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter phone number" onkeypress="return isNumberKey(event)">
                                    <label class="text-danger">@error('phone') {{$message}} @enderror</label>
                                </div>
                                <div class="row px-3">
                                    <label class="mt-3 mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                                    <input type="password" name="password" id="password" placeholder="Enter password" value="{{ old('password') }}">
                                    <label class="text-danger">@error('password') {{$message}} @enderror</label>
                                </div>
                               
                                <div class="row mb-3 px-3 mt-3">
                                    <button type="submit" id="register-btn" class="btn btn-blue text-center">Submit</button>
                                </div>
                            </form>
                            <div class="row mb-4 px-3">
                                <small class="font-weight-bold">Already have an account? <a href="{{ route('login') }}" class="text-danger ">Login</a></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue py-4">
                    <div class="row px-3">
                        <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                        <div class="social-contact ml-4 ml-sm-auto">
                            <span class="fa fa-facebook mr-4 text-sm"></span>
                            <span class="fa fa-google-plus mr-4 text-sm"></span>
                            <span class="fa fa-linkedin mr-4 text-sm"></span>
                            <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('./include/footer-css-js')
    </body>
</html>
