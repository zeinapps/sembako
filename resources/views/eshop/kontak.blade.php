@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 row">
                <h2 class="title text-center">Kontak Kami</h2>
                <address>
                    <p>LAPAK Online.</p>
                    <p>Alamat: Perum Karangploso View GG7, Malang</p>
                    <p>HP/WA: {{Config::get('app.no_wa')}}</p>
                </address>
            </div>
            @include('eshop.sidebar')
        </div>
    </div>

</section>
@endsection