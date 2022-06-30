<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idDokter = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM tb_dokter WHERE id_dokter = '". $idDokter ."'");
$_SESSION['info'] = ($query == 1) ? "Data berhasil dihapus" : "Gagal menghapus data";
header("Location: http://localhost/klinik/dokter.php");
