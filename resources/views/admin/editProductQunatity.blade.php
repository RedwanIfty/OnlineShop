@extends('admin.layouts.app')
@section('title')
    Edit Product Quantity
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Product Quantity</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Product Quantity</h5>
                    <small class="text-muted float-end">Input Information</small>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('updateproductquantity')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$productQuantity->id}}" name="product_id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_name">Image</label>
                            <div class="col-sm-10">
                                <img src="{{asset($productQuantity->product_img)}}" height="500px" alt="not found">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{$productQuantity->quantity}}"  />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit Product Quantity</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
