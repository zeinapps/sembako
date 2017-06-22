<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_barang extends Model
{
    protected $table = 'tag_barang';
    protected $fillable = [
        'barang_id', 'tag_id'
    ];

}
