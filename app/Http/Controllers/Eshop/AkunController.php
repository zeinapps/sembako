<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Eshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Penjualan;
use App\Penjualan_detil;
use Validator;
use Auth;

class AkunController extends Controller
{
    public function index(Request $request){
        
    }
    
    public function show(){
        $user = Auth::user();
        return view('eshop/akun/show', $user);
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user = User::where('id', Auth::user()->id)
                ->update([
            'alamat' => $request->alamat,
            'name' => $request->nama,
            'hp' => $request->hp,
        ]);
        
        return redirect(url()->previous())
                ->with('status', ['Ubah Data Berhasil']);
    }
}
