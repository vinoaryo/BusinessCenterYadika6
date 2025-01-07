<?php
date_default_timezone_set('Asia/Jakarta');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";
// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
