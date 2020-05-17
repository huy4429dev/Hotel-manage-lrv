{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
<div class="container-fluid d-flex justify-content-between">
  <h4>Chi tiết phòng:</h4>
  @if($bookRoom->thoi_gian_ket_thuc != null)
  <div id="clock" class="clock"></div>
  @endif
</div>
@stop
@section('content')
<div class="container-fluid">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12">
      <div class="info-box">
        <span class="info-box-icon bg-{{$status}} elevation-1"><i class="fas fa-cog"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{$room->ma_phong}}</span>
          <span class="info-box-number">
            <small>{{$statusInfo}}</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Cập nhật phòng</h3>
    </div>
    <div class="card-body">
      <form action="{{url('admin/room/'.$room->id)}}" method="POST">
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
          <div class="form-group">
            <label>Trạng thái:</label>
            <select class="form-control" style="width: 100%;" name="trang_thai">
              <!-- @switch($room->trang_thai)
                @case('empty')
                  @php 
                    $selected 
                  @endphp 
                @break
              @endswitch -->
              <option {{ strtolower($room->trang_thai === 'maintenance') ?  'selected' : '' }} value="maintenance">Bảo trì</option>
              <option {{ strtolower($room->trang_thai === 'empty') ?  'selected' : null }} value="empty">Phòng trống</option>
              <option {{ strtolower($room->trang_thai === 'full') ?  'selected' : null }}" value="full">Thêm khách hàng</option>
              <option {{ strtolower($room->trang_thai === 'fulltime') ?  'selected' : null }}" value="fulltime">Hết giờ</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Họ tên:</label>
          <input type="text" class="form-control my-colorpicker1" name="ho_ten" value="{{$customer->ho_ten ?? ''}}">
        </div>

        <div class="form-group">
          <label>Số điện thoại:</label>
          <input type="text" class="form-control my-colorpicker1" name="so_dien_thoai" value="{{$customer->so_dien_thoai ?? ''}}">
        </div>

        <div class="form-group">
          <label>Số CMND:</label>
          <input type="text" class="form-control my-colorpicker1" name="so_cmnd" value="{{$customer->so_cmnd ?? ''}}">
        </div>

        <div class="form-group">
          <label>Thời gian đặt (giờ):</label>
          <input type="text" class="form-control my-colorpicker1" name="thoi_gian_dat" value="{{$bookRoom->thoi_gian_dat ?? ''}}">
        </div>

        <div class="form-group">
          <label>Ghi chú:</label>
          <textarea type="text" class="form-control my-colorpicker1" name="ghi_chu">{{$bookRoom->ghi_chu ?? ''}}</textarea>
        </div>

        <div class="form-group">
          <button class="btn btn-primary btn-sm" type="submit">Thiết lập</button>
        </div>

      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Danh sách dịch vụ</h3>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
              Thêm
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          @if(!$listServices == null)
          <table id="listServices" class="table table-sm">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Tên dịch vụ</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              @php
              $i = 0
              @endphp
              @foreach($listServices as $service)
              @php $i ++ @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$service->ten_mat_hang}}</td>
                <td>{{$service->so_luong}}</td>
                <td>{{number_format($service->don_gia) . '   đ'}}</td>
                <td>{{number_format($service->so_luong * $service->don_gia) . '   đ'}}</td>
              </tr>
              @endforeach
            </tbody>
            
          </table>
          <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a href="" class="btn btn-success btn-sm">Thanh toán</a></li>
                </ul>
              </div>
          @else
          <p class="pt-3 pl-3">Chưa thêm dịch vụ nào </p>
          @endif

        </div>

        <!-- /.card-body -->
      </div>

      <div class="text-right my-5">

      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
</div>
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Dịch vụ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <div class="form-group" id="before-alert">
            <label>Sản phẩm</label>
            <select class="form-control select2" style="width: 100%;" name="mat_hang_id">
              @if(!$products->isEmpty())
              @foreach($products as $product)
              <option value="{{$product->id}}">{{$product->ten_mat_hang}}</option>
              @endforeach
              @else
              <option>Chưa có sản phẩm nào</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>Số lượng</label>
            <input class="form-control select2" style="width: 100%;" value="1" name="so_luong">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="add-service" type="button" class="btn btn-primary">Chọn</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @stop

    @section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
      .clock {
        color: #17D4FE;
        font-size: 20px;
        letter-spacing: 4px;
        padding: 0 10px;
        border: 1px solid #17D4FE;
      }

      .select2-container--default .select2-selection--single {
        height: 38px !important;
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @stop

    @section('js')
    <script>
      var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

      var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = new Date({{strtotime($bookRoom->thoi_gian_ket_thuc)}}).getTime() * 1000 - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("clock").innerHTML = hours + "h " +
          minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("clock").innerHTML = "Hết giờ";
        }

      }, 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
      $(function() {
        $('.select2').select2();
      });
    </script>
    <script>



      let renderListServices = function(data){
        let listServices = document.querySelector('#listServices tbody');
          let body = '';
          let i = 0;
          data.forEach(item => {
             i ++;
             body += `<tr> 
                        
                        <td> ${i} </td> 
                        <td> ${item.ten_mat_hang} </td> 
                        <td> ${item.so_luong} </td> 
                        <td>${item.don_gia}</td> 
                        <td>${item.so_luong * item.don_gia}</td> 
                      </tr>`;
          })

          listServices.innerHTML = body;
          console.log(body);
          
          
      }

      let listServices = document.querySelector('#listServices tbody');
      

      let btnAddService = document.querySelector('#add-service');

      const url = "{{url("/admin/room/add-service/$room->id")}}";

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
      let modalBody = document.querySelector('.modal-body > div');
      let nodeAfterAlert = document.querySelector('#before-alert');


      


      let alertAddService = document.createElement('div');
      alertAddService.className += 'alert alert-success alert-add-service';

      btnAddService.addEventListener('click', function() {

        let mat_hang_id = document.querySelector('select[name="mat_hang_id"]').value;
        let so_luong = document.querySelector('input[name="so_luong"]').value;


        const data = {
          mat_hang_id: mat_hang_id,
          so_luong: so_luong,
        };

        fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify(data)

          })
          .then(response => response.json())
          .then(data => {

            alertAddService.innerHTML = `Đã thêm sản phẩm: ${data.service.ten_mat_hang} - số lương: ${data.service.so_luong}`;
            modalBody.insertBefore(alertAddService, nodeAfterAlert);
            
            renderListServices(data.listServices);
            
          })
          .catch((err) => {
            console.log(err);
          })

      })
    </script>
    @stop