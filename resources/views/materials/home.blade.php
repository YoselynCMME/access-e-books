@extends('layouts.app')

@section('menu')
    @include('partials.gralheader', ['type' => 'english'])
@endsection

@section('content')
    
    <div class="row">
        @include('partials.materials.books-with', ['books' => $books])
        @include('partials.materials.search-book')
    </div><br><br>
    @include('partials.materials.indications')
@endsection
