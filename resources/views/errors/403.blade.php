@extends('layouts.app')

@section('content')
    <h2>{{__("Status Code")}}: 403</h2>
    <div class="alert alert-danger">
        <h4>{{__("OPS!")}} {{__("Sorry")}}...</h4>
        <p>{{__("Sorry, your access is refused due to security reasons of our server and also our sensitive data.")}}</p>
        <a class="btn btn-danger" href="{{url("/")}}">{{__("Home")}}</a>
    </div>
@endsection
