<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idBerobat = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_berobat WHERE id_berobat = '". $idBerobat ."'");
$jsonObat = array();
while ($data = mysqli_fetch_array($query)) {
    $jsonObat[] = $data;
}

echo json_encode($jsonObat);
