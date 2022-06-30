<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idDokter = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_dokter WHERE id_dokter = '". $idDokter ."'");
$jsonDokter = array();
while ($data = mysqli_fetch_array($query)) {
    $jsonDokter[] = $data;
}

echo json_encode($jsonDokter);
