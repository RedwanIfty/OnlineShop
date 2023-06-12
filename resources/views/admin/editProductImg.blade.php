@extends('admin.layouts.app')
@section('title')
    Edit Product Image
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Product Image</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Product Image</h5>
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
                    <form action="{{route('updateproductimg')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$productImg->id}}" name="product_id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_name">Previous Image</label>
                            <div class="col-sm-10">
                                <img src="{{asset($productImg->product_img)}}" height="500px" alt="not found">
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
                                <button type="submit" class="btn btn-primary">Edit Product Image</button>
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
        $(document).ready(function() {
            $('#product_category_id').select2();
            $('#product_subcategory_id').select2();
        });

    </script>
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
@endsection
