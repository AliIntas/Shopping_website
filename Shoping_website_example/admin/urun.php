<?php


include("inc/baglan.php");
include 'header.php';

if (!($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2)) {
    header('Location: main.php');
    exit();
}

if (isset($_POST['ekle'])) {
    $urun_adi = $_POST['urun_adi'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $kategori_id = $_POST['kategori'];
    $durum = $_POST['durum'];

    // Resim yükleme işlemi
    if (isset($_FILES['urun_resmi']) && $_FILES['urun_resmi']['error'] == 0) {
        $dosyauzanti = @end(explode(".", $_FILES['urun_resmi']['name']));
        $dosyaGeciciYol = $_FILES['urun_resmi']['tmp_name'];
        $hedefYol = "picture/" . date("dmYHis") . "-" . rand() . "." . $dosyauzanti;
        if (move_uploaded_file($dosyaGeciciYol, $hedefYol)) {
            $resimYolu = $hedefYol;
        } else {
            echo "Resim yüklenirken hata oluştu.";
            $resimYolu = null;
        }
    } else {
        $resimYolu = null;
    }

    $sql = "INSERT INTO urunler (urun_adi, amount, price, k_id, durum, pic) VALUES ('$urun_adi', '$amount', '$price', '$kategori_id', '$durum', '$resimYolu')";

    if (mysqli_query($baglanti, $sql)) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Eklendi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert">  Eklenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}



if (isset($_POST['duzenle'])) {
    $urun_adi = $_POST['urun_adi'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $kategori = $_POST['kategori'];
    $duzenlenecek = $_POST['duzenlenecek'];
    $durum = $_POST['durum'];
   

    // Yeni resim yükleme işlemi
    if (isset($_FILES['urun_resmi']) && $_FILES['urun_resmi']['error'] == 0) {
    $dosyauzanti = @end(explode(".", $_FILES['urun_resmi']['name']));
    $dosyaGeciciYol = $_FILES['urun_resmi']['tmp_name'];
    $hedefYol = "picture/" . date("dmYHis") . "-" . rand() . "." . $dosyauzanti;


        if (move_uploaded_file($dosyaGeciciYol, $hedefYol)) {
            $resimYolu = $hedefYol;
            $urunler1 = mysqli_query($baglanti, 'Select pic From urunler WHERE id="' .  $duzenlenecek. '"');
            $urun1 = mysqli_fetch_array($urunler1);
            @unlink($urun1['pic'] );
            $sql = "UPDATE urunler SET urun_adi='$urun_adi', amount='$amount', price='$price', 
            k_id='$kategori', durum='$durum', pic='$resimYolu' WHERE id='$duzenlenecek'";
        } 
            
        
    } else {
        $sql = "UPDATE urunler SET urun_adi='$urun_adi', amount='$amount', price='$price', 
        k_id='$kategori', durum='$durum' WHERE id='$duzenlenecek'";
    }

    // SQL sorgusu

    if (mysqli_query($baglanti, $sql)) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Güncellendi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert"> Güncellenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}



if (isset($_GET['sil'])) {
    $id = $_GET['sil'];

    if (mysqli_query($baglanti, "DELETE FROM urunler WHERE id = $id")) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Silindi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert">  Silinemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}


?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.css">
    <title>Ürünler</title>
</head>

<body>

    <div class="row">
        <div class="col-md-3 mt-2">
            <?php include 'menu.php'; ?>
        </div>
        <div class="col-md-9 mt-2">

            <?php
            $id = @$_GET['duzenle'];
            $urunler = mysqli_query($baglanti, 'Select * From urunler WHERE id="' .  $id . '"');
            $urun = mysqli_fetch_array($urunler);
            ?>

            <div class="">
                <h2>Ürün Ekle</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="urun_adi">Ürün Adı</label>
                        <input type="hidden" name="duzenlenecek" value="<?= @$id ?>">
                        <input type="text" name="urun_adi" id="urun_adi" class="form-control" value="<?= @$urun['urun_adi'] ?>" required>

                    </div>
                    <div class="form-group">
                        <label for="amount">Miktar</label>
                        <input type="number" name="amount" id="amount" class="form-control" value="<?= @$urun['amount'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Fiyat</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" value="<?= @$urun['price'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <?php
                            $kategoriler = mysqli_query($baglanti, 'SELECT * FROM kategoriler WHERE durum =1');
                            while ($r = mysqli_fetch_array($kategoriler)) {
                                echo '<option value="' . $r["id"] . '"';
                                echo @$urun['k_id'] == $r["id"] ? ' selected' : '';
                                echo  '>' . $r["kategori_adi"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="durum">Durum</label>
                        <select name="durum" class="form-control">
                            <option value="1" <?= @$urun['durum'] == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= @$urun['durum'] == 0 ? 'selected' : '' ?>>Pasif</option>
                        </select>
                    </div>
                    <label for="urun_resmi">Ürün Resmi </label>
                    <div class="form-group">
                        <input type="file" name="urun_resmi" id="urun_resmi" accept="image/*">
                       
                    </div>
                    <?php

                    if (isset($_GET['duzenle'])) {
                        echo '<input type="hidden" name="duzenle" >';
                        echo '<input type="submit" class="uyeEkle form-control mt-2" value="Ürün Düzenle" name="submit">';
                    } else {
                        echo '<input type="hidden" name="ekle" >';
                        echo '<input type="submit" class="uyeEkle form-control mt-2" value="Ürün Ekle" name="submit">';
                    }
                    ?>
                </form>
            </div>
            <br>
            <h2>Ürünler</h2>
            <table class="table">
                <tr>
                    <th>Ürün Resmi</th>
                    <th>Ürün Adı</th>
                    <th>Miktar</th>
                    <th>Fiyat</th>
                    <th>Kategori</th>
                    <th>Durum</th>
                    <th>İşlem</th>


                </tr>
                <?php
                $urunler = mysqli_query($baglanti, 'SELECT urunler.*,kategoriler.kategori_adi FROM urunler,kategoriler WHERE k_id = kategoriler.id');
                while ($r = mysqli_fetch_array($urunler)) {
                    echo "<tr>";
                    echo "<td><img src='" . $r["pic"] . "' width='60'></td>";
                    echo "<td>" . $r["urun_adi"] . "</td>";
                    echo "<td>" . $r["amount"] . "</td>";
                    echo "<td>" . $r["price"] . "</td>";
                    echo "<td>" . $r["kategori_adi"] . "</td>";
                    echo "<td>" . ($r["durum"] == 0 ? 'Pasif' : 'Aktif') . "</td>";
                    echo '<td><a href="?sil=' . $r["id"] . '" class="btn btn-danger"><i class ="fas fa-trash"></i></a> - ';
                    echo '<a href="?duzenle=' . $r["id"] . '" class="btn btn-success" ><i class ="fas fa-pencil-alt"></i></a></td>';
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </div>

</body>

</html>