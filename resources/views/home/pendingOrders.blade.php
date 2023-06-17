@php
   use  \App\Models\Product;
@endphp
@extends('home.layouts.user_profile_template')
@section('profilecontent')
    <h4 class="text-center">Pending Order list</h4>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Image</td>
                            <td>Product Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                        </tr>
                        @foreach($pendingOrders as $pendingOrder)
                            <tr>
                                @php
                                    $product=Product::where('id',$pendingOrder->product_id)->first();
                                @endphp
                                <td><img src="{{asset($product->product_img)}}" style="height: 50px"></td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$pendingOrder->quantity}}</td>
                                <td>{{$pendingOrder->total_price}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
