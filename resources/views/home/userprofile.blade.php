@extends('home.layouts.user_profile_template')

@section('profilecontent')
    <h4>Welcome {{auth()->user()->name}}</h4>
@endsection
