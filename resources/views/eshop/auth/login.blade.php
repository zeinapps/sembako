@extends('eshop.master')
@section('content')

<section id="form" style="margin-top: 10px;"><!--form-->
    <div class="container">
        <div class="row">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <div class="col-sm-4">
                <div class="login-form"><!--login form-->
                    <h2>Masuk ke akun saya</h2>
                    <form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <label>Hp/WA:</label>
                        <input type="text" placeholder="contoh: 08677777" name="hp" />
                        <label>Password:</label>
                        <input type="password" placeholder="Password" name="password"/>
                        <label>Ketik Kode ini: {!! captcha_img() !!}</label>
                        <input type="text" name="captcha"><br>
                        <button type="submit" class="btn btn-default">Masuk</button>
                        <input type="hidden" name="callback" value="{{ $callback }}" /><br>
                        Lupa Password? kirim permintaan reset password ke nomor WA <strong>{{Config::get('app.no_wa')}}</strong>
                        <h4 class="">Jika belum punya akun, silahkan <a href="/register?callback={{ $callback }}">mendaftar.</a></h4>
                    </form>
                </div><!--/login form-->
            </div>
            
        </div>
    </div>
</section><!--/form-->


@endsection