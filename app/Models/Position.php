<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "vi_tri";
    protected $fillable = ["ten"];

    public function user()
    {
        return $this->hasMany('App\User','vi_tri_id');
    }
}
