<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategoribarang;
use App\Barang;
use Validator;
use DB;
use Storage;

class KategoribarangController extends Controller
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
        $querys = Kategoribarang::select('id','nama','parent_id','parent_nama',DB::raw('@rownum := @rownum + 1 AS no'))
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('nama' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        $response = ['data' => $querys, 's' => $s ];
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => $response,
            ]);
        }
        
        return view('default/kategoribarang/index', $response);
    }
    
    public function add(Request $request){
        $query = Kategoribarang::select('id','nama')->where('parent_id','=', null)->get();
        $parent = [];
        foreach ($query as $value) {
            $parent[$value->id.'|'.$value->nama] = $value->nama;
        }
        $selected_parent = null;
        
        $response = ['parent' => $parent, 'selected_parent' => $selected_parent];
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => $response,
            ]);
        }
        
        return view('default/kategoribarang/form', $response);
    }
    
    public function edit($id,Request $request){
        $selected_parent = null;
        $query = Kategoribarang::find($id)->toArray();
        
        $Allkategori = Kategoribarang::select('id','nama')->whereNotIn('id',[$id])->where('parent_id','=', null)->get();
        $parent = [];
        foreach ($Allkategori as $value) {
            $i = $value->id.'|'.$value->nama;
            if($value->id == $query['parent_id']){
                $selected_parent = $i;
            }
            $parent[$i] = $value->nama;
        }
        $response = array_merge($query, ['parent' => $parent,'selected_parent'=>$selected_parent]);
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => $response,
            ]);
        }
        
        return view('default/kategoribarang/form', $response);
    }
    
    public function store(Request $request){   
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50'
        ],config('app.custom_error_message'));

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $parent_id = null;
        $parent_nama = null;
        
        if($request->parent_id){
            $chek_parent = Kategoribarang::where('id', $request->parent_id)->where('parent_id','=', null)->first();
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
            Kategoribarang::insert([
                'nama' => $request->nama,
                'parent_id' => $parent_id,
                'parent_nama' => $parent_nama,
            ]);
        }else{
            Kategoribarang::where('id',$request->id)
                    ->update([
                        'nama' => $request->nama,
                        'parent_id' => $parent_id,
                        'parent_nama' => $parent_nama,
                    ]);
            Kategoribarang::where('parent_id',$request->id)
                    ->update([
                        'parent_nama' => $request->nama,
                    ]);
        }
        
        $parent = Kategoribarang::select('id','nama')
                ->whereNull('parent_id')->get();
        
        $child = [];
        $kategori = [];
        foreach ($parent as $value) {
            $child = Kategoribarang::select('id','nama')
                ->where('parent_id',$value->id)->get()->toArray();
            $kategori [] = [
                'id' => $value->id,
                'nama' => $value->nama,
                'child' => $child,
            ];
        }
        Storage::put('json/kategori_barang.json', json_encode($kategori));
        
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => null,
            ]);
        }
        return redirect('kategoribarang')->with('status', ['Sukses Tambah/Ubah Data']);
    }
    
    public function destroy($id,Request $request){
        
        $barang = Barang::where('kategori_id',$id)->first();
        $error = [];
        if(!$barang){
            Kategoribarang::find($id)->delete();
            if($request->api){
            return response()->json([
                    'status' => true,
                    'message' => 'Sukses',
                ]);
            }
            return redirect('kategoribarang')->with('status', ['Sukses Hapus Data']);
        }else{
            $error = [
                'Ada data barang masih terkait dengan kategori ini'
            ];
            if($request->api){
            return response()->json([
                    'status' => false,
                    'message' => 'Gagal',
                ]);
            }
            return redirect('kategoribarang')->withErrors($error);
        }
        
    }

}
