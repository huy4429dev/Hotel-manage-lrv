<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $table = 'dich_vu';
    protected $fillable = ['so_luong','mat_hang_id','phong_id'];    

    public function room(){
            return $this->belongsTo('App\Models\Room','phong_id');
    }

    public function product(){

            return $this->belongsTo('App\Models\Store','mat_hang_id');
    }

 
}
