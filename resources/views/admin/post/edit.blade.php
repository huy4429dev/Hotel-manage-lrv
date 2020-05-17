{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cập nhật bài viết')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4>Cập nhật bài viết
    </h4>
    <p class="text-right my-0 py-0">
        <a href="{{route('admin.post.index')}}" class="btn btn-secondary " style="width:40px; display:inline-block"><i class="fas fa-angle-left"></i></a>
    </p>     
</div>
@stop

@section('content')
@if($post != null)
    <form action="{{route('admin.post.update',['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
            <label>Tiêu đề</label>
            <input type="text" class="form-control my-colorpicker1" name="tieu_de" value="{{$post->tieu_de}}">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea type="text" class="form-control my-colorpicker1" name="mo_ta" rows="5">{{$post->mo_ta}}</textarea>
        </div>
        <div class="form-group">
            <p><img width="70px" src="{{url($post->hinh_anh)}}"></p>
            <label>Hình ảnh</label>
            <div>
                <input type="file" name="hinh_anh">
            </div>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea id="text" cols="30" rows="10" name="noi_dung">{!!$post->noi_dung!!}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Sửa</button>
        </div>
    </form>
    @else
        <div class="alert alert-warning mt-5">
            <h4 class="text-center">Không tồn tại bài viết</h4>
        </div>
    @endif
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src={{ url('ckeditor/ckeditor.js') }}></script>
<script>
    CKEDITOR.replace('text', {
        filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'

    });
</script>
@include('ckfinder::setup')
<script>
    console.log('Hi!');
</script>
@stop