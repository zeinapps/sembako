@extends('layouts.app')
@section('content')
<div class="row">

    <div class="panel panel-default">
        <div class="panel-heading">Form</div>

        <div class="panel-body">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            {!! Form::open(['url' => 'kategoribarang', 'method' => 'POST','class'=>'form-horizontal']) !!}
            {{ Form::token() }}
            <input type="hidden" name="id" value="{{ isset($id) ? $id : old('id') }}">
            <div class="form-group">
                <label for="nama" class="col-md-4 control-label">Nama:</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control" name="nama" value="{{ isset($nama) ? $nama : old('nama') }}" required autofocus>
                    @if ($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="parent" class="col-md-4 control-label">Parent</label>
                <div class="col-md-6">
                    {{ Form::select('parent_id', $parent, $selected_parent , ['placeholder' => 'No Parent','class'=> 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a class="btn btn-default" href="{{ url('/kategoribarang') }}">
                        Kembali
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection