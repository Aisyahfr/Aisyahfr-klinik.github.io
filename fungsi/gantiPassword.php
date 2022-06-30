<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];

$passwordLama = $_POST['oldPassword'];
$query = mysqli_query($conn, "SELECT * from tb_user WHERE id_user = '". $_SESSION['id'] ."' AND password = md5('$passwordLama')");
if (mysqli_num_rows($query) != 1) {
    $_SESSION['info'] = "Password lama tidak sesuai";
    header("Location: http://localhost/klinik/gantiPassword.php");;
} else {
    $passwordBaru = $_POST['newPassword'];
    $query = mysqli_query($conn, "UPDATE tb_user SET password = md5('$passwordBaru') WHERE id_user = '". $_SESSION["id"] ."'");
    if ($query == 1) {
        $_SESSION['info'] = "Password berhasil diubah";
        header("Location: http://localhost/klinik/gantiPassword.php");;
    }
}

