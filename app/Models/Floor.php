<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = "tang";
    protected $fillable = ["so_phong","ten_tang"];
    public $timestamps = false;
}
