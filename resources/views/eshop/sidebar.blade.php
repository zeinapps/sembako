<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Etalase</h2>
        
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach(json_decode(Storage::get('json/kategori_barang.json')) as $parent)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $parent->id }}">
                            @if($parent->child)<span class="badge pull-right"><i class="fa fa-plus"></i></span>@endif
                            {{ $parent->nama }}
                        </a>
                    </h4>
                </div>
                @if($parent->child)
                <div id="{{ $parent->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($parent->child as $child)
                            <li><a href='javascript: void(0)' onclick='kategori({{ $child->id }})'>{{ $child->nama }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
            
        </div><!--/category-products-->
    </div>
</div>
