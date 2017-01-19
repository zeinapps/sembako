<?php

namespace App\Http\Controllers\Eshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Barang;


class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($user = $request->user()){
            $userid = $user->id;
        }else{
            $userid = 0;
        }
        $paginasi = config('app.paginasi_produk');
        $querys = Barang::join('kategori_barang', 'kategori_id', '=', 'kategori_barang.id')
                ->select('barang.id as id','barang.nama as nama','harga',
                        'hargaonline','kategori_barang.nama as kategori','gambar',
                        DB::raw("(SELECT barang_id FROM kesukaan WHERE user_id = $userid AND barang_id = barang.id) as suka"))
                ->orderBy(DB::raw('RAND()'))
                ->take($paginasi)->get();
        
        $rekomended = Barang::orderBy(DB::raw('RAND()'))
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
        
        $sliders = Barang::select('*')
                ->orderBy(DB::raw('RAND()'))
		->take(4)->get();
        
        $slider = [];
        $n0 = 0;
        foreach ($sliders as $va) {
            $n0++;
            $va->no = $n0;
            $slider[] =  $va;
        }
        
        $data = [
            'slider' => $slider,
            'rekomended1' => $rekomended1,
            'rekomended2' => $rekomended2,
            'data' => $querys,
            'title' => 'Produk Pilihan'
        ];
        
        return view('eshop/index', $data);
    }
}
