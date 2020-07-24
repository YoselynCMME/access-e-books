@extends('layouts.app')

@section('menu')
    @include('partials.gralheader')
@endsection

@section('content')
    <iframe src="{{$link_lessons}}" width="100%" height="500" frameborder="0"></iframe>
@endsection
