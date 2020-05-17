<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "lien_he";
    protected $fillable =  ["ho_ten","chu_de","so_dien_thoai","noi_dung"];
}
