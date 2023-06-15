@extends('home.layouts.template')
@section('homeTitle')
    Online-Shop
@endsection
@section('main-content')
    <div class="fashion_section">
        <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($chunks as $key => $chunk)
                    <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                        <div class="container">
                            <h1 class="fashion_taital">All Products</h1>
                            <div class="fashion_section_2">
                                <div class="row">
                                    @foreach($chunk as $product)
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="box_main">
                                                <h4 class="shirt_text">{{ $product->product_category_name }}</h4>
                                                <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                                <p class="price_text">Start Price  <span style="color: #262626;"><del>{{ $product->price }} TK</del></span></p>
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
@endsection
