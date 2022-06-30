<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];
$pasien = $_POST['pasienSelect'];
$dokter = $_POST['dokterSelect'];
$tglBerobat = $_POST['tanggalBerobat'];
$keluhan = $_POST['keluhanTxt'];
$diagnosa = $_POST['diagnosaTxt'];

$hasil = 0;
$query = "";

if ($status == 'Edit') {
    $id = $_POST['idRekamMedisTxt'];
    
    $query = "UPDATE tb_berobat SET id_pasien = '".$pasien."', id_dokter = '".$dokter."', tgl_berobat = '". $tglBerobat ."', 
    keluhan_pasien = '". $keluhan ."', hasil_diagnosa = '". $diagnosa ."' WHERE id_berobat = '". $id ."'";
} else if ($status == 'Tambah') {
    // echo "tambah pasien";
    $query = "INSERT INTO `tb_berobat` (`id_berobat`, `id_pasien`, `id_dokter`, `tgl_berobat`, `keluhan_pasien`, `hasil_diagnosa`) VALUES 
              (NULL, '". $pasien ."', '". $dokter ."', '". $tglBerobat ."', '". $keluhan ."', '". $diagnosa ."')";
}

$hasil = mysqli_query($conn, $query);
// print_r($hasil);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/rekam_medis.php");