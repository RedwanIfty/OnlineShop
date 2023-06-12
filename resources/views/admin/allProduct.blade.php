@extends('admin.layouts.app')
@section('title')
    All Product
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Product</h4>
        <div class="card">
            <h5 class="card-header">Product</h5>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            @endif
            @if(session()->has('errormessage'))
                <div class="alert alert-danger">
                    {{session()->get('errormessage')}}
                </div>
            @endif


            <div class="table-responsive text-nowrap">
                <table class="table" id="example">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <!-- Table rows here -->
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>
                                <img src="{{asset($product->product_img)}}" height="50px" alt="no image found"><br>
                                <a href="{{route('editimg',[$product->id,$product->product_name])}}" class="bx bx-edit-alt me-2"> </a>
                            </td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('editproduct',$product->id)}}"
                                        ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $product->id }})"
                                        ><i class="bx bx-trash me-2"></i> Delete</a
                                        >
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
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
    <script>
        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                var url = "{{ route('deleteproduct', ['id' => ':id']) }}";
                url = url.replace(':id', productId);
                window.location.href = url;
            }
        }
    </script>
@endsection
