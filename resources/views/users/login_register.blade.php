@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:0px;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                @if (session('err'))
                    <div class="alert alert-success" role="alert">
                        {{ session('err') }}
                    </div>
                @endif
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form id="loginform" action="{{url('/user-login') }}" method="POST">
                        {{csrf_field()}}
                        <input name="email" type="email" placeholder="Email Address" required title="Provide you email"/>
                        <input name="password" type="password" placeholder="Password" required  title="Put your password"/>
                       <!-- <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span> -->
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form id= "registerForm" name="registerForm" action="{{url('/user-register') }}" method="POST">
                        {{csrf_field() }}
                        <input id="name" name="name" type="text" placeholder="Name" required minlength="5" pattern="[A-Za-z]+" title="Enter only alphabetical word"/>
                        <input id="email" name="email" type="email" placeholder="Email Address" required/>
                        <input id="phone" name="phone" type="text"  placeholder="Phone" class="form-control" required>
                        <input id="password" name="password" type="password" placeholder="Password" pattern=".{8,}" title="Eight or more characters"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection