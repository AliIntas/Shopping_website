<?php
include 'header.php';
?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Uye duzenleme</title>
</head>

<body>
    <div class="">
        
        <div class="row">
            <div class="col-md-3 mt-2">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-md-9 mt-2">
                <div class="content">
                    <h2>Üye Düzenle</h2>
                    <?php
                    include 'inc/baglan.php';
                    if (isset($_GET['duzenle'])) {
                        $id= $_GET['duzenle'];
                        $kul = mysqli_query($baglanti, 'Select * From calisanlar WHERE id="' .  $id. '"');
                        $user=mysqli_fetch_array($kul);
                    ?>
                    <form method="POST" action="uye_ekle.php">

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="tcno" name="tcno" placeholder="TC no" value="<?=$user['tcno'] ?>" maxlength="11" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nameSurname" name="nameSurname" value="<?=$user['name_surname'] ?>" placeholder="Name Surname" class="form-control ">
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
                                <input type="email" id="email" name="email"  value="<?=$user['email'] ?>"   placeholder="Email Address" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="password" name="password" value="<?=$user['password'] ?>" placeholder="Password" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <select name="gender" class="form-control ">
                                    <option value="F" <?php echo $user['gender']=='F'?' selected':'' ?>>Kadın</option>
                                    <option value="M" <?php echo $user['gender']=='M'?' selected':'' ?>>Erkek</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="status" class="form-control ">
                                    <option value="1" <?php echo $user['status']=='1'?' selected':'' ?>>Aktif</option>
                                    <option value="0" <?php echo $user['status']=='0'?' selected':'' ?>>Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  mt-2">
                            <div class="col-md-6">
                                <input type="text" id="phone_number" name="phone_number" value="<?=$user['phone_number'] ?>" placeholder="Tel no (555)555 5555" maxlength="10" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="birthday" name="birthday" value="<?=$user['birthday'] ?>" placeholder="YYYY-MM-DD" maxlength="8" class="form-control pb-2 mb-1 ">
                            </div>
                        </div>
                        <input type="submit" class="uyeEkle form-control mt-2" value="Üye Düzenle" name="submit">
                    </form>

                    <?php
                      }else{header("Location: uyeler.php");}
                    ?>
                </div>
            </div>
        </div>

    </div>


</body>

</html>