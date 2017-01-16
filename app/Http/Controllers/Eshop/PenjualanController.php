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
        
    }
    
    public function show($id){
        
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jumlah' => 'required',
            'alamat' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $ids = $request->id;
        $jumlahs = $request->jumlah;
        
        $user = Auth::user();
        
        $penjualan = Penjualan::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
        ]);
        foreach ($ids as $key => $value) {
            Penjualan_detil::insert([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $value,
                'jumlah' => $jumlahs[$key],
            ]);
        }
        
        return redirect(url()->previous())
                ->with('status', ['Pesanan Anda telah terkirim.'])
                ->with('deletecokies', [true]);
    }
}
