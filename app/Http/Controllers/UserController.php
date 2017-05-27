<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Barang;
use Validator;
use DB;
use Storage;

class UserController extends Controller
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
        $querys = User::select('id','hp','name','alamat','api_token','kesukaan')
                ->orderBy('id','desc');
        if($request->s){
            $querys = $querys->where('name' ,'like' , "%$request->s%");
            $querys = $querys->orWhere('hp' ,'like' , "%$request->s%");
            $querys = $querys->orWhere('alamat' ,'like' , "%$request->s%");
            $s = $request->s;
        }
        $querys = $querys->paginate($paginasi);
        return view('default/user/index', ['data' => $querys, 's' => $s ]);
    }
    
    public function add(){
        return view('default/user/form', []);
    }
    
    public function edit($id){
        $query = User::find($id)->toArray();
        
        return view('default/user/form', array_merge($query, []));
    }
    
    public function store(Request $request){   
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alamat' => 'required',
            'hp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if(!$request->id){
            if(!$request->password){
                return redirect(url()->previous())
                        ->withErrors("password belum di isi")
                        ->withInput();
            }
            User::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'password' => bcrypt($request->password),
            ]);
        }else{
            User::where('id',$request->id)
                    ->update([
                        'name' => $request->name,
                        'alamat' => $request->alamat,
                        'hp' => $request->hp,
                    ]);
        }
        
        return redirect('user')->with('status', ['Sukses Tambah/Ubah Data']);
    }
    public function resetform($id){   
        $query = User::find($id)->toArray();
        return view('default/user/reset',$query);
    }
    public function reset(Request $request){   
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        User::where('id',$request->id)
                ->update([
                    'password' => bcrypt($request->password),
                ]);
        
        
        return redirect('user')->with('status', ['Sukses Tambah/Ubah Data']);
    }
    
    public function destroy($id){
        abort(404);
//        User::find($id)->delete();
//        return redirect('user')->with('status', ['Sukses Hapus Data']);
        
        
    }

}
