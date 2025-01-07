<?php
include('scraper/simple_html_dom.php');
include('header.php');

$url = 'https://samehadaku.today/';
$html = file_get_html($url);

echo '<div class="container mt-5">';
echo '<h1 class="text-center mb-4">Daftar Anime Terbaru</h1>';
echo '<div class="row">';

foreach ($html->find('article') as $article) {
    $animeTitle = $article->find('h2', 0)->plaintext;
    $animeLink = $article->find('a', 0)->href;
    
    // Mendapatkan gambar anime
    $animeImage = $article->find('img', 0)->src;

    // Memastikan URL gambar lengkap (menambahkan domain jika perlu)
    if (strpos($animeImage, 'http') === false) {
        $animeImage = 'https://samehadaku.today' . $animeImage;
    }

    // Menampilkan card dengan gambar dan judul anime
    echo '<div class="col-md-4 mb-4">';
    echo '<div class="card shadow-sm rounded border-light">';
    
    // Memastikan gambar dapat ditampilkan
    echo '<img src="' . $animeImage . '" class="card-img-top rounded-top" alt="' . $animeTitle . '" style="height: 200px; object-fit: cover;">';
    
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $animeTitle . '</h5>';
    echo '<a href="detail.php?url=' . urlencode($animeLink) . '" class="btn btn-primary btn-block">Lihat Detail</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';
echo '</div>';

include('footer.php');
?>
