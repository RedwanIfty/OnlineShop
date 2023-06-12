@extends('admin.layouts.app')

@section('title')
    All Sub Category
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Category Information</h4>
        <div class="card">
            <h5 class="card-header">Category</h5>
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
                        <th>Category Name</th>
                        <th>Sub Category</th>
                        <th>Product</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <!-- Table rows here -->
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->subcategory_count}}</td>
                            <td>{{$category->product_count}}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('editcategory',$category->id)}}"
                                        ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $category->id }})">
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
            $('#example').DataTable({
            responsive: true,
                "ordering":false

        });
        });
    </script>
    <script>
        function confirmDelete(categoryId) {
            if (confirm('Are you sure you want to delete this category?')) {
                // Redirect to the delete route with the category ID
                var url = "{{ route('deletecategory', ['id' => ':id']) }}";
                url = url.replace(':id', categoryId);
                window.location.href = url;
            }
        }
    </script>
@endsection
