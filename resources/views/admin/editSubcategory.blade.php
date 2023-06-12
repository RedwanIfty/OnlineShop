@extends('admin.layouts.app')
@section('title')
    Update Sub Category
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Sub Category</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Update Sub Category</h5>
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

                    <form action="{{route('updatesubcategory',$subCategory->id)}}" method="post">
{{--                        action="{{route('updatesubcategory')}}" method="post">--}}
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="subcategory_name"
                                       name="subcategory_name"
                                       value="{{$subCategory->subcategory_name}}" />
                            </div>
                        </div>
{{--                        <div class="row mb-3">--}}
{{--                            <label class="col-sm-2 col-form-label" for="basic-default-name">Select Category</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <select readonly class="form-control" id="exampleFormControlSelect1"--}}
{{--                                        name='category_id' aria-label="Default select example">--}}
{{--                                    <option>select Category</option>--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <option @if($category->id === $subCategory->category_id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                    <select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="category_id"
                                       name="category_id"
                                       value="{{$subCategory->category_name}}"
                                       readonly
                                />

                                   </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">update Sub Category</button>
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
            $('#exampleFormControlSelect1').select2();
        });

    </script>
@endsection
