<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "chi_tiet_hoa_don";
    protected $fillable = ["so_luong","don_gia","thanh_tien","hoa_don_id","mat_hang_id"];

    public function order(){
        return $this->belongsTo('App\Models\Order','hoa_don_id');
    }
    public function store(){
        return $this->belongsTo('App\Models\Store','mat_hang_id');
    }
}
