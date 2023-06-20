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
                            <h3 class="card-text">
                                <!-- Display the user count on the dashboard -->
                                <span id="userCount">{{ $userCount }}</span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <h3 class="card-text">{{$totalSell}} TK</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <h3 class="card-text">{{$totalOrder}}</h3>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
            // Enable Pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('b73f7c86ee3c8bda3908', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('e-commerce');
            channel.bind('notify', function(data) {
                // Update the user count on the dashboard
                document.getElementById('userCount').innerText = data.message;
            });
        </script>
@endsection
