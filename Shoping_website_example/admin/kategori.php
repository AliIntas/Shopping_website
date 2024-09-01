<?php
include("inc/baglan.php");
include 'header.php';

if (!($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2)) {
    header('Location: main.php');
    exit();
}
if (isset($_POST['ekle'])) {


    $kategori_adi = $_POST['kategori_adi'];
    $durum = $_POST['durum'];


    // SQL sorgusu
    $sql = "INSERT INTO kategoriler (kategori_adi, durum) VALUES ('$kategori_adi', $durum)";
    if (mysqli_query($baglanti, $sql)) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Eklendi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert">  Eklenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}

if (isset($_POST['duzenle'])) {

    $kategori_adi = $_POST['kategori_adi'];
    $durum = $_POST['durum'];
    $duzenlenecek = $_POST['duzenlenecek'];
    // SQL sorgusu
    $sql = "UPDATE kategoriler SET kategori_adi='$kategori_adi', durum=$durum  WHERE id='$duzenlenecek'";

    if (mysqli_query($baglanti, $sql)) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Güncellendi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert">  Güncellenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}


if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
  
    if( mysqli_query($baglanti, "DELETE FROM kategoriler WHERE id = $id")){
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Silindi.</div>';
    }else{
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
    <title>Kategoriler</title>
</head>

<body>

    <div class="row">
        <div class="col-md-3 mt-2">
            <?php include 'menu.php'; ?>
        </div>
        <div class="col-md-9 mt-2">

            <?php


            $id = @$_GET['duzenle'];
            $kat = mysqli_query($baglanti, 'Select * From kategoriler WHERE id="' .  $id . '"');
            $kategori = mysqli_fetch_array($kat);
            ?>
            <div class="">
                <h2>Kategori Ekle</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="urun_adi">Kategori Adı</label>
                        <input type="hidden" name="duzenlenecek" value="<?= $id ?>">
                        <input type="text" name="kategori_adi" class="form-control" value="<?= @$kategori['kategori_adi'] ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="urun_adi">Durum</label>
                                <select name="durum" class="form-control">
                                    <option value="1" <?= @$kategori['durum'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= @$kategori['durum'] == '0' ? 'selected' : '' ?>>Pasif</option>
                                </select>
                            </div> 

                    <?php

                    if (isset($_GET['duzenle'])) {
                        echo '<input type="hidden" name="duzenle" >';
                        echo '<input type="submit" class="uyeEkle form-control mt-2" value="Kategori Düzenle" name="submit">';
                    } else {
                        echo '<input type="hidden" name="ekle" >';
                        echo '<input type="submit" class="uyeEkle form-control mt-2" value="Kategori Ekle" name="submit">';
                    }
                    ?>

                    
                </form>
            </div>

            <div class="">
                <h2>Kategoriler</h2>
                <table class="table">
                    <tr>
                        <th>Kategori Adı</th>
                        <th>Durum</th>
                        <th>İslem</th>
                    </tr>
                    <?php
                    // Ürünler ve kategorilerini çekmek için SQL sorgusu
                    $kategoriler = mysqli_query($baglanti, 'SELECT *  FROM kategoriler');

                    // Ürünleri ve kategorilerini tabloya ekleyelim
                    while ($r = mysqli_fetch_array($kategoriler)) {
                        echo "<tr>";
                        echo "<td>" . $r["kategori_adi"] . "</td>";
                        echo "<td>";
                        echo $r["durum"] ==0 ? "Pasif":"Aktif";
                        echo "</td>";
                        echo '<td><a href="?sil=' . $r["id"] . '" class="btn btn-danger"><i class ="fas fa-trash"></i></a> - ';
                        echo '<a href="?duzenle=' . $r["id"] . '" class="btn btn-success" ><i class ="fas fa-pencil-alt"></i></a></td>';
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>