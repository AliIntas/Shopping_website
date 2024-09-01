<?php
include("admin/inc/baglan.php");

$kat_id = isset($_GET['kat']) ? $_GET['kat'] : 0;
?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/assets/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/style.css">
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <title>Alışveriş</title>
</head>

<body>
    <div class="">
        <?php include 'admin/header.php'; ?>
        <div class="row">
            <div class="menu col-md-2 mt-2">
                <?php include 'kategori.php'; ?>
            </div>
            <div class="col-md-10 mt-2">
                <div class="content">
                    <div class="urunler row">
                        <?php


                        $sorgu = "SELECT * FROM urunler WHERE durum = 1";
                        if ($kat_id > 0) {
                            $sorgu .= " AND k_id = $kat_id";
                        }




                        $urunler = mysqli_query($baglanti, $sorgu);

                        if (mysqli_num_rows($urunler) > 0) {
                            while ($urun = mysqli_fetch_array($urunler)) {
                                echo '<div class="col-md-3">';
                                echo '<div class="card mb-4">';
                                echo '<div class="card-body">';
                                echo '<img src="admin/' . $urun["pic"] . '" class="card-img-top " alt="' . $urun["urun_adi"] . '" style="width:100%;"> ';
                                echo '<h5 class="card-title">' . $urun["urun_adi"] . '</h5>';
                                echo '<p class="card-text">Fiyat: ' . $urun["price"] . ' TL</p>';
                                echo '<p class="card-text">Stok: ' . $urun["amount"] . '</p>';
                                echo '<a href="_urun_incele.php?id=' . $urun["id"] . '" class="btn btn-primary">Ürünü İncele</a>';
                                if (isset($_SESSION['kullanici'])) {
                                    echo ' <a href="sepete_ekle.php?id=' . $urun["id"] . '" class="btn btn-success ml-3">Sepete Ekle</a>';
                                    $_SESSION['urun_name'] =$urun["urun_adi"];
                                }
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Bu kategoride ürün bulunmamaktadır.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>