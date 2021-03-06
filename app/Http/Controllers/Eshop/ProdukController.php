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
        if($user = $request->user()){
            $userid = $user->id;
        }else{
            $userid = 0;
        }
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
                        'hargaonline','kategori_barang.nama as kategori','gambar',
                        DB::raw("(SELECT barang_id FROM kesukaan WHERE user_id = $userid AND barang_id = barang.id) as suka"))
                ->orderBy('id','desc');
        $querys = $querys->where('barang.display','=','1');
        if($request->s){
            $idsformtag = [];
            $q1 = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                    ->select('barang.id')
                    ->where('kategori_barang.nama', 'like', "%$request->s%")
                    ->orWhere('barang.nama', 'like', "%$request->s%");
            $q2 = Barang::join('tag_barang', 'tag_barang.barang_id', '=', 'barang.id')
                    ->select('barang.id')
                    ->join('tag', 'tag_barang.tag_id', '=', 'tag.id')
                    ->where('tag.nama', 'like', "%$request->s%")
                    ->union($q1)
                    ->get();
            foreach ($q2 as $v) {
                $idsformtag[] = $v->id;
            }
            $querys = $querys->whereIn('barang.id' ,$idsformtag);
            $s = $request->s;
            $title = 'Hasil Pencarian "'.$request->s.'"';
        }else{
            $title = 'Semua Produk';
        }
        $querys = $querys->paginate($paginasi);
        return view('eshop/produk/index', ['data' => $querys, 's' => $s, 'title' => $title]);
        }
    
    public function kategori(Request $request, $id){
        if($user = $request->user()){
            $userid = $user->id;
        }else{
            $userid = 0;
        }
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
                        'hargaonline','kategori_barang.nama as kategori','gambar',
                        DB::raw("(SELECT barang_id FROM kesukaan WHERE user_id = $userid AND barang_id = barang.id) as suka"))
                ->where('kategori_id',$id)
                ->orderBy('id','desc');
//        if($request->s){
//            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
//            $querys = $querys->orWhere('kategori_barang.nama' ,'like' , "%$request->s%");
//            $s = $request->s;
//        }
        $querys = $querys->where('barang.display','1');
        $querys = $querys->paginate($paginasi);
        if(isset($querys[0]->kategori)){
            $title = 'Kategori '.$querys[0]->kategori;
        }else{
            $title = "Not Found";
        }
        
        return view('eshop/produk/index', ['data' => $querys, 's' => $s, 'title' => $title]);
        }
    
    public function show(Request $request,$id){
        if($user = $request->user()){
            $userid = $user->id;
        }else{
            $userid = 0;
        }
        $query = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','harga','keterangan',
                        'hargaonline','kategori_barang.nama as kategori','gambar','barcode','kategori_id',
                        DB::raw("(SELECT barang_id FROM kesukaan WHERE user_id = $userid AND barang_id = barang.id) as suka"))
                ->where('barang.id' ,$id)
                ->where('barang.display' ,'1')->first();
        if(!$query){
            abort(404);
        }
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
