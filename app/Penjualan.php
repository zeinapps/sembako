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
        $keterangan = config('app.status_penjualan')[$value];
        if($value == 1){
            $span = '<span class="label label-danger">'.$keterangan.'</span>';
        }else if($value == 2){
            $span = '<span class="label label-warning">'.$keterangan.'</span>';
        }elseif($value == 3){
            $span = '<span class="label label-success">'.$keterangan.'</span>';
        }elseif($value == 99){
            $span = '<span class="label label-default">'.$keterangan.'</span>';
        }
        
        return $span;
    }

}
