@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <ol class="breadcrumb">
                <li><a href="/">Beranda</a></li>
                <li class="active">Akun</li>
            </ol>
                @include('default.notifikasi.error')
                @include('default.notifikasi.success')

                <div class="row">  	
                    <div class="col-sm-12">
                        <div class="contact-form">
                            <h2 class="title text-center">Informasi Akun</h2>
                            {!! Form::open(['url' => 'ubahakun', 'method' => 'POST']) !!}
                            {{ Form::token() }}
                            <div class="form-group col-md-6">
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
                            
                            <button type="submit" class="btn btn-default check_out" href="{{ url('/akunubah') }}">Ubah</button>
                            {!! Form::close() !!}
                            <hr>Ubahlah Password Anda secara berkala. klik 
                            <a class="btn btn-warning" href="{{ url('/akunubahpwd') }}">Ubah Password</a>

                        </div>
                    </div>

                </div>  

                <br>
            </div>
            @include('eshop.sidebar')
        </div>
    </div>
</section>
@endsection