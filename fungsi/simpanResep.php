<?php 
session_start();
require "../konfigurasi/koneksi.php";

$idBerobat = 2;
$status = $_POST['status'];

$namaObat = $_POST['obatSelect'];
$jumlah = $_POST['jumlahTxt'];
$hasil = 0;
$query = "";

if ($status == 'Edit') {
    $id = $_POST['idResep'];
    $query = "UPDATE tb_resep SET id_obat = '".$namaObat."', jumlah = '".$jumlah."' WHERE id_resep = '". $id ."'";
} else if ($status == 'Tambah') {
    $query = "INSERT INTO `tb_resep` (`id_resep`, `id_berobat`, `id_obat`, `jumlah`) VALUES (NULL, '". $idBerobat ."', '". $namaObat ."', '".$jumlah."')";
}

$hasil = mysqli_query($conn, $query);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/resep.php?id=".$idBerobat);