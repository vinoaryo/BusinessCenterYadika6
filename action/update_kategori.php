<?php
session_start(); // Mulai session untuk menyimpan pesan
// include file
include "../koneksi.php";
extract($_POST);

$query = "UPDATE categories SET nama_kategori='$nama_kategori' WHERE id='$id' ";

if ($conn->query($query) === TRUE) {
    // Set flash message untuk kategori berhasil diubah
    $_SESSION['flash_message'] = "Kategori berhasil diubah";
    $_SESSION['flash_class'] = "flash-success"; // Class untuk styling (optional)
} else {
    $_SESSION['flash_message'] = "Error: " . $conn->error;
    $_SESSION['flash_class'] = "flash-error"; // Class untuk styling (optional)
}

$conn->close();

header("Location: ../dashboard.php?page=kategori");
