<?php

include 'admin/header.php';
include 'admin/inc/baglan.php';

// Oturumdan kullanıcı ID'sini al
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if (isset($_POST['duzenle'])) {
    include 'admin/inc/baglan.php';

    $nameSurname = $_POST['name_surname'];
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); //md5
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $bdate = $_POST['birthday'];
    $bio = $_POST['bio'];


    $duzenlenecek = $_POST['duzenlenecek'];

    // SQL sorgusu
    if ($_POST['password'] == "") {
        $sql = "UPDATE kullanicilar SET name_surname='$nameSurname', tcno='$tcno', email='$email',
         gender='$gender', phone_number='$phone_number', status='$status', birthday='$bdate'
    WHERE id='$duzenlenecek'";
    } else {
        $sql = "UPDATE kullanicilar SET name_surname='$nameSurname', tcno='$tcno', email='$email',
    password='$password', gender='$gender', phone_number='$phone_number', status='$status', birthday='$bdate'
    WHERE id='$duzenlenecek'";
    }
    $sql2 = "UPDATE bio SET biography='$bio' WHERE cid='$duzenlenecek'";


    if (mysqli_query($baglanti, $sql) and mysqli_query($baglanti, $sql2)) {
        echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Güncellendi.</div>';
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert"> Başarıyla Güncellenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}





if ($id) {
    $kul = mysqli_query($baglanti, 'SELECT * FROM kullanicilar WHERE id=' . $id);
    $user = mysqli_fetch_array($kul);

    $bio = mysqli_query($baglanti, 'SELECT * FROM bio WHERE cid=' . $id);
    $biog = mysqli_fetch_array($bio);
} else {
    echo "Kullanıcı ID'si bulunamadı.";
    exit();
}
?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/assets/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/style.css">
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <title>Bilgilerim</title>
</head>

<body>
    <div class="">
        <div class="row">
            <div class="col-md-2 mt-2">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-md-10 mt-2">
                <div class="content">
                    <h2>Bilgilerim</h2>
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="tcno" value="<?= (@$user['tcno']) ?>" class="form-control" readonly>
                                <input type="hidden" name="duzenlenecek" value="<?= (@$id) ?>">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="name_surname" value="<?= (@$user['name_surname']) ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input type="email" id="email" name="email" value="<?= (@$user['email']) ?>" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="password" id="password" name="password" value="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <select name="gender" class="form-control">
                                    <option value="F" <?= @$user['gender'] == 'F' ? 'selected' : '' ?>>Kadın</option>
                                    <option value="M" <?= @$user['gender'] == 'M' ? 'selected' : '' ?>>Erkek</option>
                                </select>

                            </div>
                            <div class="col-md-12">
                                <select name="status" class="form-control">
                                    <option value="1" <?= $user['status'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= $user['status'] == '0' ? 'selected' : '' ?>>Pasif</option>
                                </select>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input type="text" id="phone_number" name="phone_number" value="<?= (@$user['phone_number']) ?>" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="date" id="birthday" name="birthday" value="<?= (@$user['birthday']) ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <textarea name="bio" class="form-control" rows="4"><?= @$biog['biography'] ?></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="duzenle" value="1">
                        <input type="submit" class="uyeEkle form-control mt-2" value="Bilgilerimi Güncelle" name="submit">
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>