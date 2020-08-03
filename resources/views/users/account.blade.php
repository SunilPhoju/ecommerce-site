@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:0px;"><!--form-->
    <div class="container">
        <div class="row">
            @if (session('succ'))
                <div class="alert alert-success" role="alert">
                    {{ session('succ') }}
                </div>
            @endif
            @if (session('err'))
                <div class="alert alert-danger" role="alert">
                    {{ session('err') }}
                </div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Update account</h2>
                    <form id= "accountForm" name="accountForm" action="{{url('/account') }}" method="POST">
                        {{csrf_field() }}
                    <input id="name" name="name" value="{{$userDetails->name}}" type="text" placeholder="Name" minlength="5" title="Enter only alphabetical word"/>
                        <input id="address" name="address" value="{{$userDetails->address}}" type="text" placeholder="Address" title="Please enter you address"/>
                        <input id="city" name="city" value="{{$userDetails->city}}" type="text"  placeholder="City" class="form-control" title="Please enter you City"/>
                        <input id="state" name="state" value="{{$userDetails->state}}" type="text" placeholder="State" title="Please enter you state" />
                        <select name="country" id="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_name}}" @if($country->country_name
                                    == $userDetails->country) selected @endif>
                                    {{ $country->country_name}}
                                </option>
                            @endforeach
                        </select>
                        <input style="margin-top:10px;" id="pincode" name="pincode" value="{{$userDetails->pincode}}" type="text"  placeholder="Pincode" title="Please enter you Pincode">
                    <input value="{{$userDetails->phone}}" id="phone" name="phone" type="text"  placeholder="Mobile number" title="Please enter you Phone number">

                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Update Password</h2>
                <form id="passwordForm" name="passwordForm" action="{{url('/update-user-pwd')}}" method="post">
                    {{ @csrf_field()}}
                    <input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password">
                    <span id="chkPwd"></span>
                    <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password" pattern=".{8,}" required title="Eight or more characters">
                    <button type="submit" class="btn btn-default">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection