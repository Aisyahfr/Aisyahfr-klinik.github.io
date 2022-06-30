<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idPasien = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM tb_pasien WHERE id_pasien = '". $idPasien ."'");
$_SESSION['info'] = ($query == 1) ? "Data berhasil dihapus" : "Gagal menghapus data";
header("Location: http://localhost/klinik/pasien.php");