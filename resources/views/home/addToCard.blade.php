@extends('home.layouts.template')
@section('homeTitle')
    Cart-Page
@endsection
@section('main-content')
    <div class="text-center"><h1>Add to Cart</h1></div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="container wrapper">
        <div class="row">
            <div class="col-12">
                <div class="box_main">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $total=0;
                            @endphp
                            <tbody>
                            @foreach($cart_items as $item)
                                <tr>
                                    <td>
                                        <img src="{{asset($item->product_img)}}"style="height: 40px">
                                    </td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td><a class="btn btn-danger" href="#" onclick="confirmDelete({{$item->id}})">Remove</a></td>
                                </tr>
                                @php
                                    $total=$total+$item->price;
                                @endphp
                            @endforeach
                            @if($total>0)
                                <tr>
                                    <td></td>
                                    <td></td>>
                                    <td>Total</td>
                                    <td>{{$total}}</td>
                                        <td><a class="btn btn-primary" href="{{route('shippingaddress')}}" >Check out</a></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to remove this product from cart?')) {
                var url = "{{ route('removecartitem', ['id' => ':id']) }}";
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>
@endsection
