<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_detail extends Model
{
    use HasFactory;

    protected $table = "transaksi_detail";

    function produk(){
        return $this->hasOne(product::class, "id","id_produk");
    }
}
