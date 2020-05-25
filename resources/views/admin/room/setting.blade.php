{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cấu hình phòng')

@section('content_header')
<h4>Cấu hình phòng</h4>
@stop

@section('content')

@if($config != null) 
<div class="row">
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông số : <small> {{$floor->sum('so_phong')}} / {{$config->so_phong}} phòng</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-warning">
                    {{$errors->first()}}
                </div>
                @endif

                <form action="{{url('admin/room/setting/update')}}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tầng</th>
                                <th>Số phòng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($floor as $item)
                            <tr>
                                <td>{{$item->ten_tang}}</td>
                                <td>
                                    <input class="floor-config" type="text" value="{{$item->so_phong}}" name="so_tang[]">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button class="btn btn-success">Cập nhật</button>
                                </td>

                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endif
<!-- /.card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cập nhật thông số</h3>
    </div>
    <div class="card-body">
        <form action="{{url('admin/room/setting/create')}}" method="POST">
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
                <label>Số tầng:</label>
                <input type="text" class="form-control my-colorpicker1" name="so_tang" value="{{$config->so_tang ?? ''}}">
            </div>

            <div class="form-group">
                <label>Số phòng:</label>
                <input type="text" class="form-control my-colorpicker1" name="so_phong" value="{{$config->so_phong ?? ''}}">
            </div>

            <div class="form-group">
                <label>Mã phòng:</label>
                <input type="text" class="form-control my-colorpicker1" name="ma_phong" value="{{$config->ma_phong ?? ''}}">
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Thiết lập</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .floor-config {
        outline: none;
        border: none;
        width: 80px;
    }
</style>
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop