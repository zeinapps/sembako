@extends('eshop.master')
@section('content')

<!--@incldude('eshop.partial.slider')-->

<section>
    <div class="container">
        <div class="row">
            @include('eshop.sidebar')
            <div class="col-sm-9 row">
                @include('eshop.partial.produklist')
                {{ $data->links() }}
                <!-- // @includce('eshop.partial.rekomendasi')-->

            </div>
            
        </div>
    </div>
    
</section>
@endsection