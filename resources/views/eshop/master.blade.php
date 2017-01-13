<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TOKO ONLINE</title>
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
                                <a href="/"><span>TOKO</span> ONLINE</a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="/pembayaran"><i class="fa fa-crosshairs"></i> Pembayaran</a></li>
                                    <li><a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
                                    @if (Auth::guest())
                                    <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="/register"><i class="fa fa-user"></i> Daftar</a></li>
                                    @else
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
                                    <li><a href="/" class="active">Home</a></li>

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
                                <input placeholder="Pencarian Produk" name="s"  autofocus="" class="form-control" type="text" value="@if(isset($s)){{  $s ? $s : '' }}@endif">
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
        <script src="/eshop/js/jquery.cookie.js"></script>
        <script src="/eshop/js/jquery.prettyPhoto.js"></script>
        <script src="/eshop/js/main.js"></script>
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
        <script>
            
            var jkeranjang = $.cookie('keranjang') ?  $.cookie('keranjang') : '[]';
            var arkeranjang = jQuery.parseJSON( jkeranjang );
            for(var i in arkeranjang){
                var total = parseInt(arkeranjang[i].harga) * parseInt(arkeranjang[i].jumlah);
                var row = "<tr>\n\
                            <td class='cart_product'>\n\
                                <a href=''><img src='"+ arkeranjang[i].image +"' alt=''></a>\n\
                            </td>\n\
                            <td class='cart_description'>\n\
                                <h4><a href=''>"+ arkeranjang[i].nama +"</a></h4>\n\
                                <p>Barcode: -</p>\n\
                            </td>\n\
                            <td class='cart_price'>\n\
                                <p>IDR "+ arkeranjang[i].harga +"</p>\n\
                            </td>\n\
                            <td class='cart_quantity'>\n\
                                <div class='cart_quantity_button'>\n\
                                    <a class='cart_quantity_up' href=''> + </a>\n\
                                    <input class='cart_quantity_input' type='text' name='quantity' value='"+ arkeranjang[i].jumlah +"' autocomplete='off' size='2'>\n\
                                    <a class='cart_quantity_down' href=''> - </a>\n\
                                </div>\n\
                            </td>\n\
                            <td class='cart_total'>\n\
                                <p class='cart_total_price'>IDR "+ total +"</p>\n\
                            </td>\n\
                            <td class='cart_delete'>\n\
                                <a class='cart_quantity_delete' href=''><i class='fa fa-times'></i></a>\n\
                            </td>\n\
                        </tr>\n\
                        ";
                $("#tbody_keranjang").append(row);
            }
            
            $("#modal_tambahkan").click(function () {
                
                var id_produk = $("#modal_id").val();
                var jumlah_produk = $("#modal_input_jumlah").val();
                var nama = $("#modal_nama").val();
                var image = $("#modal_img").attr('src');
                var harga = $("#modal_harga").val();
                
                var json_keranjang = $.cookie('keranjang') ?  $.cookie('keranjang') : '[]';
                var array_keranjang = jQuery.parseJSON( json_keranjang );
                
                var in_array = false;
                var x_array = null;
                for(var x in array_keranjang){
                    if(array_keranjang[x].id === id_produk){
                        x_array = x;
                        in_array = true;
                        break;
                    }
                }
                if(in_array){
                    array_keranjang[x_array].jumlah = parseInt(array_keranjang[x_array].jumlah) + parseInt(jumlah_produk);
                }else{
                    var new_item = {"id":id_produk,"jumlah":jumlah_produk,"harga":harga,"nama":nama,"image":image};
                    array_keranjang.push(new_item);
                }
                $.cookie('keranjang', JSON.stringify(array_keranjang));
                $('#myModal').modal('hide');
            });
            
            function openmodal(id, nama, img,harga) {
                $("#modal_nama").val(nama);
                $("#modal_id").val(id);
                $("#modal_harga").val(harga);
                $("#modal_img").attr('src', img);
                $("#modal_input_jumlah").val(1);
            }
            $("#modal_button_plus").click(function () {
                $("#modal_input_jumlah").val((parseInt($("#modal_input_jumlah").val()) + 1));
            });
            $("#modal_button_minus").click(function () {
                if (parseInt($("#modal_input_jumlah").val()) > 1) {
                    $("#modal_input_jumlah").val((parseInt($("#modal_input_jumlah").val()) - 1));
                }
            });
            $("#modal_input_jumlah").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                        // Allow: Ctrl+A
                                (e.keyCode == 65 && e.ctrlKey === true) ||
                                // Allow: Ctrl+C
                                        (e.keyCode == 67 && e.ctrlKey === true) ||
                                        // Allow: Ctrl+X
                                                (e.keyCode == 88 && e.ctrlKey === true) ||
                                                // Allow: home, end, left, right
                                                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                                            // let it happen, don't do anything
                                            return;
                                        }
                                        // Ensure that it is a number and stop the keypress
                                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                            e.preventDefault();
                                        }
                                    });
        </script>
        
    </body>
</html>