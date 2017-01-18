@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
                        
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{ $title }}</h2>
                    @foreach ($data as $v)
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ url("/produk/".$v->id) }}">
                                        <img src="{{ Config::get("app.image_url_produk")."/250/".$v->gambar }}" alt="" />
                                    </a>
                                    <h2>IDR {{ $v->hargaonline }}</h2>
                                    <h4><strong>{{ $v->nama }}</strong></h4>
                                    <p>{{ $v->kategori }}</p>
                                    <a href="{{ url("/produk/".$v->id) }}" class="btn btn-info btn-xs "><i class="fa fa-eye"></i>Lihat</a>
                                    @if($v->suka)
                                    <a id="link_suka_{{$v->id}}" href="javascript: void(0)" onclick="tidaksuka({{$v->id}})"  class="btn btn-xs btn-success "><i class="fa fa-star "></i> Suka</a>
                                    @else
                                    <a id="link_suka_{{$v->id}}" href="javascript: void(0)" onclick="suka({{$v->id}})" class="btn btn-warning btn-xs "><i class="fa fa-star-o"></i>Suka?</a>
                                    @endif
                                    <button style="margin-top: 10px;" data-toggle="modal" data-target="#myModal" type="button" onClick="openmodal('{{$v->id}}','{{$v->nama}}','{{ Config::get("app.image_url_produk")."/85/".$v->gambar }}','{{$v->hargaonline}}')" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Tambah ke keranjang</button>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div><!--features_items-->
                {{ $data->links() }}
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