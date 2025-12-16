<?php
// TAMPILKAN ERROR PHP (biar kalau salah, kelihatan pesannya)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";      // ganti kalau beda
$pass = "";          // ganti kalau ada password
$db   = "pmb_udsa";  // nama DB di atas

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
