{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Danh sách liên hệ')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4>Danh sách liên hệ
    </h4>
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
@if($contacts->isEmpty())
<div class="alert alert-warning mt-5">
    <h4 class="text-center">Chưa có liên hệ nào</h4>
</div>
@else
<table id="list-post" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Họ tên</th>
            <th>Chủ đề</th>
            <th>Email</th>
            <th class="text-center">Trạng thái</th>
            <th>Thời gian</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->ho_ten}}</td>
            <td>{{strlen($contact->chu_de) > 50 ? substr($contact->chu_de,0,50) . ' ... ' : $contact->chu_de}} </td>
            <td>{{$contact->email}}</td>
            <td class="text-center">
                {!! 
                    $contact->trang_thai  == 0  
                    ?   
                    '<small class="badge badge-warning"><i class="far fa-clock"></i> chưa xem </small>' 
                    :
                   '<small class="badge badge-success"><i class="far fa-clock"></i> đã xem </small>'
                !!}
            </td>
            <td>{{date('d - m - Y',strtotime($contact->created_at))}}</td>
            <td class="text-center">
                <a href="{{route('admin.contact.detail',['id' => $contact->id])}}" style="width:30%" class="btn btn-warning btn-sm">Detail</a>
                <a href="{{route('admin.contact.delete',['id' => $contact->id])}}" style="width:30%" class="btn btn-danger btn-sm">Delete</a>
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