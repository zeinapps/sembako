<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use App\Tag_barang;
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
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.display as display','barang.id as id','barang.nama as nama','hpp','harga',
                        'hargaonline','kategori_barang.nama as kategori','gambar')
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        
        $response = ['status' => true, 's' => $s, 'total'=>$querys->total(),'data' => $querys, ];
                
        if($request->api){
            return response()->json($response);
        }
        return view('default/barang/index', $response);
    }
    
    public function add(Request $request){
        $Allkategori = Kategoribarang::select('id','nama')->where('parent_id','>', 0)->get();
        $kategori=[];
        $kat = [];
        foreach ($Allkategori as $value) {
            $i = $value->id;
            $kategori[] = [
                'id' => $i, 'nama'=> $value->nama];
            $kat[$i] = $value->nama;
        }
        $display = [0,1];
         $selected_display = null;
        $selected_kategori = null;
        $response = [
            'selected_display' => $selected_display ,
            'display' => $display,
            'kategori' => $kategori, 
            'selected_kategori' => $selected_kategori ];
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => $response,
            ]);
        }
        $response['kategori'] = $kat;
        return view('default/barang/form', $response);
    }
    
    public function edit($id,Request $request){
        $Allkategori = Kategoribarang::select('id','nama')->where('parent_id','>', 0)->get();
        $kategori=[];
        foreach ($Allkategori as $value) {
            $i = $value->id;
            $kategori[$i] = $value->nama;
        }
        $selected_kategori = null;
        $selected_display = null;
        $display = [0,1];
        $query = Barang::find($id)->toArray();
        $selected_kategori = $query['kategori_id'];
        $selected_display = $query['display'];
        
        
        $tag= Tag_barang::join('tag','tag_barang.tag_id','=','tag.id')
                ->select('tag.nama')
                ->where('barang_id',$id)->get();
        $tags = [];
        foreach ($tag as $value) {
            $tags[] = $value->nama;
        }
        $query['tag'] = implode(',', $tags);
        $response =  [
            'kategori' => $kategori, 
            'selected_kategori' => $selected_kategori, 
            'selected_display' => $selected_display ,
            'display' => $display
                ];
        if($request->api){
            return response()->json([
                'status' => true,
                'data' => $response,
            ]);
        }
        return view('default/barang/form', array_merge($query,$response));
//        return view('default/barang/form', array_merge($query, ['parent' => $parent,'selected_parent'=>$selected_parent]));
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'hpp' => 'required|numeric',
            'harga' => 'required|numeric',
            'hargaonline' => 'required|numeric'
        ],config('app.custom_error_message'));
        
        if ($validator->fails()) {
            if($request->api){
                return response()->json([
                    'status' => true,
                    'message' => $validator->errors()->first(),
                ]);
            }
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
                'barcode' => $request->barcode,
                'keterangan' => $request->keterangan,
                'display' => $request->display,
            ];
        
        $barang_id = 0;
        if(!$request->id){
            $barang_id = Barang::create(array_merge($params,$urlgambar))->id;
        }else{
            if($urlgambar['gambar'] != 'no_image.png'){
                $params = array_merge($params,$urlgambar);
            }
            Barang::where('id',$request->id)
                    ->update($params);
            $barang_id = $request->id;
        }
        $tags = explode(',', substr($request->tag, 0, strlen($request->tag)-1));
        Tag_barang::where('barang_id',$barang_id)->delete();
        foreach ($tags as $value) {
            if($tt = trim($value)){
                $tag = Tag::updateOrCreate(['nama' => $tt]);
                Tag_barang::updateOrCreate(['barang_id' => $barang_id, 'tag_id' => $tag->id]);
            }
        }
        if($request->api){
            return response()->json([
                'status' => true,
                'message' => '',
            ]);
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
            $watermark = Image::make(storage_path().'/app/public/images/watermark_hitam.png');
            $perbandingan = (0.8)*$resolusi/$watermark->width();
            $width_watermark = $perbandingan*$watermark->width();
            $height_watermark = $perbandingan*$watermark->height();
            $watermark->resize($width_watermark,$height_watermark);
            $image->insert($watermark, 'center');
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
    
    public function destroy($id,Request $request){
        try {
            Tag_barang::where('barang_id', $id)->delete();
            Barang::find($id)->delete();
            if($request->api){
                return response()->json([
                    'status' => true,
                    'message' => 'berhasil delete',
                ]);
            }
            return redirect('barang')->with('status', ['Sukses Hapus Data']);
        } catch (Exception $exc) {
            $error = [
                'Data tidak bisa di hapus'
            ];
            if($request->api){
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal delete' ,
                ]);
            }
            return redirect('barang')->withErrors($error);
        }
    }
    
    public function sync(Request $request,$updated_at){
        if(!$request->api){
            abort(404);
        }
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select('barang.display as display','barang.id as id','barang.nama as nama','hpp','harga',
                        'hargaonline','kategori_barang.nama as kategori','gambar','keterangan','stok','kategori_id')
                ->orderBy('id','desc')
        ->where('barang.updated_at','>',$updated_at)
        ->get();
        
        $response = ['status' => true,'data' => $querys ];
        return response()->json($response);        
        
    }

}
