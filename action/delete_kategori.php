<?php
session_start(); // Mulai session untuk menyimpan pesan
// include file
include "../koneksi.php";
extract($_GET);

$query = "DELETE FROM categories WHERE id='$id' ";

if ($conn->query($query) === TRUE) {
    $_SESSION['flash_message'] = "Kategori berhasil dihapus";
    $_SESSION['flash_class'] = "flash-success"; // Class untuk styling (optional)
} else {
    $_SESSION['flash_message'] = "Error: " . $conn->error;
    $_SESSION['flash_class'] = "flash-error"; // Class untuk styling (optional)
}

$conn->close();

header("Location: ../dashboard.php?page=kategori");
