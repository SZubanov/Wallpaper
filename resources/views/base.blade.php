@extends('adminlte::page')

@section('title', ($title ?? config('app.name')))

@section('content_header')
    <h1 class="pl-4 m-0 text-dark">{{ $title ?? '' }}</h1>
@stop

@section('content')
    <div id="container-fluid" class="container-fluid">
        @yield('page')
    </div>
    <i id="preloader" class="fa fa-refresh fa-spin d-none" style="position: absolute; left: 50%; top: 50%" ><i class="fas fa-sync-alt" style="font-size: 100px; color: #007bff"></i></i>
@stop
