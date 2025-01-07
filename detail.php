<?php
include('scraper/simple_html_dom.php');
include('header.php');

// Mengambil URL anime dari parameter URL
$animeUrl = $_GET['url'];

// Mengambil halaman detail anime
$html = file_get_html($animeUrl);

// Menarik informasi anime seperti gambar besar, deskripsi, dan judul
$animeTitle = $html->find('h1.entry-title', 0)->plaintext;
$animeImage = $html->find('img.wp-post-image', 0)->src;
$animeDescription = $html->find('.entry-content', 0)->innertext;

// Menambahkan fallback gambar jika tidak ditemukan
if (strpos($animeImage, 'http') === false) {
    $animeImage = 'https://samehadaku.today' . $animeImage;
}

// Menarik iframe atau URL video streaming
$iframe = $html->find('iframe', 0); // Menarik elemen iframe pertama

echo '<div class="container mt-5">';
echo '<div class="row">';
echo '<div class="col-md-8 offset-md-2">';

// Card untuk menampilkan gambar besar dan judul anime
echo '<div class="card shadow-lg">';
echo '<img src="' . $animeImage . '" class="card-img-top" alt="' . $animeTitle . '" style="height: 400px; object-fit: cover;">';
echo '<div class="card-body">';
echo '<h2 class="card-title text-center">' . $animeTitle . '</h2>';

// Menampilkan iframe (video) jika ditemukan
if ($iframe) {
    $iframeUrl = $iframe->src; // Mendapatkan URL dari src iframe
    echo '<div class="mt-4">';
    echo '<h4>Video Streaming</h4>';
    echo '<iframe src="' . $iframeUrl . '" frameborder="0" width="100%" height="500px"></iframe>';
    echo '</div>';
} else {
    echo '<p class="text-warning mt-3">Video streaming tidak ditemukan.</p>';
}

echo '<p class="card-text">' . $animeDescription . '</p>';

// Tombol untuk kembali ke halaman utama
echo '<a href="index.php" class="btn btn-secondary btn-block">Kembali ke Daftar Anime</a>';


echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';

include('footer.php');
?>
