<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Eshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Penjualan;
use App\Penjualan_detil;
use Validator;
use Auth;

class PenjualanController extends Controller
{
    public function index(Request $request){
        $paginasi = config('app.paginasi');
        $title = "Transaksi Saya";
        $s = "";
        $status = null;
        $querys = Penjualan::where('user_id',Auth::user()->id)
                ->orderBy('created_at','desc');
        
        if($request->status){
            $querys = $querys->where('status' ,$request->status);
            $status = $request->status;
        }
        $querys = $querys->paginate($paginasi);
        return view('eshop/transaksi/index', ['data' => $querys, 's' => $s, 'title' => $title,'status' => $status]);
    }
    
    public function show($id){
        $title = "Detil Transaksi";
        $querys = Penjualan_detil::join('penjualan', 'penjualan_id', '=', 'penjualan.id')
                ->join('barang', 'barang_id', '=', 'barang.id')
                ->select('penjualan.tanggal as tanggal','barang.nama as nama','penjualan_detil.harga_satuan as harga','penjualan_detil.jumlah as jumlah')
                ->where('penjualan_id',$id)
                ->paginate(config('app.paginasi'));
        $total = Penjualan_detil::where('penjualan_id',$id)->selectRaw('SUM(jumlah*harga_satuan) as total')->first();
        return view('eshop/transaksi/show', ['data' => $querys, 'title' => $title, 'total' => $total->total]);
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jumlah' => 'required',
            'alamat' => 'required',
            'harga_satuan' => 'required',
        ],[
                'required' => 'Anda belum menentukan produk ',
            ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $ids = $request->id;
        $jumlahs = $request->jumlah;
        $harga_satuan = $request->harga_satuan;
        
        $user = Auth::user();
        
        $penjualan = Penjualan::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ]);
        foreach ($ids as $key => $value) {
            Penjualan_detil::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $value,
                'jumlah' => $jumlahs[$key],
                'harga_satuan' => $harga_satuan[$key],
            ]);
        }
        
        return redirect(url()->previous())
                ->with('status', ['Pesanan Anda telah terkirim.'])
                ->with('deletecokies', [true]);
    }
}
