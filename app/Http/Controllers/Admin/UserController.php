<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.user.profile', ["user" => $user]);
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'phone' => 'required',
                'ngay_sinh' => 'required',
                'dia_chi' => 'required',
            ],
            [
                'name.required' => 'Vui lòng cập nhật họ tên',
                'phone.required' => 'Vui lòng cập nhật số điện thoại',
                'ngay_sinh.required' => 'Vui lòng cập nhật ngày sinh',
                'dia_chi.required' => 'Vui lòng cập nhật đỉa chị',
            ]
        );

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->ngay_sinh = date('y/m/d',strtotime($request->ngay_sinh));
        $user->dia_chi = $request->dia_chi;
        $user->ki_nang = $request->ki_nang;
        $user->ghi_chu = $request->ghi_chu;
        $user->cham_ngon = $request->cham_ngon;
        $user->save();

        return back()->with('message', 'Cập nhật hồ sơ thành công');
    }
}