<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kesukaan extends Model
{
    protected $table = 'kesukaan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'user_id','barang_id'
    ];
    public $timestamps = false;
}
