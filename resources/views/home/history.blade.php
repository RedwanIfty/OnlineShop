@extends('home.layouts.user_profile_template')

@section('profilecontent')
    <h4 class="text-center">Order list</h4>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                @php
                                    $product = \App\Models\Product::find($order->product_id);
                                @endphp
                                <td><img src="{{ asset($product->product_img) }}" style="height: 50px"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    @if($order->status=='delivered')
                                        <span style="color: green">{{$order->status}}<span>
                                    @elseif($order->status=='pending')
                                        <span style="color: yellow">{{$order->status}}<span>
                                    @else
                                        <span style="color:red">{{$order->status}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
