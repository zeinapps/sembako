@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a class="btn btn-info" href="{{ url('/user') }}">User</a>
                    <a class="btn btn-info" href="{{ url('/kategoribarang') }}">Kategori</a>
                    <a class="btn btn-info" href="{{ url('/barang') }}">Barang</a>
                    <a class="btn btn-info" href="{{ url('/penjualan') }}">Penjualan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
