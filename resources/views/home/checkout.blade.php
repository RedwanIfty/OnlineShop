@extends('home.layouts.template')
@section('homeTitle')
    Ceck-out Page
@endsection
@section('main-content')
    <h2 class="text-center">Final step</h2>
    <div class="row">
        <div class="col-8">
            <div class="box_main">
                <h3>Product send at</h3>
                <p><b>Phone Number : </b>{{$shipping_address->phone_number}}</p>
                <p><b>City/Village Name : </b>{{$shipping_address->city_name}}</p>
                <p><b>Postal code : </b>{{$shipping_address->postal_code}}</p>
            </div>
        </div>
        <div class="col-4">
            <div class="box_main">
                <h3 class="text-center">Final Products are</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                           </tr>
                        </thead>
                        <tbody>
                        @php
                            $total=0;
                        @endphp
                        @foreach($cart_items as $item)
                            <tr>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            @php
                                $total=$total+$item->price;
                            @endphp
                        @endforeach
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>{{$total}}</td>
                             </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="{{route('cancelOrder')}}" method="POST" onsubmit="return confirm('Are you sure you want to place the order?')">
            @csrf
            <input type="submit" value="Cancel Order" class="btn btn-danger">
        </form>
        &nbsp
        <form action="{{route('placeOrder')}}" method="POST" onsubmit="return confirm('Are you sure you want to place the order?')">
            @csrf
            <input type="submit" value="Place Order" class="btn btn-secondary">
        </form>
    </div>
@endsection
