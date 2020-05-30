<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookOnline extends Model
{
    protected $table = "book_onlines";
    protected $fillable = ["full_name","phone","email","thoi_gian_dat","ngay_dat","trang_thai","phong_id"];
 
}
