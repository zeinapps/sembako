@extends('eshop.master')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Masuk ke akun saya</h2>
                    <form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="HP contoh: 08677777" name="hp" />
                        <input type="password" placeholder="Password" name="password"/>
                        
                        <button type="submit" class="btn btn-default">Masuk</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">ATAU</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Pendaftaran pelanggan baru!</h2>
                    <form method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="Nama" name="name" value="{{ old('name') }}" required/>
                        <input type="text" placeholder="Hp, contoh: 08677777" name="hp" value="{{ old('hp') }}" required/>
                        <input type="text" placeholder="Alamat domisili" name="alamat" value="{{ old('alamat') }}"  required/>
                        <input type="password" placeholder="Password" name="password" required/>
                        <input type="password"  name="password_confirmation" placeholder="Ketik Ulang Password" required />
                        <button type="submit" class="btn btn-default">Daftar</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection