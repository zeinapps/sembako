@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <ol class="breadcrumb">
                    <li><a href="/">Beranda</a></li>
                    <li class="active">Kesukaan</li>
                </ol>
                @include('eshop.partial.produklist')
                {{ $data->links() }}
            </div>
            @include('eshop.sidebar')
        </div>
    </div>
    
</section>
@endsection