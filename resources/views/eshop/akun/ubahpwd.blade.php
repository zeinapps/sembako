@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">

                @include('default.notifikasi.error')
                @include('default.notifikasi.success')
                <div class="features_items" id="features_items">

                </div>
                <div id="not_features_items">
                    <div class="row">  	
                        <div class="col-sm-12">
                            <div class="contact-form">
                                <h2 class="title text-center">Ubah Password</h2>
                                <ol class="breadcrumb">
                                    <li><a href="/">Beranda</a></li>
                                    <li><a href="/akun">Akun</a></li>
                                    <li class="active">Ubah Password</li>
                                </ol>
                                {!! Form::open(['url' => 'ubahpwd', 'method' => 'POST']) !!}
                                {{ Form::token() }}
                                <div class="form-group col-md-12">
                                    <label class="control-label">Password Lama</label>
                                    <input type="password" name="passwordlama" class="form-control" required="required" placeholder="Password Lama" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Password Baru</label>
                                    <input type="password" name="password" class="form-control" required="required" placeholder="Password Baru" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Ketik Ulang Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="Password Baru" value="">
                                </div>

                                <button type="submit" class="btn btn-default check_out" href="{{ url('/ubahpwd') }}">Ubah</button>
                                {!! Form::close() !!}

                            </div>
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