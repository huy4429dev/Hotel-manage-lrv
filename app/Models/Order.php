<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "hoa_don";
    protected $fillable = ["trang_thai","tong_tien","khach_hang_id","user_id","phong_id"];
    
    public function room()
    {
        return $this->belongsTo('App\Models\Room','phong_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','phong_id');
    }

    public function orderDetail(){
        return $this->hasMany('App\Models\OrderDetail','hoa_don_id');
    }
}
