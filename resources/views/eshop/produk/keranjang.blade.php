@extends('eshop.master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 padding-right">
                @include('default.notifikasi.error')
                @include('default.notifikasi.success')
           
                
                <div id="not_features_items">
                    <h2 class="title text-center">Keranjang belanja</h2>
                    <ol class="breadcrumb">
                        <li><a href="/">Beranda</a></li>
                        <li class="active">Keranjang</li>
                    </ol>
                    Cara pembelian? <a href="/carapembelian"> <strong>Klik Disini</strong></a>

                    {!! Form::open(['url' => 'penjualan', 'method' => 'POST']) !!}
                    {{ Form::token() }}

                    <div class="row">
                        <div class="col-sm-12 row" >
                            <div class="features_items">
                                <div id="div_keranjang"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">  	
                        <div class="col-sm-12" id="total_keranjang">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                        <textarea id="area_keranjang" rows="4"></textarea>
                        <label>Copy dan kirim pesanan di atas pada no WA {{Config::get('app.no_wa')}}</label>
                        </div>
                    </div>
                    <hr>
<!--                    <div class="row">  	
                        <div class="col-sm-12">
                            <div class="contact-form">

                                <div class="form-group col-md-6">
                                    <label class="control-label">Nama</label>
                                    <input readonly=""  type="text" name="nama" class="form-control" required="required" placeholder="Nama" value="{{ isset(Auth::user()->name) ? Auth::user()->name : old('nama') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">HP/WA</label>
                                    <input readonly="" type="text" name="hp" class="form-control" required="required" placeholder="HP" value="{{ isset(Auth::user()->hp) ? Auth::user()->hp : old('hp') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Alamat Pengiriman</label>
                                    <input type="text" name="alamat" class="form-control" required="required" placeholder="Alamat pengiriman" value="{{ isset(Auth::user()->alamat) ? Auth::user()->alamat : old('alamat') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Keterangan</label>
                                    <textarea name="keterangan" id="pesan" class="form-control" rows="8" placeholder="Beri keterangan di sini"></textarea>
                                </div>                        
                                <div class="form-group col-md-12">
                                    @if (!Auth::guest())
                                    <button type="submit" class="btn btn-default check_out" >Kirim Pesanan</button>

                                    @else
                                    <div class="heading">
                                        <h3>Anda Belum login?</h3>
                                        <p>Pesanan hanya bisa dikirim setelah anda <a href="/login?callback=keranjang">login</a></p>
                                    </div>
                                    @endif
                                </div>
                                                    <div class="form-group col-md-12">
                                                        <p style="color: red;">*Wajib diisi, data pengiriman bisa diubah bila perlu</p>
                                                    </div>

                            </div>
                        </div>

                    </div>  -->

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection