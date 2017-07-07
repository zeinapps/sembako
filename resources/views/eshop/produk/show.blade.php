@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product box-ribbon-corner">
                            <div class="ribbon-corner red"><span>Baru</span></div>
                            <img src="{{ Config::get("app.image_url_produk")."/450/".$produk->gambar }}" alt="{{ $produk->nama }}" />
                        </div>
                        

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <!--<img src="/eshop/images/product-details/new.jpg" class="newarrival" alt="" />-->
                            <h2>{{ $produk->nama }}</h2>
                            <p>Keterangan: {{ $produk->keterangan ? $produk->keterangan : '-' }}</p>
                            <span>
                                <span>Rp {{ $produk->hargaonline }}</span><br>
                            </span><br>
                            @if($produk->suka)
                                <a id="link_suka_{{$produk->id}}" href="javascript: void(0)" onclick="tidaksuka({{$produk->id}})" class="btn btn-success "><i class="fa fa-star"></i> Batal Favorit</a>
                            @else
                                <a id="link_suka_{{$produk->id}}" href="javascript: void(0)" onclick="suka({{$produk->id}})" class="btn btn-warning "><i class="fa fa-star-o"></i> Favorit</a>
                            @endif
                            <br>
                            <button style="margin-top: 10px;" data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$produk->id}}','{{$produk->nama}}','{{ Config::get("app.image_url_produk")."/85/".$produk->gambar }}','{{$produk->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Tambah ke keranjang</button>
                            <!--<a href=""><img src="/eshop/images/product-details/share.png" class="share img-responsive"  alt="" /></a>-->
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
                @include('eshop.partial.rekomendasi')
            </div>
            @include('eshop.sidebar')
        </div>
    </div>
</section>
@endsection