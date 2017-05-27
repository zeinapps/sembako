@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                
                <ol class="breadcrumb">
                    <li><a href="/">Beranda</a></li>
                    <li class="active">Transaksi</li>
                </ol>
                @include('default.notifikasi.error')
                @include('default.notifikasi.success')
                
                <div class="row">  	
                    <div class="col-sm-12">
                        <div class="contact-form">
                            <h2 class="title text-center">{{$title}}</h2>
                            <form action="{{ url('/transaksi') }}" method="GET">Pilih Status
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
                                        <td>
                                            {!! $v->status !!}
                                        </td>
                                        <td>
                                            <a class="btn  btn-info btn-xs" href="{{ url('/transaksi/'.$v->id ) }}" style="float: left; margin-right: 5px;">Lihat Produk</a>

                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{ $data->links() }}
                        </div>
                    </div>

                </div>  

                <br>
            </div>
            @include('eshop.sidebar')
        </div>
    </div>
</section>
@endsection