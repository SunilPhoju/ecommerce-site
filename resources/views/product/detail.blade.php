@extends('layouts.frontLayout.front_design')
@section('content')

<section>
    <div class="container">
        @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
        @endif
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
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                <a href="{{asset('uploads/products/'.$productDetails->image)}}">
                                    <img style="width:100% " class="mainImage" src="{{asset('uploads/products/'.$productDetails->image)}}"/>
                                </a>
                            </div>
                        </div>
                        <div id="similar-product" class="carousel slide thumbnails" data-ride="carousel">
                            
                              <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active thumbnails">
                                        <a href="{{asset('uploads/products/'.$productDetails->image)}}" data-standard="{{asset('uploads/products/'.$productDetails->image)}}">
                                            <img style="width:80px;" class="changeImage" src="{{asset('uploads/products/'.$productDetails->image)}}"/>
                                        </a>
                                        @foreach ($productAltImages as $altimage)
        		                            <a href="{{asset('uploads/alternativeimages/'.$altimage->image)}}" data-standard="{{asset('uploads/alternativeimages/'.$altimage->image)}}">
                                                <img class="changeImage" style="width:50px; height:70px" src="{{asset('uploads/alternativeimages/'.$altimage->image)}}" />
        		                            </a>
                                        @endforeach
                                    </div>
                                </div>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <form name="addtocartForm" id="addtocartFrom" action="{{url('add-cart')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                            <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
                            <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
                            <input type="hidden" name="price" id="price" value="{{$productDetails->price}}">

                            <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2> {{$productDetails->product_name}} </h2>
                                <p>Code: {{$productDetails->product_code}} </p>
                                <p>
                                    <select id="selColor" name="color" style="width:150px">
                                        <option value="">Select color</option>
                                        @foreach ($productDetails->attributes as $color)
                                            <option value="{{$productDetails->id}}-{{$color->color}}">{{$color->color}}</option>
                                        @endforeach
                                    </select> 
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
                                <span id="getPrice">NRS.{{$productDetails->price}}</span>
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" value="1" />
                                    @if($total_stock>0)
                                        <button type="submit" class="btn btn-fefault cart" id = "cardButton">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button> 
                                    @endif
                                </span>
                                <p><b>Availability:</b> <span id="Availability">
                                    @if($total_stock>0) In Stock @else Out of Stock 
                                    @endif
                                </span>
                                </p>
                                <p><b>Condition:</b> New</p>
                            
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </form>
                    </div>
                </div><!--/product-details-->
                
                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                           
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{count($productDetails->ratings)}})</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <!--<div class="tab-pane fade" id="details" >
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    -->
                       
                        
                        
                        
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                               
                                @if($productDetails->ratings)
                                @foreach($productDetails->ratings as $rating)
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>{{$rating->user->name}}</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>{{date('h:i A', strtotime($rating->created_at))}}</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>{{date('Y-m-d', strtotime($rating->created_at))}}</a></li>
                                </ul>
                            <p>{{$rating->description}}</p>
                                @endforeach
                                @endif
                                <p style="color: blue;"><b>Please login to write the review</b></p>
                                @if(\Auth::check())
                                <form action="{{url ('review', $productDetails->id) }}" method="POST" >
                                    {{csrf_field()}}
                                    <span>
                                        <input type="text" name="title" placeholder="Your Name"/>
                                        <input type="email" name="email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="comment" ></textarea>

                                    <div class="star-rating">
                                        <fieldset>
                                          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Outstanding">5 stars</label>
                                          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Very Good">4 stars</label>
                                          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Good">3 stars</label>
                                          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Poor">2 stars</label>
                                          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Very Poor">1 star</label>
                                        </fieldset>
                                    </div>
                                      
                                    <div class="">
            
                                        <button type="submit" class="btn btn-default pull-right">
                                            Submit
                                        </button>
                                    </div>
                                    
                                </form>
                                @endif
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div><!--/category-tab-->
                
                <!--<div class="recommended_items">recommended_items-->
                 <!--   <h2 class="title text-center">recommended items</h2>
                    
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">	
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">	
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                          </a>
                          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                          </a>			
                    </div>
             </div>/recommended_items-->
            
                
            </div>
        </div>
    </div>
</section>
@if(Auth::check())
<section>
    <div class="container">
@php($productsAll=\App\Models\Products::addSelect(['rating_sum' => \App\Models\Rating::selectRaw('sum(rating) as total')
->whereColumn('product_id', 'products.id')
->groupBy('product_id')
])->has('ratings')->where('category_id',$productDetails->category_id)->limit(4)->get()->sortByDesc('rating_sum'))
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Recommended Products</h2>
            @foreach ($productsAll as $product)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('uploads/products/'.$product->image)}}" height="225px" />
                                <h2>$ {{$product->price}}</h2>
                                <p>{{$product->product_name}} </p>
                            <a href="{{route('product.detail', $product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                           
                        </div>
                        
                    </div>
                </div>
            @endforeach
            
            
        </div><!--features_items-->
    </div>
</section>
@endif
<style>

.star-rating {
  font-family: "FontAwesome";
  margin: 50px auto;
}
.star-rating > fieldset {
  border: none;
  display: inline-block;
}
.star-rating > fieldset:not(:checked) > input {
  position: absolute;
  left: -9999px;
  clip: rect(0, 0, 0, 0);
}
.star-rating > fieldset:not(:checked) > label {
  float: right;
  width: 1em;
  padding: 0 0.05em;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 200%;
  color: #16a085;
}
.star-rating > fieldset:not(:checked) > label:before {
  content: "\f006  ";
}
.star-rating > fieldset:not(:checked) > label:hover,
.star-rating > fieldset:not(:checked) > label:hover ~ label {
  color: #1abc9c;
  text-shadow: 0 0 3px #1abc9c;
}
.star-rating > fieldset:not(:checked) > label:hover:before,
.star-rating > fieldset:not(:checked) > label:hover ~ label:before {
  content: "\f005  ";
}
.star-rating > fieldset > input:checked ~ label:before {
  content: "\f005  ";
}
.star-rating > fieldset > label:active {
  position: relative;
  top: 2px;
}

</style>
@endsection