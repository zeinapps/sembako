@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>Barang</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <a href="{{ url('/formbarang') }}" class="btn btn-info" role="button" style="float: left;margin-right: 5px;">Data Baru</a>
            <form action="{{ url('/barang') }}" method="GET">
                <div class="input-group col-md-6">
                    <input name="s" class="search-query form-control" placeholder="Kata kunci ==> Enter" type="text" value="{{ $s ? $s : '' }}">
                </div>
                
            </form>
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Display</th>
                        <th>HPP</th>
                        <th>Harga</th>
                        <th>Harga Online</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                    <tr>
                        <td>
                            {{ $v->no }}
                        </td>
                        <td>
                            <img src="{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}" width="50" height="50"/>
                        </td>
                        <td>
                            {{ $v->nama }}
                        </td>
                        <td>
                            {{ $v->kategori }}
                        </td>
                        <td>
                            {{ $v->display }}
                        </td>
                        <td>
                            {{ $v->hpp }}
                        </td>
                        <td>
                            {{ $v->harga }}
                        </td>
                        <td>
                            {{ $v->hargaonline }}
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ url('/formbarang/'.$v->id ) }}" style="float: left; margin-right: 5px;">Edit</a>
                            <form action="{{ url('/barang/'.$v->id ) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection