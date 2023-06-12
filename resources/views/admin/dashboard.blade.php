@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Main content -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Customers</h5>
                            <h3 class="card-text">{{$userCount}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <h3 class="card-text">$1000</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <h3 class="card-text">150</h3>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.container-fluid -->
@endsection
