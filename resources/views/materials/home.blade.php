@extends('layouts.app')

@section('menu')
    @include('partials.gralheader')
@endsection

@section('content')
    @if(auth()->user()->role_id === 2 || auth()->user()->role_id === 3)
        @include('partials.materials.books-with', ['books' => $books])
    @endif
    @if(auth()->user()->role_id === 4)
        @include('partials.materials.books-guide', ['books' => $books])
    @endif
    <br><br>
    @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
        @include('partials.materials.indications')
    @endif
@endsection
