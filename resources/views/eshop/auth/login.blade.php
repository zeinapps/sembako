@extends('eshop.master')
@section('content')

<section id="form" style="margin-top: 30px;"><!--form-->
    <div class="container">
        <div class="row">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <div class="col-sm-4">
                <div class="login-form"><!--login form-->
                    <h2>Masuk ke akun saya</h2>
                    <form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="HP contoh: 08677777" name="hp" />
                        <input type="password" placeholder="Password" name="password"/>
                        <button type="submit" class="btn btn-default">Masuk</button>
                        
                            <h2 class="">ATAU</h2>
                        <a href="/register" class="btn btn-info">Daftar</a>
                    </form>
                </div><!--/login form-->
            </div>
            
        </div>
    </div>
</section><!--/form-->


@endsection