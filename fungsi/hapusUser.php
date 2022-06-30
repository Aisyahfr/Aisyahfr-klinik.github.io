<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idUser = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = '". $idUser ."'");
$_SESSION['info'] = ($query == 1) ? "Data berhasil dihapus" : "Gagal menghapus data";
header("Location: http://localhost/klinik/user.php");
