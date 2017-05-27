@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>Penjualan</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <a href="{{ url('/formpenjualan') }}" class="btn btn-info" role="button" style="float: left;margin-right: 5px;">Data Baru</a>
            <form action="{{ url('/penjualan') }}" method="GET">
                <div class="input-group col-md-6">
                    <input name="s" class="search-query form-control" placeholder="Kata kunci ==> Enter" type="text" value="{{ $s ? $s : '' }}">
                </div>

            </form>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nomer Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kirim ke</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                    <tr>
                        <td>
                            TR{{ $v->id }}
                        </td>
                        <td>
                            {{ $v->tanggal }}
                        </td>
                        <td>
                            {{ $v->alamat }}
                        </td>
                        <td >
                            {!! $v->status !!}
                        </td>
                        <td>
                            <a class="btn  btn-info btn-xs" href="{{ url('/penjualan/'.$v->id ) }}" style="float: left; margin-right: 5px;">Lihat Produk</a>
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