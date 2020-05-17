<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigRoom extends Model
{
    protected $table = "cau_hinh_phong";
    protected $fillable = ["so_phong","ma_phong","so_tang"];
}
