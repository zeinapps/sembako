(function ($) {

    var app = $.sammy('#div_content', function () {
        this.use('Template', 'html');

        this.notFound = function () {
            window.location = '#/404';
        }

        this.get('#/', function (context) {
            loaddata();
        });

        this.get('#/cari/:s', function (context) {
            loaddata(this.params['s'], false);
        });

        this.get('#/kategori/:id', function (context) {closekategori();
            loaddata(false, this.params['id']);
            
        });

        this.get('#/carabeli', function (context) {
            end_record = true;
            this.item = {nama_toko: nama_toko, no_wa: no_wa};
            this.partial('/eshop/js/templates/carapembelian.html');
        });

        this.get('#/404', function (context) {
            end_record = true;
            this.item = {nama_toko: nama_toko, no_wa: no_wa};
            this.partial('/eshop/js/templates/404.html');
        });
        
        this.get('#/kontak', function (context) {
            end_record = true;
            this.item = {nama_toko: nama_toko, no_wa: no_wa, alamat_toko: alamat_toko };
            this.partial('/eshop/js/templates/kontak.html');
        });
        
        this.get('#/produk/:id', function (context) {
            context.app.swap('');
            end_record = true;
            var load_img = $('<img/>').attr('src', '/storage/images/ajax-loader.gif').addClass('loading-image');
            var el = $("#div_content");
            el.append(load_img);
            this.load('/api/produk/'+this.params['id']).then(function(items) {
                context.app.swap('');
                var data = $.parseJSON(items);
                context.render('/eshop/js/templates/produkdetil.html', {produk: data.produk, rekomended1: data.rekomended1, rekomended2: data.rekomended2})
               .appendTo(context.$element());
            });
            
        });
        
    });

    $(function () {
        if (window.location.pathname === '/') {
            app.run('#/');
        }else{
            return;
        }
        
    });

    
    function loaddata(s_cari, kategori, options) {// Settings 
        $("#a_selanjutnya").show();
        var param = ""; 
        var cari = s_cari;
        if (s_cari) {
            param = "s=" + s_cari;
        }
        if (kategori) {
            param = "kat=" + kategori;
        }
        var settings = $.extend({
            loading_gif_url: "/storage/images/ajax-loader.gif", //url to loading gif
            end_record_text: 'Tidak ada data selanjutnya', //no more records to load
            data_url: '/api/produk?' + param, //url to PHP page
            start_page: 1, //initial page
        }, options);
        $("#not_features_items").remove();
        var el = $("#div_content");
        el.empty();
        loading = false;
        end_record = false;
        next_url = settings.data_url;
        contents(el, settings); //initial data load

//        $(window).scroll(function () { //detact scroll
//            if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //scrolled to bottom of the page
//                contents(el, settings); //load content chunk 
//            }
//        });
        $("#a_selanjutnya").click(function(){
            contents(el, settings); 
        });
    }
    
    //Ajax load function
    function contents(el, settings) {
        var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image'); //create load image
//        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('col-md-12 end-record-info'); //end record text
         var record_end_txt = '';
        if (loading == false && end_record == false) {
            loading = true; //set loading flag on
            el.append(load_img); //append loading image
            $.ajax({
                url: next_url,
                dataType: "json",
                contentType: "application/json",
                success: function (jsonData) {
//                            alert(jsonData.data.length);
                    var data = jsonData.data;
                    if (settings.start_page == 1) {
                        el.append('<h2 class="title text-center">' + jsonData.title + ' (' + jsonData.total + ')</h2>');
                    }
                    if (data.length == 0) { //no more records
                        el.append(record_end_txt); //show end record text
                        load_img.remove(); //remove loading img
                        end_record = true; //set end record flag on
                        return; //exit
                    }

                    loading = false;  //set loading flag off
                    load_img.remove(); //remove loading img 

                    settings.start_page++; //page increment
                    el.append("<div class='features_items' >");
                    $.each(data, function (index, item) {

                        var nama = data[index].nama;
                        var kata = data[index].nama.split(" ");
                        if (kata.length > 4) {
                            nama = kata[0] + " " + kata[1] + " " + kata[2] + " ...";
                        }
                        var btn_favorit_or_batal = ""
                        if (data[index].suka) {
                            btn_favorit_or_batal = "<a id='link_suka_" + data[index].id + "' href='javascript: void(0)' onclick='tidaksuka(" + data[index].id + ")'  class='btn btn-xs btn-success '><i class='fa fa-star '></i> Batal Favorit</a>";
                        } else {
                            btn_favorit_or_batal = "<a id='link_suka_" + data[index].id + "' href='javascript: void(0)' onclick='suka(" + data[index].id + ")' class='btn btn-warning btn-xs '><i class='fa fa-star-o'></i> Favorit</a>";
                        }
                        var html = "<div class='col-xs-6 col-sm-4 col-md-4 col-lg-3'>\n\
                                    <div class='product-image-wrapper'> \n\
                                    <div class='single-products'> \n\
                                    <div class='productinfo text-center'> \n\
                                    <a href='#/produk/" + data[index].id + "'> \n\
                                    <div class='box-ribbon-corner' align='center'> \n\
                                        <div class='ribbon-corner red'><span>Baru</span></div> \n\
                                        <img src='/storage/images/produk/250/" + data[index].gambar + "' alt='' /> \n\
                                    </div> \n\
                                    </a>\n\
                                    <h2 style='margin-top: 5px;'>Rp" + data[index].hargaonline + "</h2>\n\
                                    <div style='height: 40px;'> \n\
                                    <h4><strong>" + nama.toUpperCase() + "</strong></h4> \n\
                                    </div>\n\
                                    <p>" + data[index].kategori + "</p>\n\
                                    " + btn_favorit_or_batal + "\n\
                                    <button style='margin-top: 10px; width: 98%;' data-toggle='modal' data-target='#myModal' type='button' onClick=\"openmodal('" + data[index].id + "','" + nama + "','/storage/images/produk/85/" + data[index].gambar + "','" + data[index].hargaonline + "')\" class='btn btn-success add-to-cart'><i class='fa fa-shopping-cart'></i> + Keranjang</button>\n\
                                    </div> \n\
                                    </div> \n\
                                    </div> \n\
                                    </div>";

                        el.append(html);
                        

                    });
                    el.append("</div>");
                    next_url = jsonData.next_page_url;
                    if (jsonData.next_page_url === null) {
                        $("#a_selanjutnya").hide();
//                        $("#a_selanjutnya").append("");
//                        el.append(record_end_txt); //show end record text
                        load_img.remove(); //remove loading img
                        end_record = true; //set end record flag on
                        return; //exit
                    }


                },
                error: function () {
                    //any error to be handled
                }
            });

        }
    }


    $("#sbtn").click(function () {
        var s = $("#s_pencarian").val();
        if (s === "") {
            return;
        }
        window.location = '/#/cari/' + s;
    });

    $('#s_pencarian').keypress(function (e) {
        if (e.which == 13) {
            var s = $("#s_pencarian").val();
            if (s === "") {
                return;
            }
            window.location = '/#/cari/' + s;
        }
    });



})(jQuery);


