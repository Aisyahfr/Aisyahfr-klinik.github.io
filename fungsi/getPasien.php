<?php 
session_start();
require '../konfigurasi/koneksi.php';

$idPasien = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pasien WHERE id_pasien = '". $idPasien ."'");
$jsonPasien = array();
while ($data = mysqli_fetch_array($query)) {
    $jsonPasien[] = $data;
}

echo json_encode($jsonPasien);
