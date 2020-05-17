{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Chi tiết liên hệ')

@section('content_header')
<div class="d-flex justify-content-between">
    <h4># {{$contact->chu_de}}
    </h4>
    <p class="text-right my-0 py-0">
        <a href="{{route('admin.contact.index')}}" class="btn btn-secondary " style="width:40px; display:inline-block"><i class="fas fa-angle-left"></i></a>
    </p>
</div>
@stop
@section('content')
<div class="row">

    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="{{url('images/user_contact.webp')}}" alt="User Image">
                    <span class="username"><a href="#">{{$contact->ho_ten}}</a></span>
                    <span class="description">{{date('d - m - Y / h : m A', strtotime($contact->created_at))}}</span>
                    <span class="description mt-2"> <i class="fas fa-envelope mr-2"></i> {{ $contact->email }}</span>
                    <span class="description mt-2"><i class="fas fa-phone-alt mr-2"></i> {{ $contact->so_dien_thoai }}</span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {!! $contact->noi_dung !!}

            </div>
            <!-- /.card-body -->
            <div class="card-footer card-comments">
                <div class="card-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="{{url('images/user_1.jpg')}}" alt="User Image">

                    <div class="comment-text">
                        <span class="username">
                            Maria Gonzales
                            <span class="text-muted float-right">8:03 PM Today</span>
                        </span><!-- /.username -->
                        Gửi lại phản hồi
                    </div>
                    <!-- /.comment-text -->
                </div>
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
                <form action="#" method="post">
                    <img class="img-fluid img-circle img-sm" src="{{url('images/user_1.jpg')}}" alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                        <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                    </div>
                </form>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop