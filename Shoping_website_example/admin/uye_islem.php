<?php

error_reporting(E_ALL);
include 'header.php';


if (@$_SESSION['admin'] == 0 || !isset($_SESSION['admin'])) {
    header('Location: main.php');
    exit();
}


ini_set("display_errors",1);
if (isset($_POST['ekle'])) {
    include("inc/baglan.php");
    $id = $_POST['id'];
    $nameSurname = $_POST['nameSurname'];
    $email = $_POST['email'];
    $password =  md5($_POST['password']);
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $bdate = $_POST['birthday'];
    $admin = $_POST['admin'];

    // SQL sorgusu
    $sql = "INSERT INTO kullanicilar (name_surname, email, password, tcno, gender, phone_number, status,birthday,admin) 
            VALUES ('$nameSurname', '$email', '$password', '$tcno', '$gender', '$phone_number', '$status','$bdate','$admin')";
 if(mysqli_query($baglanti, $sql)){
    echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Eklendi.</div>';
}else{
    echo '<div id="uyari" class="alert alert-danger" role="alert">  Eklenemedi.</div>';
}
echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';


}

if (isset($_POST['duzenle'])) {
    include("inc/baglan.php");

    $nameSurname = $_POST['nameSurname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $bdate = $_POST['birthday'];
    $admin = $_POST['admin'];
    $duzenlenecek = $_POST['duzenlenecek'];

    // SQL sorgusu
    if ($_POST['password'] == "") 
    {
        $sql = "UPDATE kullanicilar SET name_surname='$nameSurname', tcno='$tcno',email='$email',
        gender='$gender',phone_number='$phone_number', status='$status',birthday='$bdate',admin='$admin'
        WHERE id='$duzenlenecek'";
    }
    else { 
 $sql = "UPDATE kullanicilar SET name_surname='$nameSurname', tcno='$tcno',email='$email',
    password='$password',gender='$gender',phone_number='$phone_number', status='$status',birthday='$bdate',admin='$admin'
    WHERE id='$duzenlenecek'";
    }
        
   
   
   if(mysqli_query($baglanti, $sql)){
    echo '<div id="uyari" class="alert alert-success" role="alert"> Başarıyla Güncellendi.</div>';
}else{
    echo '<div id="uyari" class="alert alert-danger" role="alert">  Güncellenemedi.</div>';
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
                <div class="content">
                    <h2>Üye Ekle/Düzenle</h2>

                    <?php
                    include 'inc/baglan.php';
                    
                        $id= @$_GET['duzenle'];
                        $kul = mysqli_query($baglanti, 'Select * From kullanicilar WHERE id="' .  $id. '"');
                        $user=mysqli_fetch_array($kul);
                    ?>
                    <form method="POST" >

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="tcno" name="tcno" placeholder="TC no" value="<?=@$user['tcno'] ?>" maxlength="11" class="form-control ">
                                <input type="hidden" name="duzenlenecek" value="<?=@$id ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nameSurname" name="nameSurname" value="<?=@$user['name_surname'] ?>" placeholder="Name Surname" class="form-control ">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <input type="email" id="email" name="email"  value="<?=@$user['email'] ?>"   placeholder="Email Address" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="password" name="password" value="" placeholder="Password" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <select name="gender" class="form-control ">
                                    <option value="F" <?php echo @$user['gender']=='F'?' selected':'' ?>>Kadın</option>
                                    <option value="M" <?php echo @$user['gender']=='M'?' selected':'' ?>>Erkek</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="status" class="form-control ">
                                    <option value="1" <?php echo @$user['status']=='1'?' selected':'' ?>>Aktif</option>
                                    <option value="0" <?php echo @$user['status']=='0'?' selected':'' ?>>Pasif</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="admin" class="form-control ">
                                    <option value="1" <?php echo @$user['admin']=='1'?' selected':'' ?>>Admin</option>
                                    <option value="0" <?php echo @$user['admin']=='0'?' selected':'' ?>>Client</option>
                                    <option value="2" <?php echo @$user['admin']=='2'?' selected':'' ?>>Moderator</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  mt-2">
                            <div class="col-md-6">
                                <input type="text" id="phone_number" name="phone_number" value="<?=@$user['phone_number'] ?>" placeholder="Tel no (555)555 5555" maxlength="10" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="birthday" name="birthday" value="<?=@$user['birthday'] ?>" placeholder="YYYY-MM-DD" maxlength="8" class="form-control pb-2 mb-1 ">
                            </div>
                        </div>
                        <?php 
                        if (isset($_GET['duzenle'])) {
                        echo '<input type="hidden" name="duzenle" >';
                        echo '<input type="submit" class="uyeEkle form-control mt-2" value="Üye Düzenle" name="submit">';
                        }else{
                            echo '<input type="hidden" name="ekle" >';
                            echo '<input type="submit" class="uyeEkle form-control mt-2" value="Üye Ekle" name="submit">';
                        }
                        ?>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>


</body>

</html>