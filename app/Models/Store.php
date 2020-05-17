<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "cua_hang";
    protected $fillable = ["ten_mat_hang","mo_ta","so_luong","don_gia"];

    public function orderDetail(){
        return $this->hasMany('App\Models\OrderDetail','mat_hang_id');
    }
}
