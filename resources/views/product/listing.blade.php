@extends('layouts.frontLayout.front_design')
@section('content')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>GADGET</span>-WORLD</h1>
                                <h2>Quality Products</h2>
                                <p></p>
                                
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/frontend_images/home/silder-1.png')}}" class="girl img-responsive" style="height: 300px;" />

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>GADGET</span>-WORLD</h1>
                                <h2>Quality Products</h2>
                                <p></p>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/frontend_images/home/slider2.png')}}" class="girl img-responsive" style="height: 300px; float:right;" />
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>GADGET</span>-WORLD</h1>
                                <h2>Quality Products</h2>
                                <p></p>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/frontend_images/home/slide.png')}}" class="girl img-responsive" style="height: 300px; float: right;" />
                            </div>
                        </div>
                        
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        
                        <div class="panel panel-default">
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
                    </div><!--/category-products-->
                
                </div>
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                <h2 class="title text-center">{{$categoryDetails->name}}</h2>
                    @foreach ($productsAll as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('uploads/products/'.$product->image)}}" height="250px" />
                                        <h2>RS{{$product->price}}</h2>
                                        <p>{{$product->product_name}} </p>
                                        <a href="{{ url('products/'.$product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="ratings">
                                        <p style="margin-left: 10px;">
                                            @php($rate = $product->ratings->avg('rating'))
                                            @for($i=1;$i<=5;$i++)
                                            @if($i<=$rate)
                                            <span class="fa fa-star"></span>
                                            @else
                                                <span class="fa fa-star-o"></span>
                                            @endif
                                            @endfor
                                        </p>
                                    </div>
                                   <!-- <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$product->price}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div> -->
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                    
                    
                </div><!--features_items-->

                
            </div>
        </div>
    </div>
</section>
@endsection