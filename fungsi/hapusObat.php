<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idObat = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM tb_obat WHERE id_obat = '". $idObat ."'");
$_SESSION['info'] = ($query == 1) ? "Data berhasil dihapus" : "Gagal menghapus data";
header("Location: http://localhost/klinik/obat.php");