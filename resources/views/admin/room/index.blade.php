{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h4>Quản lý phòng</h4>
@stop

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    @if($rooms->isEmpty())
    <div class="alert alert-warning">   
        <h4 class="text-center">
            Vui lòng thiết lập phòng
        </h4>
    </div>
    @else
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
    </div>
    @endif
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