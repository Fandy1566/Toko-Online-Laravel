<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan_detail extends Model
{
    use HasFactory;

    protected $table = "pemesanan_detail";

    function produk(){
        return $this->hasOne(product::class, "id","id_produk");
    }
}
