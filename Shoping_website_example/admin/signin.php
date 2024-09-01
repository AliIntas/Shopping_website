<?php
session_start();
if (isset($_POST['ekle'])) {
    include("inc/baglan.php");
    $nameSurname = $_POST['nameSurname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);    //md5
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'] === 'Male' ? 'M' : 'F';
    $phone_number = $_POST['phone_number'];
    $bdate = $_POST['birthday'];

    // SQL query
    $sql = "INSERT INTO kullanicilar (name_surname, email, password, tcno, gender, phone_number, status, birthday, admin) 
            VALUES ('$nameSurname', '$email', '$password', '$tcno', '$gender', '$phone_number', '1', '$bdate', '0')";

    if (mysqli_query($baglanti, $sql)) {
        echo '<div id="uyari" class="alert alert-success" role="alert">Başarıyla Eklendi.</div>';
       sleep(1);
       header('Location:../index.php');
    } else {
        echo '<div id="uyari" class="alert alert-danger" role="alert">Eklenemedi.</div>';
    }
    echo '<script> setInterval(function() {document.getElementById("uyari").style.display = "none";},2000);</script>';
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Kayıt</title>
</head>

<body>
    <div class="anaEkran">
        <div class="girisEkrani mt-5">
            <h3 class="text pb-3">Kayıt</h3>
            <form method="POST">
                <input type="text" id="nameSurname" name="nameSurname" placeholder="Name Surname" class="form-control pb-2 mb-1" required>
                <input type="email" id="email" name="email" placeholder="Email Address" class="form-control pb-2 mb-1" required>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="30" class="form-control pb-2 mb-1" required>
                <input type="text" id="tcno" name="tcno" placeholder="TC No" maxlength="11" class="form-control pb-2 mb-1" required>


                <select id="gender" name="gender" class="form-control pb-2 mb-1" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" maxlength="10" class="form-control pb-2 mb-1" required>
                <input type="date" id="birthday" name="birthday" class="form-control pb-2 mb-1" required>
                <input type="submit" class="signinButton form-control mt-3" value="Kayıt ol" name="ekle">
                <div class="giris_kayitButton mt-2">
                    <a href="../kul_giris.php">Giriş yap</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>