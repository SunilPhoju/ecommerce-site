<?php
use App\Http\Controllers\Controller;
$categories = Controller::mainCategories();
?>
<footer id="footer"><!--Footer-->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>Gadget</span>-World</h2>
                        <p>You can get Quality produts with suitable price.</p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{url('/cart')}}">Home Delivery</a></li>
                            <li><a href="{{url('/')}}">Quality Products</a></li>
                            <li><a href="{{url('/cart')}}">Order Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2" style="float: right;">
                    <div class="single-widget" >
                        <h2>Quick Shop</h2>
                        @foreach ($categories as $cat)
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            {{$cat->name}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$cat->id}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach ($cat->categories as $subcat)
                                                <li><a href="{{asset ('/product/'.$subcat->url) }}"> {{$subcat->name}} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                
               
                
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2020 Gadget world. All rights reserved.</p>
            </div>
        </div>
    </div>
    
</footer><!--/Footer-->