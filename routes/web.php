<?php

use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Page Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', function () {
  return view('index');
});






/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

Auth::routes();

Route::prefix('admin')->group(function () {


  Route::get('/dashboard', 'Admin\DashboardController@index');

  Route::get('/profile', 'Admin\UserController@index');
  Route::post('/profile', 'Admin\UserController@update');

  /*========================================================
      Quản lý phòng
      ========================================================
    */

  Route::prefix('room')->group(function () {
    Route::get('/', 'Admin\RoomController@index');
    Route::get('/map', 'Admin\RoomController@getMap');

    /* 
            Cấu hình phòng
    */

    Route::get('/setting', 'Admin\RoomController@viewSetting');
    Route::post('/setting/create', 'Admin\RoomController@setting');
    Route::post('/setting/update', 'Admin\RoomController@configFloor');

    Route::get('/{id}', 'Admin\RoomController@show');

    /*
            Cập nhật room - Đặt phòng - Bảo trì 
    */

    Route::post('/{id}', 'Admin\RoomController@roomUpdate');

    /*
            Thêm dịch vụ
    */

    Route::post('/add-service/{id}', 'Admin\RoomController@addService');
  });


  /*========================================================
      Quản lý tin tức 
      ========================================================
  */

  Route::prefix('post')->group(function () {

    Route::get('/', 'Admin\PostController@index')->name("admin.post.index");
    Route::get('/create', 'Admin\PostController@create')->name("admin.post.create");
    Route::post('/store', 'Admin\PostController@store')->name("admin.post.store");
    Route::get('/edit/{id}', 'Admin\PostController@edit')->name("admin.post.edit");
    Route::post('/update/{id}', 'Admin\PostController@update')->name("admin.post.update");
    Route::get('/delete/{id}', 'Admin\PostController@delete')->name("admin.post.delete");
  });

  /*========================================================
      Quản lý nhân viên 
      ========================================================
  */

  Route::prefix('staff')->group(function () {

    Route::get('/', 'Admin\StaffController@index')->name("admin.staff.index");
    Route::get('/create', 'Admin\StaffController@create')->name("admin.staff.create");
    Route::post('/store', 'Admin\StaffController@store')->name("admin.staff.store");
    Route::get('/edit/{id}', 'Admin\StaffController@edit')->name("admin.staff.edit");
    Route::post('/update/{id}', 'Admin\StaffController@update')->name("admin.staff.update");
    Route::get('/delete/{id}', 'Admin\StaffController@delete')->name("admin.staff.delete");
  });


  /*========================================================
      Quản lý khách hàng 
      ========================================================
  */

  Route::prefix('customer')->group(function () {

    Route::get('/', 'Admin\CustomerController@index')->name("admin.customer.index");
    Route::get('/detail/{id}', 'Admin\CustomerController@detail')->name("admin.customer.detail");
    Route::post('/update/{id}', 'Admin\CustomerController@update')->name("admin.customer.update");
    Route::get('/delete/{id}', 'Admin\CustomerController@delete')->name("admin.customer.delete");
  });




  /*========================================================
      Quản lý phản hồi 
      ========================================================
  */
  Route::prefix('contact')->group(function () {

    Route::get('/', 'Admin\ContactController@index')->name("admin.contact.index");
    Route::get('/detail/{id}', 'Admin\ContactController@detail')->name("admin.contact.detail");
    Route::get('/delete/{id}', 'Admin\ContactController@delete')->name("admin.contact.delete");
  });

  /*========================================================
      Upload  file  
      ========================================================
  */

  Route::post('/upload', 'Admin\UploadController@upload')->name('admin.upload');
});


Route::get('query', function () {


  $query = DB::select('select cua_hang.ten_mat_hang , cua_hang.don_gia as don_gia, sum(dich_vu.so_luong) as so_luong
                        from phong 
                        join dich_vu 
                        on dich_vu.phong_id = phong.id 
                        join cua_hang
                        on cua_hang.id = dich_vu.mat_hang_id
                        where phong.id = 3 and trang_thai = "full" or trang_thai = "fulltime" 
                        group by cua_hang.ten_mat_hang, cua_hang.don_gia
                      ');

  // $query = DB::table('phong')
  // ->where('phong.id', '=', 3)
  // ->where(function ($query) {
  //     $query->where('trang_thai', '=', 'full')
  //         ->orWhere('trang_thai', '=', 'fulltime');
  // })
  // ->join('dich_vu', 'phong.id', '=', 'dich_vu.phong_id')
  // ->join('cua_hang', 'dich_vu.mat_hang_id', '=', 'cua_hang.id')
  // ->groupBy('ten_mat_hang')
  // ->get('ten_mat_hang','so_luong','don_gia','thanh_tien');


  print_r($query);
});
