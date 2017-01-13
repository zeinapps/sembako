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
use App\Kategoribarang;
use Validator;
use DB;
use Image;
use Storage;

class ProdukController extends Controller
{
    public function index(Request $request){
        $paginasi = config('app.paginasi_pencarian_produk');
        if(!$request->page){
            $rownum = 0;
        }else{
            $rownum = ($request->page - 1) * $paginasi;
        }
        $s = null;
        DB::statement(DB::raw("set @rownum=$rownum"));
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','harga','keterangan',
                        'hargaonline','kategori_barang.nama as kategori','gambar')
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
            $querys = $querys->orWhere('kategori_barang.nama' ,'like' , "%$request->s%");
            $s = $request->s;
            $title = 'Hasil Pencarian "'.$request->s.'"';
        }else{
            $title = 'Semua Produk';
        }
        $querys = $querys->paginate($paginasi);
        return view('eshop/produk/index', ['data' => $querys, 's' => $s, 'title' => $title]);
    }
    
    public function kategori(Request $request, $id){
        $paginasi = config('app.paginasi_produk');
        if(!$request->page){
            $rownum = 0;
        }else{
            $rownum = ($request->page - 1) * $paginasi;
        }
        $s = null;
        DB::statement(DB::raw("set @rownum=$rownum"));
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','harga','keterangan',
                        'hargaonline','kategori_barang.nama as kategori','gambar')
                ->where('kategori_id',$id)
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
            $querys = $querys->orWhere('kategori_barang.nama' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        $title = 'Kategori '.$querys[0]->kategori;
        return view('eshop/produk/index', ['data' => $querys, 's' => $s, 'title' => $title]);
    }
    
    public function show($id){
        $query = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','harga','keterangan',
                        'hargaonline','kategori_barang.nama as kategori','gambar','barcode','kategori_id')
                ->where('barang.id' ,$id)->first();
        
        $rekomended = Barang::whereNotIn('id',[$query->id])
//		->where('kategori_id',$query->kategori_id)
		->orderBy(DB::raw('RAND()'))
		->take(6)->get();
        
        $rekomended1 = [];
        $rekomended2 = [];
        $i = 0;
        foreach ($rekomended as $reko) {
            $i++;
            if($i <=3 ){
                $rekomended1[] = $reko;
            }else{
                $rekomended2[] = $reko;
            }
        }
//        dd($rekomended);
                $data = [
                    'rekomended1' => $rekomended1,
                    'rekomended2' => $rekomended2,
                    'produk' => $query,
                ];
        
        return view('eshop/produk/show', $data );
    }
    
    public function keranjang(){
        return view('eshop/produk/keranjang' );
    }
}
