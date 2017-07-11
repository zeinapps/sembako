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
use App\Kesukaan;
use App\Barang;
use Validator;
use Auth;
use DB;

class AkunController extends Controller
{
    public function kesukaan(Request $request){
        $paginasi = config('app.paginasi_pencarian_produk');
        if(!$request->page){
            $rownum = 0;
        }else{
            $rownum = ($request->page - 1) * $paginasi;
        }
        $s = null;
       $userid = Auth::user()->id;
        DB::statement(DB::raw("set @rownum=$rownum"));
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->join('kesukaan', 'kesukaan.barang_id', '=', 'barang.id')
                ->select(DB::raw('@rownum := @rownum + 1 AS no'),'barang.id as id','barang.nama as nama','harga','keterangan',
                        'hargaonline','kategori_barang.nama as kategori','gambar',
                        DB::raw("(SELECT barang_id FROM kesukaan WHERE user_id = $userid AND barang_id = barang.id) as suka"))
                ->where('kesukaan.user_id',Auth::user()->id)
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('barang.nama' ,'like' , "%$request->s%");
            $querys = $querys->orWhere('kategori_barang.nama' ,'like' , "%$request->s%");
            $s = $request->s;
            $title = 'Hasil Pencarian "'.$request->s.'"';
        }else{
            $title = 'Favorit Saya';
        }
        $querys = $querys->paginate($paginasi);
        return view('eshop/akun/kesukaan', ['data' => $querys, 's' => $s, 'title' => $title,]);
    }
  
    public function show(){
        $user = Auth::user();
        return view('eshop/akun/show', $user);
    }
    
    public function ubahpwd(){
        $user = Auth::user();
        return view('eshop/akun/ubahpwd', $user);
    }
    
    public function storepwd(Request $request){
        
        $validator = Validator::make($request->all(), [
            'passwordlama' => 'required',
            'password' => 'required|confirmed|min:6',
        ],config('app.custom_error_message'));
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = Auth::user();
        if (Auth::attempt(['id' => $user->id, 'password' => $request->passwordlama])) {
            User::where('id', Auth::user()->id)
                    ->update([
                'password' => bcrypt($request->password),
            ]);
        }else{
            return redirect(url()->previous())
                ->withErrors(['Password Lama Salah']);
        }
        
        return redirect(url()->previous())
                ->with('status', ['Ubah Password Berhasil']);
        
    }
    
    public function store(Request $request){       
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
        ],config('app.custom_error_message'));
        
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
    
    public function suka(Request $request){       
        
        $barang_id = null;
        if(isset($request->data[0]['barang_id']) && $request->data[0]['barang_id']){
            $barang_id = $request->data[0]['barang_id'];
        }else{
            return response()->json([
                'status' => false,
                'message' => ['Maaf, Gagal mencatat kesukaan Anda']
            ]);
        }
        
        $user = $request->user();
        $query = Kesukaan::where('barang_id', $barang_id)
                ->where('user_id', $user->id)
                ->first();
        
        if(!$query){
            Kesukaan::create([
                'barang_id' => $barang_id,
                'user_id' => $user->id,
            ]);
        }
        
        User::where('id',$user->id)
                    ->update(['kesukaan'=>Kesukaan::where('user_id', $user->id)->count()]);
        return response()->json([
                'status' => true,
                'message' => ['Terima kasih telah menyukai produk kami, Silahkan melihat pada daftar kesukaan']
            ]);
    }
    
    public function tidaksuka(Request $request){       
        
        $barang_id = null;
        if(isset($request->data[0]['barang_id']) && $request->data[0]['barang_id']){
            $barang_id = $request->data[0]['barang_id'];
        }else{
            return response()->json([
                'status' => false,
                'message' => ['Maaf, Gagal menghapus kesukaan Anda']
            ]);
        }
        
        $user = $request->user();
       
        $query = Kesukaan::where('barang_id', $barang_id)
                ->where('user_id', $user->id)
                ->first();
        
        $query->delete();
        User::where('id',$user->id)
                    ->update(['kesukaan'=>Kesukaan::where('user_id', $user->id)->count()]);
        return response()->json([
                'status' => true,
                'message' => ['Terima kasih, anda telah pernah menyukai produk kami.']
            ]);
    }
    
}
