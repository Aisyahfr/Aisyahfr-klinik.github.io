<?php 
require '../konfigurasi/koneksi.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($conn, "SELECT id_user, username, level from tb_user WHERE username = '". $username ."' AND password = MD5('$password')");
while($data = mysqli_fetch_array($query)) {
    $_SESSION["id"] = $data["id_user"];
    $_SESSION["level"] = $data["level"];
}

if ($query == 1) {
    header("Location: http://localhost/klinik/home.php");
} else {
    header("Location: http://localhost/klinik");
}