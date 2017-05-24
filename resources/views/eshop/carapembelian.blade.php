@extends('eshop.master')
@section('content')
<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 row">
                <div class="blog-post-area">
                    <h2 class="title text-center">Cara Pembelian</h2>
                    <div class="single-blog-post">
                        <h3>Pembelian Via WA dan COD</h3>
<!--                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Admin</li>
                                <li><i class="fa fa-clock-o"></i> 07:00</li>
                                <li><i class="fa fa-calendar"></i> 10 Januari 2017</li>
                            </ul>
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>-->
                       
                        <p>Pemesanan Produk di lapak kami bisa dilakukan dengan cara pesan langsung via WA ke nomer {{Config::get('app.no_wa')}}. Tulis barang yang Anda pesan beserta jumlahnya.</p>
                        <br><p>Barang yang telah Anda pesan akan kami kirim ke tempat Anda berada. Pada daerah tertentu kami mengenakan Ongkos kirim yang ditentukan bersama dengan pelanggan. Selebihnya Ongkos Kirim tidak dikenakan biaya atau <strong>GRATIS</strong>. </p> 
                        <br><p>Untuk saat ini pengiriman barang akan dilakukan 2 tahap yaitu pagi dan sore/malam hari. Sehingga pemesanan pada pagi sampai sore hari akan dikirim sore. Dan pemesanan sore sampai pagi akan dikirim pagi.</p>
                        <br><p>Pembayaran dilakukan secara langsung bersamaan dengan serah terima barang pesanan Pelanggan.</p>
                        <br><p><a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang </a> belanja berfungsi sebagai alat untuk menampung produk pesanan anda sementara. Dan juga sebagai alat hitung/kalkulator yang otomatis akan memberi tahu total harga produk yang telah Anda pilih.</p>
                        <br><p>Penjelasan di atas bukan haga mati, artinya secara berkala kami akan terus menyempurnakan sistem dan pelayanan kami agar pelanggan semakin terpuaskan.    </p>
                        <br><p>Untuk saat ini, Kami hanya melayani pembelian produk oleh pelanggan yang berdomisili di kawasan Kecamatan Karang Ploso, Kabupaten Malang. Atau sekitarnya. Saran dan kritik yang membangun bisa dikirim lewat nomer WA {{Config::get('app.no_wa')}}. </p>
                        <br><p>Salam Kami, {{Config::get('app.nama_toko')}}</p>
                        <br><p></p>
                    </div>
                    
                </div>

            </div>
            @include('eshop.sidebar')
        </div>
    </div>
    
</section>
@endsection