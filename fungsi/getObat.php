<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idObat = $_GET['id'];
$query = mysqli_query($conn, "SELECT id_obat, nama_obat, keterangan, harga FROM tb_obat WHERE id_obat = '". $idObat ."'");
$jsonObat = array();
while ($data = mysqli_fetch_array($query)) {
    $jsonObat[] = $data;
}

echo json_encode($jsonObat);
