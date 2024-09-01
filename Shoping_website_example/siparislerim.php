<?php
include 'admin/header.php';
include 'admin/inc/baglan.php';

$kul_id = $_SESSION['id'];

if (!$kul_id) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['satinal'])) {
    $sepetid = $_POST['sepetid'];
    mysqli_query($baglanti, "INSERT INTO siparis (kul_id) VALUES ('$kul_id')");
    $siparis_id = mysqli_insert_id($baglanti);

    foreach ($sepetid as $sepet_id) {
        $sepet = mysqli_fetch_array(mysqli_query($baglanti, "select * from sepet where id=" . $sepet_id));
        $urun_adet = $sepet["adet"];
        $urun = mysqli_fetch_array(mysqli_query($baglanti, "select * from urunler where id=" . $sepet["urun_id"]));
        $urun_id = $sepet["urun_id"];
        $urun_adi = $urun["urun_adi"];
        $urun_fiyati = $urun["price"];
        @$toplam_fiyat += $urun_fiyati * $urun_adet;
        mysqli_query($baglanti, "INSERT INTO siparisler (siparis_id, urun_id, urun_adi, urun_adet, urun_fiyati) VALUES ('$siparis_id', '$urun_id', '$urun_adi', '$urun_adet', '$urun_fiyati')");
        $sepetsil = mysqli_query($baglanti, "delete from sepet where id=" . $sepet_id);
    }
    mysqli_query($baglanti, "update siparis set toplam_fiyat='$toplam_fiyat' where id=" . $siparis_id);
}

$siparisler = mysqli_query($baglanti, "SELECT * FROM siparis where kul_id=" . $kul_id);
?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/assets/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/style.css">
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <title>Siparişlerim</title>

</head>

<body>
    <div class="">
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-md-10 ">
                <div class="content">
                    <h2>Siparişlerim</h2>
                    <?php
                    while ($siparis = mysqli_fetch_array($siparisler)) {
                        $siparis_id = $siparis["id"];
                        echo "<div class='siparis'>";

                        // Sipariş başlık bilgileri için tablo
                        echo '<div class=" siparis-table">
                               <div><b>Sipariş Kodu : </b>'. $siparis["id"] .'</div>
                               <div><b>Sipariş Tarihi : </b>'. $siparis["siparis_tarihi"] .'</div>
                               <div><b>Toplam Fiyat : </b>'. $siparis["toplam_fiyat"] .'</div></div>';

                        // Sipariş detaylarını gösteren tablo
                        $siparis_detaylar = mysqli_query($baglanti, "SELECT * FROM siparisler,urunler WHERE siparisler.urun_id=urunler.id AND siparis_id = $siparis_id");
                        echo "<table class='table siparis-detaylar'>
                                <tr>
                                    
                                    <th>Ürün Resmi</th>
                                    <th>Ürün Adı</th>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                </tr>";
                        while ($detay = mysqli_fetch_array($siparis_detaylar)) {
                            echo "<tr>";
                            
                            echo "<td><img src='admin/" . $detay["pic"] . "' width='60'></td>";
                            echo "<td>" . $detay['urun_adi'] . "</td>";
                            echo "<td>" . $detay['urun_adet'] . "</td>";
                            echo "<td>" . $detay['urun_fiyati'] . " TL</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
