@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<style>
.pq-grid-col.pq-right-col.pq-grid-col-leaf{
    border-width:0px !important;
}
.pq-grid td.pq-grid-col{
     border-right:0px !important;
     border-top:0px !important;
   
}
.pq-grid-number-col{
    border-width:0px !important;
}
.pq-grid-top.ui-widget-header.ui-corner-top{
    height:0 !important;
}
.pq-grid-title.ui-corner-top
{
    border-width:0 !important;
}
.ui-widget-header{
    background-color:transparent !important;
    background:transparent !important;
    color:black !important;

}
.ui-widget-content{
    background-color:transparent !important;
    background:transparent !important;
    border-width:0px !important;
}
.pq-grid-header{
    background-color:transparent !important;
    background:transparent !important;
    color:black !important;
}
tr:nth-child(odd) {
    background-color: #ffffff
}
.pq-grid-header-search-row {
    background-color: transparent !important;
}
.notification-unread{
    background-color:#fff20024 !important;
    color:#111 !important; 
   }

</style>
    <div id="grid_notification"></div>
@stop
@push('js')
    <script src="{{asset('js\jquery-ui.js')}}"></script>
     <link rel="stylesheet" href="{{asset('css\pqgrid.min.css')}}" />
     <link rel="stylesheet" href="{{asset('css\daterangepicker.css')}}" />
    <script src="{{asset('js\pqgrid.min.js')}}"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css" />
    <script src="{{asset('js\moment.js')}}"></script>
    <script src="{{asset('js\daterangepicker.js')}}"></script>
    <script src="{{asset('js\notifications.js')}}"></script>
@endpush