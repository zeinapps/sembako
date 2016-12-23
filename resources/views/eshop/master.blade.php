<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>LOcalhost</title>
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
    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="/"><i class="fa fa-phone"></i> +628233486</a></li>
                                    <li><a href="/"><i class="fa fa-envelope"></i> zein.apps@gmail.com</a></li>
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
                                <a href="/"><span>LU</span>-MINTU</a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="/akun"><i class="fa fa-user"></i> Akun</a></li>
                                    <li><a href="/pembayaran"><i class="fa fa-crosshairs"></i> Pembayaran</a></li>
                                    <li><a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
                                    <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
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
                                    <li><a href="/" class="active">Home</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <form action="{{ url('/produk') }}" method="GET">
                            <div class="search_box pull-right">
                                <input type="text" placeholder="Search" name="s" value="@if(isset($s)){{  $s ? $s : '' }}@endif"/>
                            </div>
                                </form>
                        </div>
                        
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->

        @yield('content')

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
        <script src="/eshop/js/jquery.prettyPhoto.js"></script>
        <script src="/eshop/js/main.js"></script>
    </body>
</html>