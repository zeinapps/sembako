@extends('layouts.app')
@section('content')
<div class="row">

    <div class="panel panel-default">
        <div class="panel-heading">Form</div>

        <div class="panel-body">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            {!! Form::open(['url' => 'user', 'method' => 'POST','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data']) !!}
            {{ Form::token() }}
            <input type="hidden" name="id" value="{{ isset($id) ? $id : old('id') }}">
            <div class="form-group">
                <label for="nama" class="col-md-4 control-label">Nama:</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ isset($name) ? $name : old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="hp" class="col-md-4 control-label">HP:</label>
                <div class="col-md-6">
                    <input id="hp" type="text" class="form-control" name="hp" value="{{ isset($hp) ? $hp : old('hp') }}" required>
                    @if ($errors->has('hp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hp') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-md-4 control-label">Alamat:</label>
                <div class="col-md-6">
                    <input id="alamat" type="text" class="form-control" name="alamat" value="{{ isset($alamat) ? $alamat : old('alamat') }}" required>
                    @if ($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="api_token" class="col-md-4 control-label">Token:</label>
                <div class="col-md-6">
                    <input id="api_token" type="text" class="form-control" name="api_token" value="{{ isset($api_token) ? $api_token : old('api_token') }}" required>
                    @if ($errors->has('api_token'))
                    <span class="help-block">
                        <strong>{{ $errors->first('api_token') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password:</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control" name="password" value="{{ isset($password) ? $password : old('password') }}"  autofocus>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a class="btn btn-default" href="{{ url('/user') }}">
                        Kembali
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    document.getElementById("gambar").onchange = function () {
        document.getElementById("gambar2").value = this.value;
    };
</script>

@endsection