@extends('eshop.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
                        
            <div class="col-sm-9 padding-right">
                @include('eshop.partial.produklist')
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