<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];

$username = $_POST['usernameTxt'];
$password = '1234';
$level = $_POST['levelSelect'];
$hasil = 0;
$query = "";
$id = $_POST['idUserTxt'];

if ($status == 'Edit') {
    $query = "UPDATE tb_user SET username = '".$username."', level = '".$level."' WHERE id_user = '". $id ."'";
} else if ($status == 'Tambah') {
    $query = "INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`) VALUES (NULL, '". $username ."', md5('". $password ."'), '".$level."')";
}

$hasil = mysqli_query($conn, $query);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/user.php");