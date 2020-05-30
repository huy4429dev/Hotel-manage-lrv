<?php

use App\Models\Room;
use App\User;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Page Routes
|--------------------------------------------------------------------------
|
|
*/


Route::get('/make-admin', function () {
  $admin = User::where('email', 'admin@gmail.com')->first();
  if ($admin == null) {
    User::create([
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'phone' => '094324322',
      'vi_tri_id' => 1,
      'password' => bcrypt('123456')
    ]);
    return 'Tao tai khoan admin thanh cong';
  } else {
    return 'Da co tai khoan admin';
  }
});


Route::get('/', 'Page\HomeController@index');

Route::post('/contact', 'Page\ContactController@contact');
Route::post('/book-room', 'Page\HomeController@bookRoom');






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

    /*
          Đặt phòng
    */
  
    Route::get('book', 'Admin\RoomController@listBook')->name('room.book.list');
    Route::get('book/{id}', 'Admin\RoomController@bookDetail')->name('room.book.detail');
    Route::post('book/{id}', 'Admin\RoomController@bookDetailUpdate')->name('room.book.update');
    /*
          Thanh toán
    */

    Route::post('/checkout', 'Admin\RoomController@checkOut');

    /*
           Danh sách phòng
    */

    Route::get('/', 'Admin\RoomController@index')->name('room.index');
    Route::get('/map', 'Admin\RoomController@getMap');

    /* 
            Cấu hình phòng
    */

    Route::get('/setting', 'Admin\RoomController@viewSetting');
    Route::post('/setting/create', 'Admin\RoomController@setting');
    Route::post('/setting/update', 'Admin\RoomController@configFloor');

    Route::get('/{id}', 'Admin\RoomController@show')->name('room.detail');

    /*
            Cập nhật room - Đặt phòng - Bảo trì 
    */

    Route::post('/{id}', 'Admin\RoomController@roomUpdate');

    /*
            Thêm dịch vụ
    */

    Route::post('/add-service/{id}', 'Admin\RoomController@addService');


    /*
            Chuyển phòng
    */

    Route::post('cp/replace-room', 'Admin\RoomController@ReplaceRoom')->name('room.replace');
  });


  /*========================================================
      Quản lý doanh thu
      ========================================================
  */


  Route::prefix('order')->group(function () {

    Route::get('/', 'Admin\OrderController@index')->name('admin.order.index');
    Route::get('/group', 'Admin\OrderController@group')->name('admin.order.group');
    Route::post('/group', 'Admin\OrderController@groupPost')->name('admin.order.group.post');
    Route::get('/{id}', 'Admin\OrderController@detail')->name('admin.order.detail');
    Route::get('/ex/export', 'Admin\OrderController@export')->name('admin.order.export');
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



Route::post('/export', 'ExportController@export')->name('export');


Route::get('query', function () {
   $rooms =  Room::select('*')->whereNotIn('book_price', [100,200])->get();
   
   return $rooms;
});
