@extends('layouts.app')
@section('content')
<div class="row">

    <div class="panel panel-default">
        <div class="panel-heading">Form</div>

        <div class="panel-body">
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            {!! Form::open(['url' => 'barang', 'method' => 'POST','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data']) !!}
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
                <label for="display" class="col-md-4 control-label">Display</label>
                <div class="col-md-6">
                    {{ Form::select('display', $display, $selected_display, ['class'=> 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-4 control-label">Kategori</label>
                <div class="col-md-6">
                    {{ Form::select('kategori_id', $kategori, $selected_kategori, ['class'=> 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label for="hpp" class="col-md-4 control-label">HPP:</label>
                <div class="col-md-6">
                    <input id="hpp" type="text" class="form-control" name="hpp" value="{{ isset($hpp) ? $hpp : old('hpp') }}" required>
                    @if ($errors->has('hpp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hpp') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="harga" class="col-md-4 control-label">Harga:</label>
                <div class="col-md-6">
                    <input id="harga" type="text" class="form-control" name="harga" value="{{ isset($harga) ? $harga : old('harga') }}" required>
                    @if ($errors->has('harga'))
                    <span class="help-block">
                        <strong>{{ $errors->first('harga') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="hargaonline" class="col-md-4 control-label">Harga Online:</label>
                <div class="col-md-6">
                    <input id="hargaonline" type="text" class="form-control" name="hargaonline" value="{{ isset($hargaonline) ? $hargaonline : old('hargaonline') }}" required>
                    @if ($errors->has('hargaonline'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hargaonline') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="barcode" class="col-md-4 control-label">Barcode:</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control" name="barcode" value="{{ isset($barcode) ? $barcode : old('barcode') }}"  autofocus>
                    @if ($errors->has('barcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('barcode') }}</strong>
                    </span>
                    @endif
                </div>
            </div>  
            <div class="form-group">
                <label for="keterangan" class="col-md-4 control-label">Keterangan:</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control" name="keterangan" value="{{ isset($keterangan) ? $keterangan : old('keterangan') }}"  autofocus>
                    @if ($errors->has('keterangan'))
                    <span class="help-block">
                        <strong>{{ $errors->first('keterangan') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="tag" class="col-md-4 control-label">Tag:</label>
                <div class="col-md-6">
                    <div id="tag_span"> </div>
                    <div class="input-group">
                        <input class="form-control" placeholder="tambah tag" id="input_tag">
                        <div class="input-group-btn">
                            <button id="tambah_tag"type="button" class="btn btn-success"><i class="fa fa-plus"></i>+</button>
                        </div>
                    </div>
                    <input id="tag" name="tag" type="hidden" class="form-control" name="tag" value="{{ isset($tag) ? $tag : old('tag') }}" >
                    @if ($errors->has('tag'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tag') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="gambar" class="col-md-4 control-label">Gambar:</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Browse… <input style="display: none" type="file" name="gambar" id = "gambar" >
                            </span>
                        </label>
                        <input class="form-control"  type="text" id = "gambar2" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a class="btn btn-default" href="{{ url('/barang') }}">
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