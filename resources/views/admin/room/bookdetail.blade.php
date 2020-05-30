{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Chi tiết phòng')

@section('content_header')
<h4>Chi tiết lịch đặt phòng # {{$book->id}}</h4>
@stop
@section('content')
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <form action="{{route('room.book.update',['id' => $book->id])}}" method="POST">
            @if (session('bookUpdate'))
            <div class="alert alert-success">
                {{ session('bookUpdate') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @csrf
            <div class="form-group">
                <label>Loại phòng:</label>
                <select class="form-control" style="width: 100%;" name="loai_phong_id" disabled>
                    <option {{ $book->loai_phong_id === 1 ?  'selected' : '' }} value="1">Vip</option>
                    <option {{$book->loai_phong_id  === 2  ?  'selected' : '' }} value="2">Normal</option>
                </select>
            </div>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" class="form-control my-colorpicker1" disabled name="ho_ten" value="{{$book->full_name ?? ''}}">
            </div>

            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" class="form-control my-colorpicker1" disabled name="so_dien_thoai" value="{{$book->phone ?? ''}}">
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control my-colorpicker1" disabled name="email" value="{{$book->email ?? ''}}">
            </div>

            <div class="form-group">
                <label>Ngày đặt phòng:</label>
                <input type="text" class="form-control my-colorpicker1" disabled name="thoi_gian_dat" value=" {{date('d-m-Y',strtotime($book->ngay_dat)) ?? ''}}">
            </div>
            <div class="form-group">
                <label>Thời gian đặt (giờ):</label>
                <input type="text" class="form-control my-colorpicker1" disabled name="thoi_gian_dat" value="{{$book->thoi_gian_dat ?? ''}}">
            </div>
            <div class="form-group">
                <label>Chọn phòng:</label>
                <select class="form-control" style="width: 100%;" name="phong_id">
                    @if(!$rooms->isEmpty())
                    @foreach($rooms as $room)
                    <option value="{{$room->id}}">{{$room->ma_phong}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm" type="submit">Thiết lập</button>
            </div>

        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop