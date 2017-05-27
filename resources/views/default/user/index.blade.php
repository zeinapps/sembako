@extends('layouts.app')
@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <h2>User</h2>
            @include('default.notifikasi.error')
            @include('default.notifikasi.success')
            <a href="{{ url('/formuser') }}" class="btn btn-info" role="button" style="float: left;margin-right: 5px;">Data Baru</a>
            <form action="{{ url('/user') }}" method="GET">
                <div class="input-group col-md-6">
                    <input name="s" class="search-query form-control" placeholder="Kata kunci ==> Enter" type="text" value="{{ $s ? $s : '' }}">
                </div>
                
            </form>
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nama.</th>
                        <th>HP</th>
                        <th>Alamat</th>
                        <th>Token</th>
                        <th>Kesukaan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                    <tr>
                        <td>
                            {{ $v->name }}
                        </td>
                        <td>
                            {{ $v->hp }}
                        </td>
                        <td>
                            {{ $v->alamat }}
                        </td>
                        <td>
                            {{ $v->api_token }}
                        </td>
                        <td>
                            {{ $v->kesukaan }}
                        </td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="{{ url('/formuser/'.$v->id ) }}" style="float: left; margin-right: 5px;">Edit</a>
                            <a class="btn btn-danger btn-xs" href="{{ url('/formreset/'.$v->id ) }}" style="float: left; margin-right: 5px;">Reset</a>
<!--                            <form action="{{ url('/user/'.$v->id ) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-xs">
                                    Hapus
                                </button>
                            </form>-->
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection