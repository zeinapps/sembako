@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>Penjualan</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            
            <form action="{{ url('/penjualan') }}" method="GET">Pilih Status
                <div class="input-group col-md-4">
                 {{ Form::select('status', Config::get('app.status_penjualan'), $status, ['class'=> 'form-control','onchange'=>'this.form.submit()']) }}
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