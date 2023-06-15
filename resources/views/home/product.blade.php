@extends('home.layouts.template')
@section('homeTitle')
    Product-Page
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <div class="tshirt_img">
                        <img src="{{asset($product->product_img)}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="product-info">
                        <h4 class="shirt_text text-left">{{$product->product_name}}</h4>
                        <p class="price_text text-left"> Price <span style="color: #262626">{{$product->price}} TK</span></p>
                    </div>
                    <div class="my-3 product-details">
                        <p class="lead"><b style="color: #262626">Description:</b>{{$product->product_long_des}}</p>
                        <ul class="p-2 bg-light my-2">
                            <li>Category-{{$product->product_category_name}}</li>
                            <li>Sub Category-{{$product->product_subcategory_name}}</li>
                            <li>Available-{{$product->quantity}}</li>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <div class="btn btn-warning">
                            <a href="#">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fashion_section">
            <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($chunks as $key => $chunk)
                        <div class="carousel-item   {{ $key === 0 ? ' active' : '' }}">
                            <div class="container">
                                <h1 class="fashion_taital">Related products</h1>
                                <div class="fashion_section_2">
                                    <div class="row">
                                        @foreach($chunk as $product)
                                            <div class="col-lg-3 col-sm-3">
                                                <div class="box_main">
                                                    <h4 class="shirt_text">{{$product->product_category_name}}</h4>
                                                    <h4 class="shirt_text">{{$product->product_name}}</h4>
                                                    <p class="price_text">Start Price  <span style="color: #262626;"><del>{{$product->price}} TK</del></span></p>
                                                    <div class="electronic_img"><img src="{{ asset($product->product_img) }}" height="500px"></div>
                                                    <div class="btn_main">
                                                        <div class="buy_bt"><a href="#">Buy Now</a></div>
                                                        <div class="seemore_bt">
                                                            <a href="{{route('singleProduct',[$product->id,$product->slug])}}">
                                                                See More
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-next" href="#electronic_main_slider" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-prev" href="#electronic_main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection