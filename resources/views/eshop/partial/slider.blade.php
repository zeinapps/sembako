<section id="slider">
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
</section>