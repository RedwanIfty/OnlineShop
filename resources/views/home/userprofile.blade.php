@extends('home.layouts.user_profile_template')

@section('profilecontent')
    <h1 class="text-center"><span style="color:green;">Welcome {{auth()->user()->name}}</span></h1>
    <h4 class="text-center">Completed Order list</h4>
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
                            <th>Order Time</th>
                            <th>Delivery Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completedOrders as $completedOrder)
                            <tr>
                                @php
                                    $product = \App\Models\Product::find($completedOrder->product_id);
                                @endphp
                                <td><img src="{{ asset($product->product_img) }}" style="height: 50px"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $completedOrder->quantity }}</td>
                                <td>{{ $completedOrder->total_price }}</td>
                                <td>{{ $completedOrder->created_at->format('d-F-Y') }}</td>
                                <td>{{ $completedOrder->updated_at->format('d-F-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
