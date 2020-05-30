{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Lịch đặt phòng')

@section('content_header')
<h4>Lịch đặt phòng</h4>
@stop
@section('content')
<div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Họ tên</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Ngày đặt</th>
                      <th class="text-center">Thời gian đặt (giờ)</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!$list->isEmpty())
                    @foreach($list as $item)
                    <tr onclick="detail({{$item->id}})" style="cursor:pointer">
                      <td>{{$item->id}}</td>
                      <td>{{$item->full_name}}</td>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->email}}</td>
                      <td><span class="tag tag-success">{{$item->ngay_dat}}</span></td>
                      <td class="text-center">{{$item->thoi_gian_dat}}</td>
                      <td>{!!$item->trang_thai == 1 ? ' <span class="badge bg-success">đã xử lý</span>' : ' <span class="badge bg-warning">chưa xử lý</span>' !!}</td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@stop

@section('css')
@stop

@section('js')
    <script>
        function detail(id){
            window.location.href =  "{{url('admin/room/book/')}}" + '/' +id;
        }
    </script>
@stop