<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Kategoribarang;
use Validator;
use DB;
use Image;
use Storage;

class BarangController extends Controller
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
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','hpp','harga',
                        'hargaonline','kategori_barang.nama as kategori','gambar')
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        return view('default/barang/index', ['data' => $querys, 's' => $s]);
    }
    
    public function add(){
        $Allkategori = Kategoribarang::select('id','nama')->where('parent_id','>', 0)->get();
        $kategori=[];
        foreach ($Allkategori as $value) {
            $i = $value->id;
            $kategori[$i] = $value->nama;
        }
        $selected_kategori = null;
        return view('default/barang/form', ['kategori' => $kategori, 'selected_kategori' => $selected_kategori ]);
    }
    
    public function edit($id){
        $Allkategori = Kategoribarang::select('id','nama')->where('parent_id','>', 0)->get();
        $kategori=[];
        foreach ($Allkategori as $value) {
            $i = $value->id;
            $kategori[$i] = $value->nama;
        }
        $selected_kategori = null;
        
        $query = Barang::find($id)->toArray();
        $selected_kategori = $query['kategori_id'];
        return view('default/barang/form', array_merge($query,['kategori' => $kategori, 'selected_kategori' => $selected_kategori ]));
//        return view('default/barang/form', array_merge($query, ['parent' => $parent,'selected_parent'=>$selected_parent]));
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'hpp' => 'required|numeric',
            'harga' => 'required|numeric',
            'hargaonline' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $urlgambar = [];
        if(($request->file('gambar'))){
            $im = $this->upload($request->file('gambar'), $request->nama);
            $urlgambar = [ 'gambar' => $im ];
        }else{
            $urlgambar = [ 'gambar' => 'no_image.png' ];
        }
        
        $params = [
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'hpp' => $request->hpp,
                'harga' => $request->harga,
                'hargaonline' => $request->hargaonline,
                'keterangan' => $request->keterangan,
            ];
        
        if(!$request->id){
            Barang::insert(array_merge($params,$urlgambar));
        }else{
            Barang::where('id',$request->id)
                    ->update(array_merge($params,$urlgambar));
        }
        return redirect('barang')->with('status', ['Sukses Tambah/Ubah Data']);
    }
    
    private function upload($file,$nama){
        $destination = storage_path().config('app.image_path_produk');
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(' ', '-', $nama).'_'.time().'.'.$extension;
        $image = Image::make($file);
        $width = $image->width();
        $height = $image->height();
        $x = $width;
        if($width > $height){
            $x = $height;
        }
        $image->crop($x, $x, 0, 0);
        $success_upload = null;
        foreach (config('app.resolusi_gambar') as $resolusi) {
            $image->resize($resolusi,$resolusi);
            $success_upload = $image->save($destination.'/'.$resolusi.'/'.$filename);
        }
        if($success_upload){
            return $filename;
        }else{
            return redirect(url()->previous())
                        ->withErrors('Gagal upload gambar')
                        ->withInput();
        }
    }
    
    public function destroy($id){
        try {
            Barang::find($id)->delete();
            return redirect('barang')->with('status', ['Sukses Hapus Data']);
        } catch (Exception $exc) {
            $error = [
                'Data tidak bisa di hapus'
            ];
            return redirect('barang')->withErrors($error);
        }
    }

}
