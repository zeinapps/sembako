@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-12 row" >
                <h2 class="title text-center">Kontak Kami</h2>
                <address style="padding-left: 10px; padding-right: 10px;">
                    <p>{{Config::get('app.nama_toko')}}</p>
                    <p>Alamat: {{Config::get('app.alamat_toko')}}</p>
                    <p>HP/WA: {{Config::get('app.no_wa')}}</p>
                </address>
            </div>
            
        </div>
    </div>

</section>
@endsection