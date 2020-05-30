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
                $roomInfo = $room->order->filter(
                                function($order,$key)
                                    {
                                        return $order->trang_thai == 0;
                                    })->first()->customer->ho_ten;

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
                    @php 
                        $countAlert = $room->bookOnline->count()
                    @endphp
                    @if($countAlert > 0)
                    <div class="d-flex justify-content-end" style="height:18px">
                           <span class='badge badge-success alert-icon' data-targetIcon='{{$room->id}}'>{{$countAlert}}
                           </span>
                     
                             <div class='alert-content' id='target-icon-{{$room->id}}'>
                                    <span>Lịch đặt phòng</span>
                                    @foreach($room->bookOnline as $value)
                                    <p>{{$value->full_name}}</p>
                                    <p>{{$value->phone}}</p>
                                    <p>{{$value->ngay_dat}}</p>
                                    <hr>
                                    @endforeach
                               </div> 
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="info-box-text">{{$room->ma_phong}}</span>
                                <span class="info-box-number">
                                    <small>{{$roomInfo ?? ''}}</small> 
                                </span>
                            </div>
                            <span>{{$room->trang_thai == 'full' ?   Date("h : i - d / m", strtotime($room->bookRoom->last()->thoi_gian_ket_thuc)) : ''}}</span>
                        </div>
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
<style>
    .alert-icon{
    }
    .alert-content{
        display: none;
        position: absolute;
        top: 0;
        right: -24em;
        width: 400px;
        color: black;
        z-index: 99;
        background: wheat;
        padding: 15px;
        box-shadow: 4px 1px 4px 3px #3333;
        }
    .alert-icon:hover .alert-content{
        display: block;
        
    }
</style>
@stop

@section('js')
<script>
    var alertIcons = document.querySelectorAll('.alert-icon');
    alertIcons.forEach(function(item, index) {
        item.addEventListener('mouseenter', function(){
            var alert = document.querySelector('#target-icon-'+this.dataset.targeticon);
            alert.style.display = 'block';
            
        })
        item.addEventListener('mouseout', function(){
            var alert = document.querySelector('#target-icon-'+this.dataset.targeticon);
            alert.style.display = 'none';
            
        })
    })
</script>
@stop