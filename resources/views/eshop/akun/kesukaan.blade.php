@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="features_items" id="features_items">

                </div>
                <div id="not_features_items">
                    @include('eshop.partial.produklist')
                    {{ $data->links() }}
                </div>
                
            </div>
            @include('eshop.sidebar')
        </div>
    </div>
    
</section>
@endsection