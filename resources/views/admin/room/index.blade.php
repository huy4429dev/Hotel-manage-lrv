{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>Quản lý phòng</h4>
@stop

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-12 col-sm-6 col-md-3">
            @php
            $class = "success"
            @endphp

            @switch(strtolower($room->trang_thai))
            @case("maintenance")
            @php
                $class = "danger";
                $roomInfo = "Đang bảo trì"
            @endphp
            @break

            @case("empty")
            @php
                $class = "success";
                $roomInfo = "Phòng trống"

            @endphp
            @break

            @case("full")
            @php
                $class = "info";
                $roomInfo = "Nguyễn Văn A";
            @endphp
            @break

            @case("fulltime")
            @php
                $class = "warning";
                $roomInfo = "Hết giờ";
            @endphp
                @break
            @default
                @break

            @endswitch
            <div class="info-box">
                <span class="info-box-icon bg-{{$class}} elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <a href="{{url('admin/room/' . $room->id)}}">
                        <span class="info-box-text">{{$room->ma_phong}}</span>
                        <span class="info-box-number">
                            <small>{{$roomInfo ?? ''}}</small>
                        </span>
                    </a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endforeach
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ID: 002</span>
                    <small>Đang bảo trì</small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ID: 004</span>
                    <small>Phòng trống</small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ID: 006</span>
                    <small>Nguyễn Văn B</small>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop