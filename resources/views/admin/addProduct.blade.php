@extends('admin.layouts.app')
@section('title')
    Add Product
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Product</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add Product</h5>
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
                    <form action="{{route('storeproduct')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_name">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="{{old('product_name')}}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="price">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{old('price')}}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{old('quantity')}}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label " for="product_short_des">Product Short description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="product_short_des" name="product_short_des" cols="30" rows="10">{{old('product_short_des')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_long_des">Product Long description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="product_long_des" name="product_long_des" cols="30" rows="10">{{old('product_long_des')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_category_id">Select Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="product_category_id" name='product_category_id' onchange="loadSubcategory()"  aria-label="Default select example">
                                    <option selected value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_subcategory_id">Sub Category Name</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="product_subcategory_id" name='product_subcategory_id' aria-label="Default select example">
                                    <option selected value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_img">Upload Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="product_img" name="product_img" placeholder="Upload Image" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadSubcategory(){
            id=$('#product_category_id').val();
            //alert(id);

            $.ajax({
                type: 'POST',
                url: "{!! route('subcategoryload') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    console.log(data);
                     $('#product_subcategory_id').html(data);

                    // reloadTable();
                }

            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#product_category_id').select2();
            $('#product_subcategory_id').select2();
        });

    </script>
@endsection
