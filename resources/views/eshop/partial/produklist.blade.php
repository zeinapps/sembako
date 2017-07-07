<div class="features_items"><!--features_items-->
    <h2 class="title text-center">{{ $title }}</h2>
    @foreach ($data as $v)
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{ url("/produk/".$v->id) }}">
                        <div class="box-ribbon-corner" align="center">
                            <div class="ribbon-corner red"><span>Baru</span></div>
                            <img src="{{ Config::get("app.image_url_produk")."/250/".$v->gambar }}" alt="" />
                        </div>
                    </a>
                    <h2 style="margin-top: 5px;">Rp {{ $v->hargaonline }}</h2>
                    <div style="height: 40px;">
                        <h4><strong>@if(count($kata = explode(" ", $v->nama)) >4) {{ $kata[0].' '.$kata[1].' '.$kata[2].' '.$kata[3].'...' }} @else {{ $v->nama }} @endif </strong></h4>
                    </div>
                    <p>{{ $v->kategori }}</p>
                    <!--<a href="{{ url("/produk/".$v->id) }}" class="btn btn-info btn-xs "><i class="fa fa-eye"></i> Lihat Detil</a>-->
                    @if($v->suka)
                    <a id="link_suka_{{$v->id}}" href="javascript: void(0)" onclick="tidaksuka({{$v->id}})"  class="btn btn-xs btn-success "><i class="fa fa-star "></i> Batal Favorit</a>
                    @else
                    <a id="link_suka_{{$v->id}}" href="javascript: void(0)" onclick="suka({{$v->id}})" class="btn btn-warning btn-xs "><i class="fa fa-star-o"></i> Favorit</a>
                    @endif
                    <button style="margin-top: 10px; width: 98%;" data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$v->id}}','{{$v->nama}}','{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}','{{$v->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i> + Keranjang</button>
                </div>

            </div>

        </div>
    </div>    
    @endforeach
</div><!--features_items-->