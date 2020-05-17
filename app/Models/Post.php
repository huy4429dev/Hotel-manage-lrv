<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "bai_viet";
    protected $fillable = ["tieu_de","hinh_anh","mo_ta","noi_dung","luot_xem","user_id"];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
