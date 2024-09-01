<?php
include("admin/inc/baglan.php");

// Kategorileri çekmek için SQL sorgusu
$kategoriler = mysqli_query($baglanti, 'SELECT * FROM kategoriler WHERE durum = 1');
echo 'Kategoriler';
echo '<ul>';
while ($r = mysqli_fetch_array($kategoriler)) {
    echo '<li>';
    echo '<a href="?kat=' . $r["id"] . '">' . $r["kategori_adi"] . '</a>';
    echo '</li>';
}
echo '</ul>';
echo '<hr>';


if (isset($_SESSION['kullanici'])) { // oturum işlemleri
    echo '  <a href="main.php" style="color:black">' . $_SESSION['kullanici'] . '</a>'; 
    echo ' | <a href="admin/exit.php" style="color:#e74c3c;">Çıkış Yap</a>'; 
} else { 
    //include("kul_giris.php");
    echo '<a href="kul_giris.php" style="color:rgb(72, 132, 221); padding-left: 78px;">Giriş yap</a>'; 
}


?>
 

