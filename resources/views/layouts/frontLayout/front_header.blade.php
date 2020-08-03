<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +977 9860558884</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> gadgetworld@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('images/frontend_images/home/logo.png')}}" style="height: 70px;"/></a>
                    </div>
                    
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            
                            <li><a href="{{url('/checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if(empty(Auth::check()))
                                <li><a href="{{url ('/login-register') }}"><i class="fa fa-lock"></i>
                                Login</a></li>
                            @else
                                <li><a href="{{url('/account') }}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/user-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="{{url('/')}}">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($mainCategories as $cat)
                                        <li><a href="{{asset ('/product/'.$cat->url) }}">{{$cat->name}}</a></li> 
                                    @endforeach
                                </ul>
                            </li> 
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                    <form method="GET" action="{{url('search')}}">
                            
                    <input type="text" name="keyword" placeholder="Search" value="{{@$_GET['keyword']}}"/>
                        <button type="submit">search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->