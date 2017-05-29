@extends('eshop.master')
@section('content')
<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 row">
                <div class="blog-post-area">
                    <h2 class="title text-center">Cara Pembelian</h2>
                    <div class="single-blog-post">
                        <h3>1. Kirim Pesanan Via HP/WA</h3>
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
                       
                        <p>Pemesanan Produk di lapak kami bisa dilakukan dengan cara pesan langsung via WA ke nomer <strong>{{Config::get('app.no_wa')}}</strong>. Tulis barang yang Anda pesan beserta jumlahnya.</p>
                        <br>
                        <h3>2. Kirim Pesanan Via Web</h3>
                        <br><p>Cara yang ke dua untuk membeli produk di lapak kami yaitu dengan memanfaatkan Web ini. Anda diwajibkan login terlebih dahulu sebelum Anda melakukan pemesanan produk. Jika Anda belum mempunyai akun silahkan mendaftar terlebih dahulu <a href="/register">disini</a>.</p>
                        <br><p>Setelah Anda login, Anda bisa memilih produk yang Anda inginkan ke dalam <a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang Belanja</a>. Setelah Anda selesai memilih, pastikan alamat pengiriman yang tertulis pada form sudah sesuai. Selanjutnya melakukan submit dengan menekan tombol <strong>"Kirim Pesanan"</strong></p>
                        <br><p></p>
                        <br><p></p>
                        </div>
                        <div class="single-blog-post">
                        <h2 class="title text-center">Penjelasan Lainnya</h2>
                       
                        <p><a href="/keranjang"><i class="fa fa-shopping-cart"></i> Keranjang </a> belanja berfungsi sebagai alat untuk menampung produk pesanan anda sementara. Dan juga sebagai alat hitung/kalkulator yang otomatis akan memberi tahu total harga produk yang telah Anda pilih.</p>
                        <br><p>Untuk saat ini pengiriman barang akan dilakukan 2 tahap yaitu pagi dan sore/malam hari. Sehingga pemesanan pada pagi sampai sore hari akan dikirim sore. Dan pemesanan sore sampai pagi akan dikirim pagi.</p>
                        <br><p>Barang yang telah Anda pesan akan kami kirim ke tempat Anda berada sesuai petunjuk yang telah Anda berikan ke kami. Jika Anda membeli produk kami senilai minimal Rp25.000 atau lebih, maka ongkos kirim <strong>GRATIS</strong>. Jika kurang dari Rp25.000, maka biaya kiraim hanya Rp2.000.</p>
                        <br><p>Pembayaran dilakukan secara langsung bersamaan dengan serah terima barang pesanan Pelanggan.</p>
                        <br><p>Aturan di atas bukan haga mati, artinya secara berkala kami akan terus menyempurnakan sistem dan pelayanan kami agar pelanggan semakin terpuaskan.    </p>
                        <br><p>Untuk saat ini, Kami hanya melayani pembelian produk oleh pelanggan yang berdomisili di kawasan Kecamatan Karang Ploso, Kabupaten Malang. Khususnya Perumahan Karangploso View, Bumi Perkasa, Arjuna Gumilang, Permata Regency, GPA, dan sekitarnya. Saran dan kritik yang membangun bisa dikirim lewat nomer WA {{Config::get('app.no_wa')}}. </p>
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