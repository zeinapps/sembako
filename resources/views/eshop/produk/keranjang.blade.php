@extends('eshop.master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Beranda</a></li>
                <li class="active">Keranjang</li>
            </ol>
        </div>
        @include('default.notifikasi.error')
        @include('default.notifikasi.success')
        {!! Form::open(['url' => 'penjualan', 'method' => 'POST']) !!}
        {{ Form::token() }}
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="tbody_keranjang">

                </tbody>
            </table>
        </div>
        <div class="row">  	
            <div class="col-sm-12">
                <div class="contact-form">
                    <h2 class="text-center">Cara pembelian <a href="/carapembelian">disini</a></h2><hr>
<!--                    <div class="form-group col-md-6">
                        <label class="control-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required="required" placeholder="Nama" value="{{ isset(Auth::user()->name) ? Auth::user()->name : old('nama') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">HP/WA</label>
                        <input type="text" name="hp" class="form-control" required="required" placeholder="HP" value="{{ isset(Auth::user()->hp) ? Auth::user()->hp : old('hp') }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required="required" placeholder="Subject" value="{{ isset(Auth::user()->alamat) ? Auth::user()->alamat : old('alamat') }}">
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
                    </div>-->
                    
                </div>
            </div>

        </div>  

        {!! Form::close() !!}
    </div>
</section> <!--/#cart_items-->

@endsection