<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idResep = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_resep WHERE id_resep = '". $idResep ."'");
$jsonResep = array();
while ($data = mysqli_fetch_array($query)) {
    $jsonResep[] = $data;
}

echo json_encode($jsonResep);
