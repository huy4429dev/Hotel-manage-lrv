{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Chi tiết đơn hàng')

@section('content_header')
<div class="d-flex justify-content-between">
  <h4>#DH {{$order->id}}
  </h4>
  <p class="text-right my-0 py-0">
    <a href="{{route('admin.order.index')}}" class="btn btn-secondary " style="width:40px; display:inline-block"><i class="fas fa-angle-left"></i></a>
  </p>
</div>
@stop
@section('content')

<div class="card-body">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Dịch vụ</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
      @if(!$order->orderDetail->isEmpty())
      @php
      $i = 0;
      @endphp
      @foreach($order->orderDetail as $detail)
      @php $i++ @endphp
      <tr>
        <td>{{$i}}</td>
        <td>
          {{$detail->store->ten_mat_hang}}
        </td>
        <td>{{number_format($detail->store->don_gia)}} đ</td>
        <td>{{$detail->so_luong}}</td>
        <td>{{number_format($detail->store->don_gia * $detail->so_luong)}} đ</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>
<!-- /.card-body -->
</div>
<div class="row">
  <div class="col-md-3 order-md-2 mb-4 ml-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Tổng đơn Hàng</span>
    </h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">Dịch vụ</h6>
        </div>
        <span class="text-muted">{{!$order->orderDetail->isEmpty() ? number_format($order->orderDetail->sum('thanh_tien')) : '0' }} đ</span>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">Tiền phòng</h6>
        </div>
        @php
        $totalServices = !$order->orderDetail->isEmpty() ? $order->orderDetail->sum('thanh_tien') : 0;
        @endphp
        <span class="text-muted"> {{number_format($order->tong_tien - $totalServices) }} đ </span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Tổng</span>
        <strong>{{number_format($order->tong_tien)}} đ</strong>
      </li>
    </ul>
    <form action="{{route('export')}}" method="post">
      @csrf
      <input id="orderId" type="hidden" name="orderId" value="{{$order->id}}">
      <button type="submit" class="btn btn-light">Xuất hóa đơn</button>
    </form>
  </div>
  @stop

  @section('css')
  @stop

  @section('js')
  @stop