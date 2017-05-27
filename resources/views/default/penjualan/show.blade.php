@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>Penjualan</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                    <tr>
                        <td>
                            TR{{ $v->nama }}
                        </td>
                        <td>
                            {{ $v->harga }}
                        </td>
                        <td>
                            {{ $v->jumlah }}
                        </td>
                        <td>
                            {{ ($v->harga*$v->jumlah) }}
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $data->links() }}
            
            <h2 class="">Total = Rp {{$total}}</h2>
            <form action="{{ url('/penjualan/'.$penjualan_id ) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="display" class="col-md-4 control-label">Ubah Status</label>
                    <div class="col-md-6">
                        {{ Form::select('status', Config::get('app.status_penjualan'), $status, ['class'=> 'form-control']) }}
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-sm">
                    Ubah
                </button>
            </form><hr>
            <a href="/penjualan" class="btn btn-default btn-sm">Kembali</a>
        </div>
    </div>
</div>

@endsection