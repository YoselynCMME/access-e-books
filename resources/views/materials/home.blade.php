@extends('layouts.app')

@section('menu')
    @include('partials.gralheader')
@endsection

@section('content')
    @include('partials.materials.books-with', ['books' => $books])
    <br><br>
    @if(auth()->user()->role_id === 3)
        @include('partials.materials.indications')
    @endif
@endsection
