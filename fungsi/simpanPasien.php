<?php 
session_start();
require "../konfigurasi/koneksi.php";

$status = $_POST['status'];
$noIdentitas = $_POST['noIdentitasTxt'];
$namaPasien = $_POST['namaPasienTxt'];
$jenisKelamin = $_POST['jenisKelamin'];
$umur = $_POST['umurTxt'];
$telepon = $_POST['teleponTxt'];

$hasil = 0;
$query = "";

if ($status == 'Edit') {
    $id = $_POST['idPasienTxt'];
    $query = "UPDATE tb_pasien SET nomor_identitas = '".$noIdentitas."', nama_pasien = '".$namaPasien."', jenis_kelamin = '". $jenisKelamin ."', 
    umur = '". $umur ."', telepon = '". $telepon ."' WHERE id_pasien = '". $id ."'";
} else if ($status == 'Tambah') {
    // echo "tambah pasien";
    $query = "INSERT INTO `tb_pasien` (`id_pasien`, `nomor_identitas`, `nama_pasien`, `jenis_kelamin`, `umur`, `telepon`) VALUES 
              (NULL, '". $noIdentitas ."', '". $namaPasien ."', '". $jenisKelamin ."', '". $umur ."', '". $telepon ."')";
}

$hasil = mysqli_query($conn, $query);
// print_r($hasil);
$_SESSION['info'] = ($hasil == 1) ? "Data berhasil disimpan" : "Gagal menyimpan data";
header("Location: http://localhost/klinik/pasien.php");