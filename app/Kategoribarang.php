<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategoribarang extends Model
{
    protected $table = 'kategori_barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'nama','parent_id'
    ];

}
