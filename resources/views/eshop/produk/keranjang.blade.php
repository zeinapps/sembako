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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="hpp" class="col-md-4 control-label">Dikirim ke:* </label>

                    <input id="hpp" type="text" class="form-control" name="alamat" value="{{ isset(Auth::user()->alamat) ? Auth::user()->alamat : old('alamat') }}" required>
                    @if ($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                    <p style="color: red;">*Ubah alamat pengiriman jika tidak sama dengan alamat Anda</p>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="total_area">

                    <ul>
                        <li>Sub Total <span>$59</span></li>
                        <li>Biaya Kirim <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    @if (!Auth::guest())
                    <button type="submit" class="btn btn-default check_out" >Kirim Pesanan</button>
                    @else
                    <div class="heading">
                        <h3>Anda Belum login?</h3>
                        <p>Pesanan hanya bisa dikirim setelah anda <a href="/login">login</a></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <hr>
    </div>
</section> <!--/#cart_items-->

@endsection