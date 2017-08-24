<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'kategori_id', 'nama','deskripsi','hpp','harga','hargaonline',
        'barcode','gambar','gambar1','gambar2','display','ispromo','ribbon'
    ];

    }
