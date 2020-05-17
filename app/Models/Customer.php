<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "khach_hang";
    protected $fillable = ["ho_ten","so_dien_thoai","so_cmnd","so_lan_dat_phong"];
    
    public function room(){
        return $this->belongsToMany('App\Models\Room','dat_phong','phong_id','khach_hang_id')->withPivot('ghi_chu')->withTimestamps();
    }

    public function order(){
        return $this->hasMany('App\Models\Order','khach_hang_id');
    }
}
