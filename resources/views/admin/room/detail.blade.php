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
            <p>{{$room->typeRoom->ten}} : <span>{{number_format($room->typeRoom->gia_phong)}} đ</span></p>
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
              <option {{ strtolower($room->trang_thai === 'maintenance') ? 'selected ' : '' }}  value="maintenance">Bảo trì</option>
              <option {{ strtolower($room->trang_thai === 'empty') ? 'selected ' : '' }}  value="empty">Phòng trống</option>
              <option {{ strtolower($room->trang_thai === 'full') ? 'selected ' : '' }}   value="full">Thêm khách hàng</option>
              <option {{ strtolower($room->trang_thai === 'fulltime') ? 'selected ' : '' }}   value="fulltime">Hết giờ</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Loại phòng:</label>
          <select class="form-control" style="width: 100%;" name="loai_phong_id">
              <option {{ $room->loai_phong_id === 1 ?  'selected' : '' }} value="1">Vip</option>
              <option {{$room->loai_phong_id  === 2  ?  'selected' : '' }} value="2">Normal</option>
            </select>
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

  @if($room->trang_thai == 'full' || $room->trang_thai == 'fulltime')
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
                  <li class="page-item"><button id="checkout" data-toggle="modal" data-target="#modal-success"  class="btn btn-success btn-sm">Thanh toán</button></li>
                </ul>
              </div>
          @else
          <p class="pt-3 pl-3">Chưa thêm dịch vụ nào </p>
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
            </tbody>
            </table>
          <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><button id="checkout" data-toggle="modal" data-target="#modal-success" class="btn btn-success btn-sm">Thanh toán</button></li>
                </ul>
              </div>
          @endif
 
        <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Thanh toán thành công</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="card" id="listOrder">
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Dịch vụ</th>
                      <th>Số lượng</th>
                      <th>Đơn giá</th>
                      <th>Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              <div class="card-footer clearfix">
                  <p> <span style="width: 100px; display:inline-block">Tiền phòng:</span> <span id="roomPrice">  20000 đ </span></p>
                  <p> <span style="width: 100px; display:inline-block">Tổng tiền: </span>  <span id="roomTotal"> 200000 đ </span></p>
                
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-light">Xuất hóa đơn</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
        </div>

        <!-- /.card-body -->
      </div>

      <div class="text-right my-5">

      </div>
    </div>
    <!-- /.card -->
  </div>
  @endif

</div>
</div>
<div class="modal fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Success Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
    <!-- /.modal -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Dịch vụ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-services" class="modal-body">
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
  </div>
</div>

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
      @media (min-width: 576px)
      {
      .modal-dialog {
          max-width: 800px;
          margin: 1.75rem auto;
      }

      }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @stop

    @section('js')
    <script>

      var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = new Date({{strtotime($bookRoom->thoi_gian_ket_thuc)}}).getTime() * 1000 - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        
        var clock = document.getElementById("clock");
        if(clock != null){

        clock.innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("clock").innerHTML = "Hết giờ";
          }
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

      /*===========================================
        AJAX -> thêm dịch vụ
      */

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");


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
      }

      let renderOrder = function(data){
          let listServices = document.querySelector('#listOrder tbody');
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

          body += '<tr> '



          listServices.innerHTML = body;
      }


      let listServices = document.querySelector('#listServices tbody');
      let btnAddService = document.querySelector('#add-service');
      let modalBody = document.querySelector('#modal-services > div');
      let nodeAfterAlert = document.querySelector('#before-alert');

      let alertAddService = document.createElement('div');
      alertAddService.className += 'alert alert-success alert-add-service';



      btnAddService.addEventListener('click', function() {
        
        let url = "{{url("/admin/room/add-service/$room->id")}}";
        
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


      /*===========================================
        AJAX -> Thanh toán
      */
       
       let btnCheckout = document.querySelector('#checkout');
       let roomPrice = document.querySelector('#roomPrice');
       let roomTotal = document.querySelector('#roomTotal');

      if(btnCheckout != null){

       btnCheckout.addEventListener('click', function(){

        let url = "{{url("/admin/room/checkout")}}";

        let data = {
          roomId: {{$room->id}}
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

            console.log(data);
            

            if(data.orderDetails.length > 0){
             renderOrder(data.orderDetails);
            }
            roomPrice.innerHTML = data.roomPrice;
            roomTotal.innerHTML = data.amount;
          
          })
          .catch((err) => {
            console.log(err);
          })

       })

      }



    </script>
    @stop