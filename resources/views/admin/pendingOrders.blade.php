@php
    use App\Models\User;
    use App\Models\Product;
@endphp
@extends('admin.layouts.app')
@section('title')
    Pending Orders
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Pending Orders</h4>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">Pending List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Products</th>
                            <th>Information's</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ordersData->groupBy('user_id') as $userId => $orders)
                            @php
                                $firstOrder = $orders->first();
                                $shippingPhoneNumber = $firstOrder->shipping_phoneNumber;
                                $shippingCity = $firstOrder->shipping_city;
                                $shippingPostalCode = $firstOrder->shipping_postalcode;
                            @endphp
                            @php
                                $userName=User::where('id',$userId)->value('name');
                            @endphp
                            <tr>
                                <td>{{ $userName }}</td>
                                <td>
                                    <ul>
                                        @php
                                            $grandTotal=0;
                                        @endphp
                                        @foreach ($orders as $order)
                                            @php $productName=Product::where('id',$order->product_id)->value('product_name') @endphp
                                            <li>Product {{ $productName }}</li>
                                            <li>Quantity {{ $order->quantity }}</li>
                                            <li>Total Price {{$order->total_price}}</li>
                                            @php
                                                $grandTotal=$grandTotal+$order->total_price;
                                            @endphp
                                            <br>
                                        @endforeach
                                        <li><b>Grand Total</b> {{$grandTotal}}</li>
                                    </ul>
                                </td>
                                <td>
                                    <ol>
                                        <li>Number: {{ $shippingPhoneNumber }}</li>
                                        <li>City/Village:{{ $shippingCity }}</li>
                                        <li>Postal Code: {{ $shippingPostalCode }}</li>
                                    </ol>
                                </td>
                                <td>
                                    <a href="{{route('deliverProduct',$userId)}}" class="btn btn-primary">Deliver</a>
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
@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
