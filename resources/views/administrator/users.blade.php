@extends('layouts.app')

@section('menu')
    @include('partials.navbar.administrator')
@endsection

@section('content')
    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('administrator.register') }}">
            <i class="fa fa-plus"></i> Nuevo usuario
        </a>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa fa-check"></i> {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <users-component :registers="{{$users}}"></users-component>
@endsection
