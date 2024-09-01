<?php
session_start();

// if user already login then run main.php
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}



if (isset($_POST["submit"])) {
    include("admin/inc/baglan.php");
    $username = $_POST["username"];
    $password = md5($_POST["password"]); //md5

    $kul = mysqli_query($baglanti, 'SELECT * FROM kullanicilar WHERE tcno="' . $username . '" AND password="' . $password . '" AND status=1 AND admin=0');

    if (mysqli_num_rows($kul) > 0) {
        $user=mysqli_fetch_array($kul);
        $_SESSION["username"] = $user["name_surname"];
        $_SESSION["kullanici"] = $user["name_surname"];
        $_SESSION['email'] = $user["email"];
        $_SESSION['tel'] = $user["phone_number"];
        $_SESSION['admin'] = $user["admin"];
        $_SESSION['id'] = $user["id"]; //iletisim.php için
        header("Location: index.php");

        exit();
    } else {
        echo "Kullanıcı adı ,şifre yanlış veya kullanıcı pasif veya Admin";
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/assets/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/style.css">
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <title>Kullanıcı Girişi</title>
</head>

<body>
    <div class="anaEkran">
        <div class="girisEkrani ">
            <h5 class="text">Kullanıcı Girişi</h5>
            <form method="POST" action="">
                <input type="text" id="username" name="username" placeholder="Email Address" maxlength="11" class="form-control  pb-2 mb-1">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control  pb-2 mb-1">
                <input type="submit" class="loginButton form-control mt-3" value="Giriş" name="submit">
                <div class="giris_kayitButton mt-2">
                    <a href="admin/signin.php">Kayıt ol</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>