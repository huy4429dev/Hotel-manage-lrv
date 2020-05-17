<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    protected $table = "loai_phong";
    protected $fillable = ["ten","gia_phong"];

    public function room()
    {
        return $this->hasMany('App\Models\Room','loai_phong_id');
    }
}
