{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Danh sách bài viết')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4>Danh sách bài viết
    </h4>
    <p class="text-right my-0 py-0">
        <a href="{{route('admin.post.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </p>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert warning-success">
        {{ session('error') }}
    </div>
    @endif
</div>
@stop
@section('content')
@if($posts->isEmpty())
<div class="alert alert-warning mt-5">
    <h4 class="text-center">Chưa có bài viết nào</h4>
</div>
@else
<table id="list-post" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Mô tả</th>
            <th>Tác giả</th>
            <th class="text-center">Lượt xem</th>
            <th>Thời gian</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->tieu_de}}</td>
            <td>{{strlen($post->mo_ta) > 50 ? substr($post->mo_ta,0,50) . ' ... ' : $post->mo_ta}} </td>
            <td>{{$post->user->name}}</td>
            <td class="text-center">{{$post->luot_xem}}</td>
            <td>{{date('d - m - Y',strtotime($post->created_at))}}</td>
            <td class="text-center">
                <a href="{{route('admin.post.edit',['id' => $post->id])}}" style="width:30%" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{route('admin.post.delete',['id' => $post->id])}}" style="width:30%" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#list-post').DataTable({

            "columnDefs": [{
                    "width": "15%",
                    "targets": 5
                },
                {
                    "width": "10%",
                    "targets": 4
                },
                {
                    "width": "10%",
                    "targets": 3
                },
                {
                    "width": "15%",
                    "targets": 2
                },
            ]
        });
    });
</script>
@stop