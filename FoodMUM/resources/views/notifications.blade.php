@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div id="grid_paging"></div>
@stop
@push('js')
    <script src="{{asset('js\jquery-ui.js')}}"></script>
     <link rel="stylesheet" href="{{asset('css\pqgrid.min.css')}}" />
    <script src="{{asset('js\pqgrid.min.js')}}"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css" />
    <script src="{{asset('js\notifications.js')}}"></script>
@endpush