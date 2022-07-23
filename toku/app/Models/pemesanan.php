<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;

    protected $table = "pemesanan";

    function user(){
        return $this->hasOne(user::class, "id","id_customer");
    }
}
