<?php

include("inc/baglan.php");
include 'header.php';

if (@$_SESSION['admin'] == 0 || !isset($_SESSION['admin'])) {
    header('Location: main.php');
    exit();
}



if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
  
    if( mysqli_query($baglanti, "DELETE FROM kullanicilar WHERE id = $id")){
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
    <title>Site Başlığı</title>
</head>

<body>
    <div class="">
        
        <div class="row">
            <div class="col-md-3 mt-2">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-md-9 mt-2">
                <h2>Kayıtlı Üyeler</h2>
                <a class="btn btn-success" href="Uye_islem.php">Üye Ekle</a>
                <table class="table">
                    <tr>
                        <th>Adı Soyadı</th>
                        <th>Kimlik No</th>
                        <th>Mail</th>
                        <th>Telefon</th>
                        <th>işlem</th>
                    </tr>
                    <?php

                    $kul = mysqli_query($baglanti, 'Select * From kullanicilar ');
                    while ($r = mysqli_fetch_array($kul)) {
                        echo "<tr>";
                        echo "<td>" . $r["name_surname"] . "</td>";
                        echo "<td>" . $r["tcno"] . "</td>";
                        echo "<td>" . $r["email"] . "</td>";
                        echo "<td>" . $r["phone_number"] . "</td>";
                        echo '<td><a href="?sil=' . $r["id"] . '"  class="btn btn-danger"><i class ="fas fa-trash"></i></a> - 
                        <a href="uye_islem.php?duzenle=' . $r["id"] . '" class="btn btn-success" ><i class ="fas fa-pencil-alt"></i></a> -
                        <a href="info.php?id=' . $r["id"] . '"  class="btn btn-info"><i class ="fas fa-info"></i></a>
                        </td>';
                        echo "</tr>";
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>


</body>

</html>