<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idBerobat = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM tb_berobat WHERE id_berobat = '". $idBerobat ."'");
$_SESSION['info'] = ($query == 1) ? "Data berhasil dihapus" : "Gagal menghapus data";
header("Location: http://localhost/klinik/rekam_medis.php");