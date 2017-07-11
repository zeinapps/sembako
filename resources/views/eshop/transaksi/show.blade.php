@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">

                @include('default.notifikasi.error')
                @include('default.notifikasi.success')
                <div class="features_items" id="features_items">

                </div>
                <div id="not_features_items">
                    
                    <div class="row">  	
                        <div class="col-sm-12">
                            <div class="contact-form">
                                <h2 class="title text-center">{{$title}}</h2>
                                <ol class="breadcrumb">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/transaksi">Transaksi</a></li>
                        <li class="active">Detil</li>
                    </ol>
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
                                                {{ $v->nama }}
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
                            </div>

                            <h2 class="">Total = Rp {{$total}}</h2>
                            <a href="/transaksi" class="btn btn-default btn-sm">Kembali</a>
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