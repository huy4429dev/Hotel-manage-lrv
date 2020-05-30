<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\BookOnline;
use App\Models\Post;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->take(6)->get();
        return view('home',['posts' => $posts,'typeRoom' => TypeRoom::all()]);   
    }
    public function bookRoom(Request $request){
        $validator = Validator::make($request->all(), [

			'fullname'      => 'required',
			'email'         => 'required',
			'phone'         => 'required',
			'thoi_gian_dat' => 'required',
			'ngay_dat'      => 'required',
   
		 ], [
			'fullname.required'      => 'Vui lòng nhập họ tên',
			'email.required'         => 'Vui lòng nhập email',
			'phone.required'         => 'Vui lòng nhập số điện thoại',
			'thoi_gian_dat.required' => 'Vui lòng chọn ngày đặt',
			'ngay_dat.required'      => 'Vui lòng chọn thời gian đật',
		 ]);
			
		
		 if ($validator->fails()) {
			return response()->json(['createdCustomerError' => $validator->errors()->all()], 404);
		 }
		 
         BookOnline::create([
			'full_name'     => $request->fullname,
			'email'         => $request->email,
			'phone'         => $request->phone,
			'ngay_dat'      => date('Y/m/d',strtotime($request->ngay_dat)),
			'thoi_gian_dat' => $request->thoi_gian_dat,
			'trang_thai'    => false,
			'loai_phong_id' => $request->loai_phong_id
		]); 

		return response()->json('createdCustomerSuccess');
    }
}
