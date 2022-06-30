<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];
$namaObat = $_POST['namaObatTxt'];
$keterangan = $_POST['keteranganTxt'];
$harga = $_POST['hargaTxt'];
$hasil = 0;
$query = "";

if ($status == 'Edit') {
    $id = $_POST['idObatTxt'];
    $query = "UPDATE tb_obat SET nama_obat = '".$namaObat."', keterangan = '".$keterangan."', harga = '".$harga."' WHERE id_obat = '". $id ."'";
} else if ($status == 'Tambah') {
    $query = "INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `keterangan`, `harga`) VALUES (NULL, '". $namaObat ."', '". $keterangan ."', '".$harga."')";
}

$hasil = mysqli_query($conn, $query);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/obat.php");