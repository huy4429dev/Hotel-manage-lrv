{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Danh sách hóa đơn')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4>Danh sách hóa đơn
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
@if($orders->isEmpty())
<div class="alert alert-warning mt-5">
    <h4 class="text-center">Chưa có bài viết nào</h4>
</div>
@else
<table id="list-order" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Khách hàng</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Tổng tiền</th>
            <th class="text-center">Ngày tạo</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td >{{$order->customer->ho_ten}}</td>
            <td class="text-center">{{$order->customer->so_dien_thoai}}</td>
            <td class="text-center">{{$order->trang_thai == 0 ? 'đã xử lý' : 'chưa xử lý'}}</td>
            <td class="text-center">{{number_format($order->tong_tien)}} đ</td>
            <td class="text-center">{{date('d - m - Y',strtotime($order->created_at))}}</td>
            <td class="text-center">
                <a href="{{route('admin.order.detail',['id' => $order->id])}}" style="width:30%" class="btn btn-warning btn-sm">Detail</a>
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
        $('#list-order').DataTable({

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