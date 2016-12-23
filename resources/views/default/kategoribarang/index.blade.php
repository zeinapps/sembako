@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>Kategori Barang</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <a href="{{ url('/formkategoribarang') }}" class="btn btn-info" role="button" style="float: left;margin-right: 5px;">Data Baru</a>
            <form action="{{ url('/kategoribarang') }}" method="GET">
                <div class="input-group col-md-6">
                    <input name="s" class="search-query form-control" placeholder="Kata kunci ==> Enter" type="text" value="{{ $s ? $s : '' }}">
                </div>
                
            </form>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Parent</th>
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
                            {{ $v->nama }}
                        </td>
                        <td>
                            {{ $v->parent_nama ? $v->parent_nama : 'No Parent' }}
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ url('/formkategoribarang/'.$v->id ) }}" style="float: left; margin-right: 5px;">Edit</a>
                            <form action="{{ url('/kategoribarang/'.$v->id ) }}" method="POST">
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