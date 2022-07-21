<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";

    function user(){
        return $this->hasOne(user::class, "id","id_customer");
    }
}
