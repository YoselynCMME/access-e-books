@extends('layouts.app')

@section('menu')
    @include('partials.gralheader')
@endsection

@section('content')
    <materials-component :register="{{$book}}" :registers="{{$categories}}"></materials-component>
@endsection
