<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'user_id', 'tanggal','alamat','status'
    ];

}
