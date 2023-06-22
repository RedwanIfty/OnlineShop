@extends('home.layouts.template')
@section('homeTitle')
    Product-Page
@endsection
@section('main-content')
    <div class="text-center"><h1 style="color:green;">Products details</h1></div>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="container wrapper">
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
                        <form action="{{route('addproducttocard',$product->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                <input type="hidden" value="{{$product->price}}" name="price">
                                <label for="product_quantity">Quantity :
                                    <input class="form-group" type="number" min="1" name="quantity" value="1">
                                </label>
                                <br>
                                <input class="btn btn-warning" type="submit" value="Add to Cart">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="fashion_section">
            <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($chunks as $key => $chunk)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
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
                                                        <form action="{{route('addproducttocard',$product->id)}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                                <input type="hidden" value="{{$product->price}}" name="price">
                                                                <input type="hidden" value="1" name="quantity">
                                                                <input class="btn btn-warning" type="submit" value="Buy">
                                                            </div>
                                                        </form>
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

        <div class="customer-review">
            @auth
                @foreach(auth()->user()->roles as $role)
                    @if($role->id===2)
                        <h2 class="text-center">Customer Reviews</h2>
                        <form action="{{route('productreviews',$product->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="review">Leave a Review:</label>
                                <textarea class="form-control" rows="5" id="review" name="review" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    @endif
                @endforeach
            @endauth
            <br>
                @if(count($reviews)>0)
                    <h2 class="text-center">Product Reviews</h2>
                    @foreach($reviews as $review)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$review->user_name}}</h5>
                                        <p class="card-text">{{$review->reviews}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="text-center">No reviews</h1>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
