{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Chi tiết khách hàng')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4># {{$customer->ho_ten}}
    </h4>
    <p class="text-right my-0 py-0">
        <a href="{{route('admin.customer.index')}}" class="btn btn-secondary " style="width:40px; display:inline-block"><i class="fas fa-angle-left"></i></a>
    </p>
</div>
@stop
@section('content')
  
    chi tiet khach hang

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop