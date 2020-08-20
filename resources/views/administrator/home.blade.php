@extends('layouts.app')

@section('menu')
    @include('partials.navbar.administrator')
@endsection

@section('content')
    <books-component :registers="{{$books}}"></books-component>
@endsection
