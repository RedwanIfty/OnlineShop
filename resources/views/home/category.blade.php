@extends('home.layouts.template')
@section('homeTitle')
    Category-Page
@endsection
@section('main-content')
@if($category->product_count>0)
    <div class="fashion_section">
        <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($chunks as $key => $chunk)
                    <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                        <div class="container">
                            <h1 class="fashion_taital">{{$category->category_name}}</h1>
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
                                                    <div class="buy_bt">
                                                        <form action="{{route('addproducttocard',$product->id)}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                                <input type="hidden" value="{{$product->price}}" name="price">
                                                                <input type="hidden" value="1" name="quantity">
                                                                <input class="btn btn-warning" type="submit" value="Buy">
                                                            </div>
                                                        </form>
                                                    </div>
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
@else
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 style="text-align: center;color: red;">No Products Available</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
@endsection
