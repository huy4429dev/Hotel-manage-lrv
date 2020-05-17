{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Hồ sơ')

@section('content_header')
<h4>Hồ sơ</h4>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="https://p7.hiclipart.com/preview/312/283/679/avatar-computer-icons-user-profile-business-user-avatar.jpg" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{$user->name}}</h3>

          <p class="text-muted text-center">{{$user->position->ten}}</p>
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Châm ngôn</strong>

            <p class="text-muted">
              {{$user->cham_ngon}}
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i>Địa chỉ</strong>

            <p class="text-muted">{{$user->dia_chi}}</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Kĩ năng</strong>

            <p class="text-muted">

            </p>
            {{$user->ki_nang}}
            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Ghi chú</strong>

            <p class="text-muted">{{$user->ghi_chu}}
            </p>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-12 col-md-9">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Cập nhật thông tin</h3>
        </div>
        <div class="card-body">
          <!-- Color Picker -->
          <form action="{{url('admin/profile')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Họ tên:</label>
              <input type="text" class="form-control my-colorpicker1" value="{{$user->name}}" name="name">
            </div>
            <!-- /.form group -->

            <!-- Color Picker -->
            <div class="form-group">
              <label>Số điện thoại:</label>

              <div class="input-group my-colorpicker2">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="text" class="form-control" value="{{$user->phone}}" name="phone">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <label>Ngày sinh:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  @php
                  $date = new DateTime($user->ngay_sinh);
                  @endphp

                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" value="{{$date->format('d m yyyy')}}" name="ngay_sinh">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group">
              <label>Địa chỉ:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input type="text" class="form-control" value="{{$user->dia_chi}}" name="dia_chi">
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Kĩ năng:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <textarea class="form-control" rows="3" name="ki_nang">{{$user->ki_nang}}</textarea>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Ghi chú:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-file-alt mr-1"></i></span>
                </div>
                <textarea class="form-control" rows="3" name="ghi_chu">{{$user->ghi_chu}}</textarea>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Châm ngôn:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-file-alt mr-1"></i></span>
                </div>
                <input type="text" class="form-control" value="{{$user->cham_ngon}}" name="cham_ngon">
              </div>
              <!-- /.input group -->
            </div>
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </div>
      </div>
      </form>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/v3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()
</script>
@stop