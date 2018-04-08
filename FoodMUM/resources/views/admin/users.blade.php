@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <div id="users_grid"></div>
@stop
@push('scripts')
    <script src="{{asset('js\pqgrid.min.js')}}"></script>
@endpush