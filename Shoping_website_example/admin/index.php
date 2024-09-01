<?php
session_start();

// if user already login then run main.php
if (isset($_SESSION["username"])) {
    header("Location: main.php");
    exit();
}



if (isset($_POST["submit"])) {
    include("inc/baglan.php");
    $username = $_POST["username"];
    $password = md5($_POST["password"]); //md5


    $kul = mysqli_query($baglanti, 'Select * From kullanicilar WHERE tcno="' . $username . '" and password="' . $password . '" AND status=1 AND admin !=0');
    if (mysqli_num_rows($kul) > 0) {
        $user=mysqli_fetch_array($kul);
        $_SESSION["username"] = $user["name_surname"];
        $_SESSION['email'] = $user["email"];
        $_SESSION['tel'] = $user["phone_number"];
        $_SESSION['admin'] = $user["admin"];
        $_SESSION['id'] = $user["id"]; //iletisim.php için
        header("Location: main.php");

        exit();
    } else {
        echo "Kullanıcı adı ,şifre yanlış veya kullanıcı pasif";
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Admin Giriş</title>
</head>

<body>
    <div class="anaEkran">
        <div class="girisEkrani mt-5">
            <h3 class="text pb-3"> Admin Giriş</h3>
            <form method="POST" action="">
                <input type="text" id="username" name="username" placeholder="Email Address" maxlength="11" class="form-control  pb-2 mb-1">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control  pb-2 mb-1">
                <input type="submit" class="loginButton form-control mt-3" value="Giriş" name="submit">
                <div class="giris_kayitButton mt-2">
                    <a href="signin.php">Kayıt ol</a>
                </div>
                <a href="../kul_giris.php" style="display: block; text-align: left;">Kullanıcı Girişi</a>
            </form>
        </div>
    </div>
</body>

</html>