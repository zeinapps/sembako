@extends('eshop.master')
@section('content')

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($slider as $v)
                        <li data-target="#slider-carousel" data-slide-to="{{ $v->no }}" class="@if($v->no == 1 ) {{'active' }} @endif"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($slider as $v)
                        <div class="item @if($v->no == 1 ) {{'active' }} @endif">
                            <div class="col-sm-6">
                                <h1><span>IDR</span> {{ $v->hargaonline }}</h1>
                                <h2>{{ $v->nama }}</h2>
                                <a href="{{ url("/produk/".$v->id) }}" class="btn btn-default get">Lihat</a>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ Config::get("app.image_url_produk")."/450/".$v->gambar }}" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
                        
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach ($data as $v)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ url("/produk/".$v->id) }}">
                                        <img src="{{ Config::get("app.image_url_produk")."/150/".$v->gambar }}" alt="" />
                                    </a>
                                    <h2>IDR {{ $v->hargaonline }}</h2>
                                    <h3><strong>{{ $v->nama }}</strong></h3>
                                    <p>{{ $v->kategori }}</p>
                                    <a href="{{ url("/produk/".$v->id) }}" class="btn btn-info add-to-cart"><i class="fa fa-eye"></i>Lihat</a>
                                    <a href="#" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div><!--features_items-->


                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Produk Rekomendasi</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                @foreach ($rekomended1 as $v)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/produk/".$v->id) }}">
                                                    <img style="width: 85px;" src="{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}" alt="" />
                                                </a>
                                                <h2>IDR {{ $v->hargaonline }}</h2>
                                                <p>{{ $v->nama }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="item">	
                                @foreach ($rekomended2 as $v)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="{{ url("/produk/".$v->id) }}" >
                                                    <img style="width: 85px;" src="{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}" alt="" />
                                                </a>
                                                <h2>IDR {{ $v->hargaonline }}</h2>
                                                <p>{{ $v->nama }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
    <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <ul class="list-inline item-details">
                <li><a href="http://themifycloud.com">ThemifyCloud</a></li>
                <li><a href="http://themescloud.org">ThemesCloud</a></li>
            </ul>
        </div>
    </div>
</section>
@endsection