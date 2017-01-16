@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{ Config::get("app.image_url_produk")."/450/".$produk->gambar }}" alt="{{ $produk->nama }}" />
                        </div>
                        

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="/eshop/images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{ $produk->nama }}</h2>
                            <p>Keterangan: {{ $produk->keterangan ? $produk->keterangan : '-' }}</p>
                            <span>
                                <span>IDR {{ $produk->hargaonline }}</span><br>
                                <label>Quantity:</label>
                                <input type="text" value="1" />
                                <button data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$produk->id}}','{{$produk->nama}}','{{ Config::get("app.image_url_produk")."/85/".$produk->gambar }}','{{$produk->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Tambah ke keranjang</button>
                            </span>
                            <a href=""><img src="/eshop/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Produk Rekomendasi</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                @foreach ($rekomended1 as $v)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/produk/".$v->id) }}">
                                                    <img style="width: 85px;" src="{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}" alt="" />
                                                </a>
                                                <h2>IDR {{ $v->hargaonline }}</h2>
                                                <p>{{ $v->nama }}</p>
                                                <button data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$v->id}}','{{$v->nama}}','{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}','{{$v->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Tambah ke keranjang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="item">	
                                @foreach ($rekomended2 as $v)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/produk/".$v->id) }}" >
                                                    <img style="width: 85px;" src="{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}" alt="" />
                                                </a>
                                                <h2>IDR {{ $v->hargaonline }}</h2>
                                                <p>{{ $v->nama }}</p>
                                                <button data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$v->id}}','{{$v->nama}}','{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}','{{$v->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Tambah ke keranjang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->

            </div>
            @include('eshop.sidebar')
        </div>
    </div>
</section>
@endsection