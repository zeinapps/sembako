
function fadeAlert() {
    window.setTimeout(function () {
        $("#message").fadeTo(1500, 0).slideUp(500, function () {
            $(this).css("display", "none");
        });
    }, 5000);
}

function suka(id) {
    
    if(api_token === false){
        $('#modallogin').modal({
            show: 'false'
        }); 
    }else{
        var data = [{barang_id: id}];
        $.ajax({
            url: "/api/suka?api_token=" + api_token, // Specify url to submit
            type: 'post',
            data: {data: data}, // Specify post data
            dataType: 'json',
            async: true,
            success: function (json) {
                $("#message").css("display", "block")
                $("#message").css("opacity", "1")
                if (json.status) {

                    $('#inner-message').removeClass('alert-success');
                    $('#inner-message').removeClass('alert-danger');
                    $('#inner-message').addClass('alert-success');
                    $('#inner-message').text(json.message[0]);
                    $('#link_suka_'+id).removeClass('btn-warning');
                    $('#link_suka_'+id).removeAttr("href").css("cursor","pointer");
                    $('#link_suka_'+id).removeAttr("onclick");
                    $('#link_suka_'+id).attr('onclick', 'tidaksuka('+id+')');
                    $('#link_suka_'+id).addClass('btn-success');
                    $('#link_suka_'+id).text('Batal Favorit');
                    
                } else {
                    $('#inner-message').removeClass('alert-success');
                    $('#inner-message').removeClass('alert-danger');
                    $('#inner-message').addClass(json.message[0]);
                }
                fadeAlert();
            }
        });
        
    }
}

function tidaksuka(id) {
    
    if(api_token === false){
        $('#modallogin').modal({
            show: 'false'
        }); 
    }else{
        var data = [{barang_id: id}];
        $.ajax({
            url: "/api/tidaksuka?api_token=" + api_token, // Specify url to submit
            type: 'post',
            data: {data: data}, // Specify post data
            dataType: 'json',
            async: true,
            success: function (json) {
                $("#message").css("display", "block")
                $("#message").css("opacity", "1")
                if (json.status) {

                    $('#inner-message').removeClass('alert-success');
                    $('#inner-message').removeClass('alert-danger');
                    $('#inner-message').addClass('alert-success');
                    $('#inner-message').text(json.message[0]);
                    $('#link_suka_'+id).removeClass('btn-success');
                    $('#link_suka_'+id).addClass('btn-warning');
                    $('#link_suka_'+id).attr('onclick', 'suka('+id+')');
                    $('#link_suka_'+id).text('Favorit');
                    
                } else {
                    $('#inner-message').removeClass('alert-success');
                    $('#inner-message').removeClass('alert-danger');
                    $('#inner-message').addClass(json.message[0]);
                }
                fadeAlert();
            }
        });
        
    }
}



if (window.location.pathname === '/keranjang') {
    setKeranjang();
}

var jkrj = getCookieKeranjang();
var arkj = jQuery.parseJSON(jkrj);
setJumlahKeranjang(arkj.length);

function setJumlahKeranjang(jumlah) {
    $("#jumlah_item_keranjang").text(jumlah);
    $("#jumlah_item_keranjang_bottom").text(jumlah);
    var minpem = 50000;
    var kurangdikit = minpem - getTotalSementara() ;
    var message = alamat_toko+". Pusat Bantuan, Informasi, dan Pemesanan chat WA "+no_wa+". Siap melayani Pesan-Antar*";
//    if(kurangdikit != 50000){
//        message =  "Total belanja saat ini Rp"+formatrupiah(getTotalSementara());
//    }else{
//        
//    }
    $("#jumlah_harga_keranjang_bottom").text("Rp"+formatrupiah(getTotalSementara()));
    $("#message_marque").text(message);
}

function getCookieKeranjang() {
    var cokie = $.cookie('keranjang') ? $.cookie('keranjang') : '[]';

    return cokie;
}
function setCookieKeranjang(array) {
    $.cookie('keranjang', JSON.stringify(array), {path: '/'});
}

function setKeranjang() {
    var jkeranjang = getCookieKeranjang();
    var arkeranjang = jQuery.parseJSON(jkeranjang);
    setJumlahKeranjang(arkeranjang.length);
    for (var i in arkeranjang) {

//        var row = "<tr id='item_prod_" + arkeranjang[i].id + "'>\n\
//                            <td class='cart_product'>\n\
//                                <img src='" + arkeranjang[i].image + "' alt=''>\n\
//                            </td>\n\
//                            <td class='cart_description'>\n\
//                            <h4>" + arkeranjang[i].nama + "</h4>\n\
//                                <p>Barcode: -</p>\n\
//                            </td>\n\
//                            <td class='cart_price'>\n\
//                                <p>Rp " + arkeranjang[i].harga + "</p>\n\
//                            </td>\n\
//                            <td class='cart_quantity'>\n\
//                                <div class='cart_quantity_button'>\n\
//                                    <a onClick='plus_keranjang(" + arkeranjang[i].id + ")' class='cart_quantity_up' href='javascript: void(0)'> + </a>\n\
//                                    <input type='hidden' value='" + arkeranjang[i].id + "' name='id[]' />\n\
//                                <input type='hidden' value='" + arkeranjang[i].harga + "' name='harga_satuan[]' />\n\
//                                 <input id='jum_id_" + arkeranjang[i].id + "' class='cart_quantity_input' type='text' name='jumlah[]' value='" + arkeranjang[i].jumlah + "' autocomplete='off' size='2'>\n\
//                                    <a onClick='min_keranjang(" + arkeranjang[i].id + ")' class='cart_quantity_down' href='javascript: void(0)'> - </a>\n\
//                                </div>\n\
//                            </td>\n\
//                            <td class='cart_total'>\n\
//                                <p id='id_sub_" + arkeranjang[i].id + "' class='cart_total_price'>Rp " + 0 + "</p>\n\
//                            </td>\n\
//                            <td class='cart_delete'>\n\
//                                <a onClick='delete_produk(" + arkeranjang[i].id + ")'  class='cart_quantity_delete' href='javascript: void(0)'><i class='fa fa-times'></i></a>\n\
//                            </td>\n\
//                        </tr>\n\
//                        ";
        var ribbon = "Baru";
        var color_ribbon = "red";
        if(arkeranjang[i].ribbon !== "" && arkeranjang[i].ribbon !== null){
            ribbon = arkeranjang[i].ribbon;
            color_ribbon = "blue";
        }
        var row = "<div id='item_prod_" + arkeranjang[i].id + "' class='col-xs-6 col-sm-4 col-md-4 col-lg-3'>\n\
                        <div class='product-image-wrapper'>    \n\
                            <div class='single-products'>    \n\
                                <div class='productinfo text-center'>    \n\
                                    <a href='/#/produk/" + arkeranjang[i].id + "'>     \n\
                                        <div class='box-ribbon-corner' align='center'> \n\
                                            <div class='ribbon-corner "+color_ribbon+"'><span>"+ribbon+"</span></div>        \n\
                                            <img src=" + arkeranjang[i].image.replace("85", "250") + " />    \n\
                                        </div>  \n\
                                    </a>    \n\
                                    <h2>@" + arkeranjang[i].harga + "</h2>        \n\
                                    <div style='height: 40px;'>     \n\
                                        <h4><strong>" + arkeranjang[i].nama.toUpperCase() + "</strong></h4>    \n\
                                    </div>    \n\
                                            <a onClick='plus_keranjang(" + arkeranjang[i].id + ")' class='btn btn-success btn-sm' href='javascript: void(0)'> + </a>\n\
                                            <input type='hidden' value='" + arkeranjang[i].id + "' name='id[]' />\n\
                                        <input type='hidden' value='" + arkeranjang[i].harga + "' name='harga_satuan[]' />\n\
                                        <input id='jum_id_" + arkeranjang[i].id + "' class='' type='text' name='jumlah[]' value='" + arkeranjang[i].jumlah + "' autocomplete='off' size='2'>\n\
                                            <a onClick='min_keranjang(" + arkeranjang[i].id + ")' class='btn btn-warning btn-sm' href='javascript: void(0)'> - </a>\n\
                                    <h4 id='id_sub_" + arkeranjang[i].id + "' class=''>Rp " + 0 + "</h4>\n\
                                    <a onClick='delete_produk(" + arkeranjang[i].id + ")'  class='btn btn-danger btn-sm' href='javascript: void(0)'><i class='fa fa-times'></i> Batal</a>\n\
                                </div> \n\
                            </div> \n\
                        </div> \n\
                   </div> \n\
                    "
        $("#div_keranjang").append(row);
    }
        
    hitungtotal();


}


$("#modal_tambahkan").click(function () {

    var id_produk = $("#modal_id").val();
    var jumlah_produk = $("#modal_input_jumlah").val();
    var nama = $("#modal_nama").val();
    var image = $("#modal_img").attr('src');
    var harga = $("#modal_harga").val();
    var ribbon = $("#modal_ribbon").val();
    var ispromo = $("#modal_ispromo").val();
    var json_keranjang = getCookieKeranjang();
    var array_keranjang = jQuery.parseJSON(json_keranjang);
    var in_array = false;
    var x_array = null;
    for (var x in array_keranjang) {
        if (array_keranjang[x].id === id_produk) {
            x_array = x;
            in_array = true;
            break;
        }
    }

    if (in_array) {
        array_keranjang[x_array].jumlah = parseInt(array_keranjang[x_array].jumlah) + parseInt(jumlah_produk);
    } else {
        var new_item = {"id": id_produk, "jumlah": jumlah_produk, "harga": harga, "nama": nama, "image": image, "ispromo": ispromo, "ribbon": ribbon};
        array_keranjang.push(new_item);
    }
    
    
    setCookieKeranjang(array_keranjang);
    setJumlahKeranjang(array_keranjang.length);
    $('#myModal').modal('hide');
});

function delete_produk(id) {
    $("#item_prod_" + id).remove();
    var json_keranjang = $.cookie('keranjang') ? $.cookie('keranjang') : '[]';
    var array_keranjang = jQuery.parseJSON(json_keranjang);
    var new_ar_kerj = [];
    var xx = 0;
    for (var x in array_keranjang) {
        if (!(parseInt(array_keranjang[x].id) === parseInt(id))) {
            console.log(xx);
            new_ar_kerj[xx] = array_keranjang[x];
            xx++;
        }
    }
    setJumlahKeranjang(new_ar_kerj.length);
    setCookieKeranjang(new_ar_kerj);
    hitungtotal();
}

function getTotalSementara(){
    var total = 0;
    var json_keranjang = getCookieKeranjang();
    var array_keranjang = jQuery.parseJSON(json_keranjang);
    for (var x in array_keranjang) {
        var sub_tot = parseInt(parseInt(array_keranjang[x].jumlah) * parseInt(array_keranjang[x].harga));
        total += sub_tot;
    }
    return total;
}

function hitungtotal() {

    var json_keranjang = getCookieKeranjang();
    var array_keranjang = jQuery.parseJSON(json_keranjang);
    var total = 0;
    for (var x in array_keranjang) {
        var sub_tot = parseInt($("#jum_id_" + array_keranjang[x].id).val() * parseInt(array_keranjang[x].harga));
        total += sub_tot;
        $("#id_sub_" + array_keranjang[x].id).text('Rp ' + sub_tot);
    }

    setJumlahKeranjang(array_keranjang.length);
    var ongkir = 0;
    var Total_Biaya = total + ongkir;
    $("#id_subtotal").remove();
//    var str_subtotal = "<tr id='id_subtotal'>";
//    str_subtotal += "<td colspan='4'></td>";
//    str_subtotal += "<td colspan='2'>";
//    str_subtotal += "<table class='table table-condensed total-result'>";
//    str_subtotal += "<tr>";
//    str_subtotal += "<td>Sub Total</td>";
//    str_subtotal += "<td>" + total + "</td>";
//    str_subtotal += "</tr>";
//    str_subtotal += "<tr class='shipping-cost'>";
//    str_subtotal += "<td>Ongkos kirim</td>";
//    str_subtotal += "<td>" + ongkir + "</td>";
//    str_subtotal += "</tr>";
//    str_subtotal += "<tr>";
//    str_subtotal += "<td>Total</td>";
//    str_subtotal += "<td><span>" + Total_Biaya + "</span></td>";
//    str_subtotal += "</tr>";
//    str_subtotal += "</table>";
//    str_subtotal += "</td>";
//    str_subtotal += "</tr>";
    var str_subtotal = "<div id='id_subtotal'>";
    str_subtotal += "<h3>Total Harga <strong>Rp"+Total_Biaya+"</strong></h3>";
    str_subtotal += "</div>";
    str_subtotal += "</div>";
    $("#total_keranjang").append(str_subtotal);
    set_areatext();
}
function set_areatext(){
    var json_keranjang = getCookieKeranjang();
    var array_keranjang = jQuery.parseJSON(json_keranjang);
    var copy_pesanan = "";
    var nomer = 0;
    for (var x in array_keranjang) {
        nomer +=1;
        copy_pesanan += nomer+") " + array_keranjang[x].nama + " ("+ $("#jum_id_" + array_keranjang[x].id).val() +") \n";
    }
    $("#area_keranjang").attr('rows', array_keranjang.length);
    $("#area_keranjang").text(copy_pesanan);
}
function plus_keranjang(id) {
    $("#jum_id_" + id).val((parseInt($("#jum_id_" + id).val()) + 1));
    hitungtotal();
}
function min_keranjang(id) {
    if (parseInt($("#jum_id_" + id).val()) > 1) {
        $("#jum_id_" + id).val((parseInt($("#jum_id_" + id).val()) - 1));
        hitungtotal();
    }
}

function openmodal(id, nama, img, harga, ispromo, ribbon) {
    $("#modal_nama").val(nama);
    $("#modal_id").val(id);
    $("#modal_harga").val(harga);
    $("#modal_ispromo").val(ispromo);
    $("#modal_ribbon").val(ribbon);
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
                        
function formatrupiah(bilangan){
	
    var	number_string = bilangan.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
    }
    return rupiah;
}

	
//function loaddata(s_cari,kategori,options) {// Settings
//    var param = "";
//    var cari = s_cari;
//    if(s_cari){
//        param = "s="+s_cari;
//    }
//    if(kategori){
//        param = "kat="+kategori;
//    }
//    var settings = $.extend({ 
//            loading_gif_url	: "/storage/images/ajax-loader.gif", //url to loading gif
//            end_record_text	: 'Tidak ada data selanjutnya', //no more records to load
//            data_url 		: '/api/produk?'+param, //url to PHP page
//            start_page 		: 1, //initial page
//    }, options);
//    $("#not_features_items").remove();
//    var el = $("#features_items");	
//    el.empty();
//    loading  = false; 
//    end_record = false;
//    next_url = settings.data_url;
//    contents(el, settings); //initial data load
//    
//    $(window).scroll(function() { //detact scroll
//            if($(window).scrollTop() + $(window).height() >= $(document).height()){ //scrolled to bottom of the page
//                    contents(el, settings); //load content chunk 
//            }
//    });		
//}; 
//	//Ajax load function
//function contents(el, settings){
//        var load_img = $('<img/>').attr('src',settings.loading_gif_url).addClass('loading-image'); //create load image
//        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('col-md-12 end-record-info'); //end record text
//
//        if(loading == false && end_record == false){
//                loading = true; //set loading flag on
//                el.append(load_img); //append loading image
//                $.ajax ({
//                url: next_url,
//                dataType: "json",
//                contentType: "application/json",
//                success: function (jsonData) {
////                            alert(jsonData.data.length);
//                    var data = jsonData.data;
//                    if(settings.start_page==1){
//                        el.append('<h2 class="title text-center">'+jsonData.title+' ('+jsonData.total+')</h2>');
//                    }
//                    if(data.length == 0){ //no more records
//                            el.append(record_end_txt); //show end record text
//                            load_img.remove(); //remove loading img
//                            end_record = true; //set end record flag on
//                            return; //exit
//                    }
//
//                    loading = false;  //set loading flag off
//                    load_img.remove(); //remove loading img 
//                    
//                    settings.start_page ++; //page increment
//                    el.append('</div>');
//                    $.each(data, function(index, item) {
//
//                        var nama = data[index].nama;
//                        var kata = data[index].nama.split(" ");
//                        if(kata.length > 4){
//                            nama = kata[0]+" "+kata[1]+" "+kata[2]+" ...";
//                        }
//                        var btn_favorit_or_batal = ""
//                        if(data[index].suka){
//                            btn_favorit_or_batal = "<a id='link_suka_"+data[index].id+"' href='javascript: void(0)' onclick='tidaksuka("+data[index].id+")'  class='btn btn-xs btn-success '><i class='fa fa-star '></i> Batal Favorit</a>";
//                        }else{
//                            btn_favorit_or_batal = "<a id='link_suka_"+data[index].id+"' href='javascript: void(0)' onclick='suka("+data[index].id+")' class='btn btn-warning btn-xs '><i class='fa fa-star-o'></i> Favorit</a>";
//                        }
//                        var html = "<div class='col-xs-6 col-sm-6 col-md-4 col-lg-4'>\n\
//                                    <div class='product-image-wrapper'> \n\
//                                    <div class='single-products'> \n\
//                                    <div class='productinfo text-center'> \n\
//                                    <a href='/produk/"+ data[index].id +"'> \n\
//                                    <div class='box-ribbon-corner' align='center'> \n\
//                                        <div class='ribbon-corner red'><span>Baru</span></div> \n\
//                                        <img src='/storage/images/produk/250/"+ data[index].gambar +"' alt='' /> \n\
//                                    </div> \n\
//                                    </a>\n\
//                                    <h2 style='margin-top: 5px;'>Rp"+data[index].hargaonline+"</h2>\n\
//                                    <div style='height: 40px;'> \n\
//                                    <h4><strong>"+nama+"</strong></h4> \n\
//                                    </div>\n\
//                                    <p>"+data[index].kategori+"</p>\n\
//                                    "+btn_favorit_or_batal+"\n\
//                                    <button style='margin-top: 10px; width: 98%;' data-toggle='modal' data-target='#myModal' type='button' onClick=\"openmodal('"+data[index].id +"','"+nama+"','/storage/images/produk/85/"+data[index].gambar+"','"+data[index].hargaonline+"')\" class='btn btn-success add-to-cart'><i class='fa fa-shopping-cart'></i> + Keranjang</button>\n\
//                                    </div> \n\
//                                    </div> \n\
//                                    </div> \n\
//                                    </div>";
//
//                        el.append(html);
//
//
//                    });
//                    el.append('</div>');
//                    next_url = jsonData.next_page_url;
//                    if(jsonData.next_page_url === null){
//                            el.append(record_end_txt); //show end record text
//                            load_img.remove(); //remove loading img
//                            end_record = true; //set end record flag on
//                            return; //exit
//                        }
//
//                    
//                },
//                error: function() {
//                    //any error to be handled
//                }
//            });
//
//        }
//}
//
//if (window.location.pathname === '/') {
//    loaddata();
//}
//$("#sbtn").click(function(){
//    var s = $("#s_pencarian").val();
//    if(s===""){
//        return;
//    }
//    loaddata(s,false);
//}); 
//
//$('#s_pencarian').keypress(function (e) {
//  if (e.which == 13) {
//    var s = $("#s_pencarian").val();
//    if(s===""){
//        return;
//    }
//    loaddata(s,false);
//  }
//});
//
//function kategori(id_kat){
//    loaddata(false,id_kat);
//}

function openkategori(){
    $('#modalkategori').modal({
            show: 'true'
        }); 
}
function closekategori(){
   
        $('#modalkategori').modal('hide')
}

