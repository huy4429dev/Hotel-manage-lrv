{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Danh sách khách hàng')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4>Danh sách khách hàng
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
@if($customers->isEmpty())
<div class="alert alert-warning mt-5">
    <h4 class="text-center">Chưa có bài viết nào</h4>
</div>
@else
<table id="list-customer" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Họ tên</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Đặt phòng</th>
            <th class="text-center">Ngày đặt mới</th>
            <th class="text-center">Ngày tạo</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->ho_ten}}</td>
            <td class="text-center">{{$customer->so_dien_thoai}}</td>
            <td class="text-center">{{$customer->so_lan_dat_phong}}</td>
            <td class="text-center">{{date('d - m - Y',strtotime($customer->updated_at))}}</td>
            <td class="text-center">{{date('d - m - Y',strtotime($customer->created_at))}}</td>
            <td class="text-center">
                <a href="{{route('admin.customer.detail',['id' => $customer->id])}}" style="width:30%" class="btn btn-warning btn-sm">Detail</a>
                <a href="{{route('admin.customer.delete',['id' => $customer->id])}}" style="width:30%" class="btn btn-danger btn-sm">Delete</a>
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
        $('#list-customer').DataTable({

            "columnDefs": [{
                    "width": "15%",
                    "targets": 5
                },
                {
                    "width": "15%",
                    "targets": 4
                },
                {
                    "width": "15%",
                    "targets": 3
                },
                {
                    "width": "15%",
                    "targets": 2
                },
                {
                    "width": "15%",
                    "targets": 1
                },
            ]
        });
    });
</script>
@stop