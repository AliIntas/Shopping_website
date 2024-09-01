<?php

include("inc/baglan.php");
include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($baglanti, "SELECT * FROM kullanicilar,bio WHERE kullanicilar.id=cid AND kullanicilar.id = $id");
}


?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Üye Bilgileri</title>
</head>

<body>
    <div class="">

        <div class="row">
            <div class="col-md-3 mt-2">
                <?php include 'menu.php'; ?>

            </div>
            <div class="col-md-9 mt-2">
                <div class="content">
                    <h2>Üye Bilgileri</h2>
                    <br>
                    <?php
                    if ($row = mysqli_fetch_array($result)) {

                        echo "<p><strong>Adı Soyadı:</strong> " . $row["name_surname"] . "</p>";
                        echo "<p><strong>Kimlik No:</strong> " . $row["tcno"] . "</p>";
                        echo "<p><strong>Cinsiyet:</strong> " . ($row["gender"] == "M" ? 'Erkek' : 'Kadın') . "</p>";
                        echo "<p><strong>Doğum Tarihi:</strong> " . $row["birthday"] . "</p>";
                        echo "<p><strong>E-posta:</strong> " . $row["email"] . "</p>";
                        echo "<p><strong>Telefon:</strong> " . $row["phone_number"] . "</p>";
                        echo "<p><strong>Durum:</strong> " . (($row["status"] == 1) ? 'Aktif' : 'Pasif') . "</p>";
                        echo "<p><strong>Şifre:</strong> " . $row["password"] . "</p>";
                        echo "<p><strong>Yetki:</strong> " .(($row["admin"] == 1) ? 'Admin' : (($row["admin"] == 2) ? 'Moderator' : 'Client')) ."</p>";
                        echo "<p><strong>Biografi:</strong> " . $row["biography"] . "</p>";
                    } else {
                        echo "<p>Üye bulunamadı.</p>";
                    }

                    ?>
                </div>
            </div>
        </div>

    </div>

</body>

</html>