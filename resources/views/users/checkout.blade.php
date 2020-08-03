@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top:0px;"><!--form-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li class="active">Checkout</li>
            </ol>
        </div>
        <form action="{{url('/checkout') }}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    @if (session('err'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('err') }}
                        </div>
                    @endif
                    <div class="login-form">
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input type="text" name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}"@endif placeholder="Billing Name" class="form-control"   />
                            <input type="text" name="billing_address" id="billing_address" placeholder="Billing Address" class="form-control" style="margin-top:10px;" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif/>
                            <input type="text" name="billing_city" id="billing_city"placeholder="Billing City" class="form-control" style="margin-top:10px;"  @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif/>
                            <input type="text" name="billing_state" id="billing_state"placeholder="Billing State" class="form-control" style="margin-top:10px;"  @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif/>
                            <select name="billing_country" id="billing_country" style="margin-top:10px;" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_name}}" @if(!empty($userDetails->country) && $country->country_name
                                        == $userDetails->country) selected @endif>
                                        {{ $country->country_name}}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="billing_pincode" id="billing_pincode"placeholder="Billing Pincode" class="form-control" style="margin-top:10px;"  @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif/>
                            <input type="text" name="billing_mobile" id="billing_mobile"placeholder="Billing Mobile" class="form-control" style="margin-top:10px;" @if(!empty($userDetails->phone)) value="{{$userDetails->phone}}" @endif/>
                            <div class="form-check" style="margin-top:10px;">
                                <input value="{{$userDetails->name }}" type="checkbox" class="form-check-input" id="billtoship">
                                <label class="form-check-label" for="billtoship">Shipping Address same as Billing address</label>
                            </div>
                        </div>
                            
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                        <input type="text" name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}"@endif placeholder="Shipping Name" class="form-control" />
                            <input type="text" name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}"@endif placeholder="Shipping Address" class="form-control" style="margin-top:10px;"/>
                            <input type="text" name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif placeholder="Shipping City" class="form-control" style="margin-top:10px;"/>
                            <input type="text" name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif placeholder="Shipping State" class="form-control" style="margin-top:10px;"/>
                            <select name="shipping_country" id="shipping_country" style="margin-top:10px;" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_name}}" @if(!empty($shippingDetails->country) && $country->country_name
                                        == $shippingDetails->country) selected @endif>
                                        {{ $country->country_name}}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif placeholder="Shipping Pincode" class="form-control" style="margin-top:10px;"/>
                            <input type="text" name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->phone)) value="{{$shippingDetails->phone}}" @endif placeholder="Shipping Mobile" class="form-control" style="margin-top:10px;"/>
                            <button type="submit" class="btn btn-success"class="form-control" style="margin-top:10px;">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section><!--/form-->


@endsection