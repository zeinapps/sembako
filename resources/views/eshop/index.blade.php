@extends('eshop.master')
@section('content')

<!--@include('eshop.partial.slider')-->

<section>
    <div class="container">
        <div class="row">
                        
            <div class="col-sm-9 row">
                @include('eshop.partial.produklist')
                @include('eshop.partial.rekomendasi')

            </div>
            @include('eshop.sidebar')
        </div>
    </div>
    
</section>
@endsection