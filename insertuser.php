<?php
// include file
include "koneksi.php";

// Hash password dan masukkan ke database
$username = 'admin';
$password = password_hash('adminpassword', PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($query) === TRUE) {
    echo "User berhasil ditambahkan";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
