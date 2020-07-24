@extends('layouts.app')

@section('menu')
    @include('partials.gralheader')
@endsection

@section('content')
    @include('partials.materials.books-with', ['books' => $books])
    <br><br>
    @include('partials.materials.indications')
@endsection
