<?php
session_start();
error_reporting(E_ALL);

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
    $password = $_POST['password'];
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $bdate = $_POST['birthday'];
    $admin = $_POST['admin'];

    // SQL sorgusu
    $sql = "INSERT INTO calisanlar (name_surname, email, password, tcno, gender, phone_number, status,birthday,admin) 
            VALUES ('$nameSurname', '$email', '$password', '$tcno', '$gender', '$phone_number', '$status','$bdate','$admin')";
    mysqli_query($baglanti, $sql);


    header("Location: login.php");
    exit();
}
if (isset($_POST['duzenle'])) {
    include("inc/baglan.php");

    $nameSurname = $_POST['nameSurname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tcno = $_POST['tcno'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $status = $_POST['status'];
    $bdate = $_POST['birthday'];
    $admin = $_POST['admin'];
    $duzenlenecek = $_POST['duzenlenecek'];

    // SQL sorgusu
    $sql = "UPDATE calisanlar SET name_surname='$nameSurname', tcno='$tcno',email='$email',
    password='$password',gender='$gender',phone_number='$phone_number', status='$status',birthday='$bdate',admin='$admin'
    WHERE id='$duzenlenecek'";
   
    mysqli_query($baglanti, $sql);


    header("Location: uyeler.php");
    exit();
}
