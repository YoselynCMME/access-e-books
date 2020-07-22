@extends('layouts.app')

@section('menu')
    @include('partials.gralheader', ['type' => 'english'])
@endsection

@section('content')
    @if($books->count() === 0)
        <m-alert-component :user="{{ auth()->user() }}"></m-alert-component>
    @endif
    <div class="row">
        @if(auth()->user()->role_id === 3)
            @include('partials.materials.books-teacher', ['books' => $books])
        @endif
        @if(auth()->user()->role_id === 2)
            @include('partials.materials.books-student', ['books' => $books])
        @endif
        @include('partials.materials.search-book')
    </div><br><br>
    @include('partials.materials.indications')
@endsection
