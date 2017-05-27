<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penjualan;
use App\Penjualan_detil;
use App\Barang;
use Validator;
use DB;
use Storage;

class PenjualanController extends Controller
{
    
    public function index(Request $request){
        $paginasi = config('app.paginasi');
        if(!$request->page){
            $rownum = 0;
        }else{
            $rownum = ($request->page - 1) * $paginasi;
        }
        $s = null;
        DB::statement(DB::raw("set @rownum=$rownum"));
        $querys = Penjualan::select('*')
                ->orderBy('status','asc');
        if($request->s){
            $querys = $querys->where('nama' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        return view('default/penjualan/index', ['data' => $querys, 's' => $s ]);
    }
    
    public function show($id){
        $querys = Penjualan_detil::join('penjualan', 'penjualan_id', '=', 'penjualan.id')
                ->join('barang', 'barang_id', '=', 'barang.id')
                ->select('penjualan.tanggal as tanggal','barang.nama as nama','penjualan_detil.harga_satuan as harga','penjualan_detil.jumlah as jumlah')
                ->where('penjualan_id',$id)
                ->paginate(config('app.paginasi'));
        $penjualan = Penjualan_detil::join('penjualan', 'penjualan_id', '=', 'penjualan.id')
                ->where('penjualan_id',$id)->selectRaw('SUM(jumlah*harga_satuan) as total, penjualan_id')
                ->selectRaw('status')->groupBy('status')->groupBy('penjualan_id')
                ->first();
        return view('default/penjualan/show', [
            'data' => $querys, 
            'total' => $penjualan->total, 
            'status'=> $penjualan->status,
            'penjualan_id'=> $penjualan->penjualan_id]);
    }
    
    public function status($id,Request $request){
       
        Penjualan::where('id',$id)
                    ->update([
                        'status' => $request->status,
                    ]);
        return redirect(url()->previous())->with('status', ['Sukses Ubah Data']);
    }
    
    public function store(Request $request){   
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $parent_id = null;
        $parent_nama = null;
        
        if($request->parent_id){
            $chek_parent = Penjualan::where('id', $request->parent_id)->where('parent_id','=', null)->first();
            $p = explode('|', $request->parent_id);
            $parent_id = $p[0];
            $parent_nama = $p[1];
            
            if(!$chek_parent){
                return redirect(url()->previous())
                        ->withErrors(["Kategori $parent_nama tidak bisa di jadikan parent"])
                        ->withInput();
            }
            
            
        }
        
        if(!$request->id){
            Penjualan::insert([
                'nama' => $request->nama,
                'parent_id' => $parent_id,
                'parent_nama' => $parent_nama,
            ]);
        }else{
            Penjualan::where('id',$request->id)
                    ->update([
                        'nama' => $request->nama,
                        'parent_id' => $parent_id,
                        'parent_nama' => $parent_nama,
                    ]);
            Penjualan::where('parent_id',$request->id)
                    ->update([
                        'parent_nama' => $request->nama,
                    ]);
        }
        
        $parent = Penjualan::select('id','nama')
                ->whereNull('parent_id')->get();
        
        $child = [];
        $kategori = [];
        foreach ($parent as $value) {
            $child = Penjualan::select('id','nama')
                ->where('parent_id',$value->id)->get()->toArray();
            $kategori [] = [
                'id' => $value->id,
                'nama' => $value->nama,
                'child' => $child,
            ];
        }
        Storage::put('json/kategori_barang.json', json_encode($kategori));
        
        
        return redirect('penjualan')->with('status', ['Sukses Tambah/Ubah Data']);
    }
    
    public function destroy($id){
        
        $barang = Barang::where('kategori_id',$id)->first();
        $error = [];
        if(!$barang){
            Penjualan::find($id)->delete();
            return redirect('penjualan')->with('status', ['Sukses Hapus Data']);
        }else{
            $error = [
                'Ada data barang masih terkait dengan kategori ini'
            ];
            return redirect('penjualan')->withErrors($error);
        }
        
    }

}
