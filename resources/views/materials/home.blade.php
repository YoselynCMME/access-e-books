@extends('layouts.app')

@section('menu')
    @include('partials.gralheader', ['type' => 'english'])
@endsection

@section('content')
    @if($books->count() === 0)
        <m-alert-component :user="{{ auth()->user() }}"></m-alert-component>
    @endif
    <div class="row">
        @include('partials.materials.books-with', ['books' => $books])
        @include('partials.materials.search-book')
    </div><br><br>
    @include('partials.materials.indications')
@endsection
