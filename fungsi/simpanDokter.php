<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];

$namaDokter = $_POST['namaDokterTxt'];
$poli = $_POST['poliTxt'];
$telepon = $_POST['teleponTxt'];
$hasil = 0;
$query = "";

if ($status == 'Edit') {
    $id = $_POST['idDokterTxt'];
    $query = "UPDATE tb_dokter SET nama_dokter = '".$namaDokter."', poli = '".$poli."', telepon = '". $telepon ."' WHERE id_dokter = '". $id ."'";
} else if ($status == 'Tambah') {
    $query = "INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `poli`, `telepon`) VALUES (NULL, '". $namaDokter ."', '". $poli ."', '".$telepon."')";
}

$hasil = mysqli_query($conn, $query);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/dokter.php");