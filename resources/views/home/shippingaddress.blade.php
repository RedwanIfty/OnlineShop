@extends('home.layouts.template')
@section('main-content')
    <h3 class="text-center">Provide shipping information </h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{route('addshippingaddress')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input class="form-control" type="text" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City Name</label>
                        <input class="form-control" type="text" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal code</label>
                        <input class="form-control" type="text" name="postal_code">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Next">
                </form>
            </div>
        </div>
    </div>
@endsection

