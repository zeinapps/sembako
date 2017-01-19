
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