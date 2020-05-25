<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request){
        Contact::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'chu_de' => $request->chu_de,
            'noi_dung' => $request->noi_dung,
            "trang_thai" => 0
        ]); 
        return response()->json($request->all());
    }
}
