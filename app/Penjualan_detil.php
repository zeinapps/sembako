<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan_detil extends Model
{
    protected $table = 'penjualan_detil';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'penjualan_id', 'barang_id','jumlah','harga_satuan'
    ];

}
