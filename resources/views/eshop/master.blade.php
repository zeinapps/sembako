<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>{{Config::get('app.nama_toko')}}</title>
        <link href="/eshop/css/bootstrap.min.css" rel="stylesheet">
        <link href="/eshop/css/font-awesome.min.css" rel="stylesheet">
        <link href="/eshop/css/prettyPhoto.css" rel="stylesheet">
        <link href="/eshop/css/price-range.css" rel="stylesheet">
        <link href="/eshop/css/animate.css" rel="stylesheet">
        <link href="/eshop/css/main.css" rel="stylesheet">
        <link href="/eshop/css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="/eshop/js/html5shiv.js"></script>
        <script src="/eshop/js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="/eshop/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/eshop/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/eshop/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/eshop/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/eshop/images/ico/apple-touch-icon-57-precomposed.png">
        <style>
            .floating{
                position: fixed; 
                top: 0px; 
                z-index: 1000;
                width:100%;
            }

        </style>
    </head><!--/head-->

    <body id="main">
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="/"><i class="fa fa-phone"></i>/WA {{Config::get('app.no_wa')}}</a></li>
                                    <!--<li><a href="/"><i class="fa fa-envelope"></i> zein.apps@gmail.com</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="/">{{Config::get('app.nama_toko')}}</a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang <span class="label label-danger" id="jumlah_item_keranjang">0</span></a></li>
                                    @if (Auth::guest())
                                    <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="/register"><i class="fa fa-user"></i> Daftar</a></li>
                                    @else
                                    <li><a href="/kesukaan"><i class="fa fa-star"></i> Kesukaan <span class="label label-danger" id="jumlah_item_kesukaan">{{Auth::check()?Auth::user()->kesukaan : 0}}</span></a></li>
                                    <li><a href="/transaksi"><i class="fa fa-table"></i> Transaksi</a></li>
                                    <li><a href="/akun"><i class="fa fa-user"></i> Akun</a></li>
                                    <li><a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            <i class="fa fa-unlock"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/" class="active">Beranda</a></li>
                                    <li><a href="/carapembelian" class="active">Cara Pembelian</a></li>
                                    <li><a href="/kontak" class="active">Kontak</a></li>

                                </ul>
                            </div>
                        </div>
                        <!--                        <div class="col-sm-3">
                                                    <form action="{{ url('/produk') }}" method="GET">
                                                        <div class="search_box pull-right">
                                                            <input type="text" placeholder="Search" name="s" value="@if(isset($s)){{  $s ? $s : '' }}@endif"/>
                                                        </div>
                                                    </form>
                                                </div>-->

                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
        <br>
        <section>
            <div class="container" id="header-search" style="width:100%; ">
                <nav class="row" id="search-form">
                    <div class="col-sm-12">
                        <form action="{{ url('/produk') }}" method="GET">
                            <div class="input-group input-group-lg col-md-6 col-md-offset-3">
                                <input placeholder="Pencarian Produk" name="s"  class="form-control" type="text" value="@if(isset($s)){{  $s ? $s : '' }}@endif">
                                <span class="input-group-btn">
                                    <button id="sbtn" class="btn btn-primary" type="submit" style="margin-top: 0px;">
                                        Cari
                                    </button> 
                                </span>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>

        </section>
        <br>
        <div id="message" style="display: none;">
            <div id="inner-message" class="alert alert-success alert-message">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        </div>
        @yield('content')
        
        <div id="keranjang_bottom" class="alert alert-success" style="padding: 5px; margin-bottom: 0px;">
            <a style="margin-right: 5px;" href="/keranjang"><i class="fa fa-shopping-cart"></i> <span class="label label-danger" id="jumlah_item_keranjang_bottom">0</span></a>
            @if(!Auth::guest())
            <a href="/kesukaan"><i class="fa fa-star"></i> <span class="label label-danger" id="jumlah_item_keranjang_bottom">{{Auth::check()?Auth::user()->kesukaan : 0}}</span></a>
            @endif
            <a style="margin-right: 5px;" href="/carapembelian"> <span class="label label-info" id="">Cara Beli</span></a>
        </div>

        <footer id="footer"><!--Footer-->


            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2013 E-Shop Inc. All rights reserved.</p>
                        <p class="pull-right">Designed by <span><a target="_blank" href="http://invoinn.com/">InvoInn</a></span></p>
                    </div>
                </div>
            </div>

        </footer><!--/Footer-->

        

        <script src="/eshop/js/jquery.js"></script>
        <script src="/eshop/js/bootstrap.min.js"></script>
        <script src="/eshop/js/jquery.scrollUp.min.js"></script>
        <script src="/eshop/js/price-range.js"></script>
        <script src="/eshop/js/jquery.cookie.js"></script>
        <script src="/eshop/js/jquery.prettyPhoto.js"></script>
        <script src="/eshop/js/main.js"></script>
        @if (!Auth::guest())
            <script>
                var api_token = '<?php echo Auth::user()->api_token ?>';
            </script>
        @else
            <script>
                var api_token = false;
            </script>
        @endif
        <script>
            $(document).ready(function () {

                $(window).scroll(function () {
                    if ($(window).scrollTop() > $('#header-search').offset().top)
                        $('#search-form').addClass('floating');
                    else
                        $('#search-form').removeClass('floating');
                });

            });
        </script>


        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4  class="modal-title">Tentukan Jumlah Pesanan</h4>
                    </div>
                    <div class="modal-body">
                        <div style="text-align: center">
                            <img id="modal_img" src="" alt="" >
                        </div>

                        <div class="form-group">
                            <label for="email">Nama:</label>
                            <input id="modal_nama" type="text" class="form-control" disabled="">
                            <input type="hidden" class="form-control" id="modal_id" >
                            <input type="hidden" class="form-control" id="modal_harga" >
                        </div>
                        <div class="form-group">
                            <label for="pwd">Jumlah:</label>
                            <div class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <button type="button" class="btn btn-success" id="modal_button_plus"> + </button>
                                    <input id="modal_input_jumlah" class="cart_quantity_input" value="1" autocomplete="off" size="2" type="text">
                                    <button type="button" class="btn btn-danger" id="modal_button_minus"> - </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="modal_tambahkan" type="button" class="btn btn-default">Tambahkan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modallogin" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4  class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">
                        Maaf, Anda Harus login terlebih dahulu untuk memilih barang yang disukai. <a href="{{ url('/login') }}">Login</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        @if (count(session('deletecokies')) > 0)
        <script>
            $.removeCookie('keranjang');
        </script>
        @endif
        <script src="/eshop/js/custom.js"></script>
        
    </body>
</html>