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
                            <p>Barcode: {{ $produk->barcode ? $produk->barcode : '-' }}</p>
                            <span>
                                <span>IDR {{ $produk->hargaonline }}</span><br>
                                <label>Quantity:</label>
                                <input type="text" value="1" />
                                <button type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
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