@extends('eshop.master')
@section('content')

<section id="form" style="margin-top: 0px;"><!--form-->
    <div class="container">
        <div class="row">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <div class="col-sm-4 col-sm-offset-1">
                <div class="signup-form"><!--sign up form-->
                    <h2>Pendaftaran pelanggan baru!</h2>
                    <form method="POST" action="{{ url('/register') }}">
                        <input type="hidden" name="callback" value="{{ $callback }}" />
                        {{ csrf_field() }}
                        <label>Nama:</label>
                        <input type="text" placeholder="Nama" name="name" value="{{ old('name') }}" required/>
                        <label>HP/WA:</label>
                        <input type="text" placeholder="Hp, contoh: 08677777" name="hp" value="{{ old('hp') }}" required/>
                        <label>Alamat:</label>
                        <input type="text" placeholder="Alamat domisili" name="alamat" value="{{ old('alamat') }}"  required/>
                        <label>Password:</label>
                        <input type="password" placeholder="Password" name="password" required/>
                        <label>Ketik Ulang Password:</label>
                        <input type="password"  name="password_confirmation" placeholder="Ketik Ulang Password" required />
                        <button type="submit" class="btn btn-default">Daftar</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection