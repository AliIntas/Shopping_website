<?php

include 'admin/header.php';
include 'admin/inc/baglan.php';
$kul_id = $_SESSION['id'];

if (isset($_GET['id'])) {
    $urun_id = $_GET['id'];
    $kul_id = $_SESSION['id'];

    $kul = mysqli_query($baglanti, 'SELECT * FROM sepet WHERE kul_id="' . $kul_id . '" AND urun_id="' .  $urun_id . '" ');

    if (mysqli_num_rows($kul) > 0) {
        mysqli_query($baglanti, 'UPDATE sepet SET adet=adet+1 WHERE kul_id="' . $kul_id . '" AND urun_id="' .  $urun_id . '" ');
    } else {
        mysqli_query($baglanti, "INSERT INTO sepet(kul_id, urun_id, adet) VALUES ('$kul_id', '$urun_id', 1)");
    }
}

if (isset($_GET['azalt'])) {
    $urun_id = $_GET['azalt'];
    $kul_id = $_SESSION['id'];

    $kul = mysqli_fetch_array(mysqli_query($baglanti, 'SELECT * FROM sepet WHERE kul_id="' . $kul_id . '" AND urun_id="' .  $urun_id . '" '));

    if ($kul["adet"] > 1) {
        mysqli_query($baglanti, 'UPDATE sepet SET adet=adet-1 WHERE kul_id="' . $kul_id . '" AND urun_id="' .  $urun_id . '" ');
    } elseif ($kul["adet"] == 1) {
        mysqli_query($baglanti, "DELETE FROM sepet WHERE kul_id='$kul_id' AND urun_id='$urun_id'");
    }
}

if (isset($_GET['sil'] ) || isset($_GET['satinal'] )) {
    $idsil = $_GET['sil'];

    mysqli_query($baglanti, "DELETE FROM sepet WHERE id = $idsil");
}

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
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-md-10 mt-2">
                <div class="content">
                    <h2>Sepetim</h2>
                    <form action="siparislerim.php" method="post">
                        <table class="table">
                            <tr>
                                <th>Ürün Resmi</th>
                                <th>Ürün Adı</th>
                                <th>Adet</th>
                                <th>Fiyat</th>
                                <th>İşlem</th>
                            </tr>
                            <?php
                            $urunler = mysqli_query($baglanti, "SELECT *, sepet.id AS sepetid, urunler.id AS urunid FROM sepet, urunler WHERE urunler.id = sepet.urun_id AND sepet.kul_id = '$kul_id'");
                            while ($r = mysqli_fetch_array($urunler)) {
                                echo "<tr>";
                                echo "<td><img src='admin/" . $r["pic"] . "' width='60'></td>";
                                echo "<td>" . $r["urun_adi"] . "</td>";
                                echo '<td><a href="?azalt=' . $r["urunid"] . '"><i class="fas fa-minus"></i></a> ';
                                echo $r["adet"] . ' <a href="?id=' . $r["urunid"] . '"><i class="fas fa-plus"></i></a></td>';
                                echo "<td>" . $r["price"] * $r["adet"] . "</td>";
                                echo '<td><a href="?sil=' . $r["sepetid"] . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
                                echo "</tr>";
                                
                                // POST ile gönderilecek veriler
                                echo '<input type="hidden" name="sepetid[]" value="' . $r["sepetid"] . '">';
                            }
                            ?>
                        </table>
                        <button type="submit" name="satinal" class="btn btn-primary">Satın Al</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
