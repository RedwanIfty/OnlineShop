@extends('admin.layouts.app')
@section('title')
    All Sub Category
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Sub Category</h4>
        <div class="card">
            <h5 class="card-header">Sub Category</h5>
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
                        <th>Sub Category Name</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($subCategories as $subCat)
                        <tr>
                            <td>{{$subCat->id}}</td>
                            <td>{{$subCat->subcategory_name}}</td>
                            <td>{{$subCat->category_name}}</td>
                            <td>{{$subCat->product_count}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('editsubcategory',$subCat->id)}}"
                                        ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $subCat->id }})">
                                            <i class="bx bx-trash me-2"></i> Delete
                                        </a>
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
        function confirmDelete(subcategoryId) {
            if (confirm('Are you sure you want to delete this sub category?')) {
                // Redirect to the delete route with the category ID
                var url = "{{ route('deletesubcategory', ['id' => ':id']) }}";
                url = url.replace(':id', subcategoryId);
                window.location.href = url;
            }
        }
    </script>
@endsection
