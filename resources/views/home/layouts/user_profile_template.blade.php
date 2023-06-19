@extends('home.layouts.template')
@section('homeTitle')
    UserProfile-Page
@endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main bg-light">
                <ul>
                    <li><a href="{{route('userProfile')}}">Dashboard</a><li>
                    <li><a href="{{route('userPendingOrders')}}">Pending Order</a></li>
                    <li><a href="{{route('history')}}">History</a><li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="box_main">
                @yield('profilecontent')
            </div>
        </div>
    </div>
</div>
@endsection
