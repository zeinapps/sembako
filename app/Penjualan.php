<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'user_id', 'tanggal','alamat','status','keterangan'
    ];
    
    public function getTanggalAttribute($value)
    {
        $time = strtotime($value);
        return date('d-m-Y',$time);
    }
    
    public function getStatusAttribute($value)
    {
        return config('app.status_penjualan')[$value];
    }

}
