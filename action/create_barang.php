<?php
session_start(); // Mulai session untuk menyimpan pesan
// include file
include "../koneksi.php";
extract($_POST);

$query = "INSERT INTO products 
(kode,nama_produk,category_id,stok,harga) 
VALUES 
(
'$kode',
'$nama_product',
'$category_id',
'$stok',
'$harga'
)";

if ($conn->query($query) === TRUE) {
    // Set flash message untuk kategori berhasil ditambahkan
    $_SESSION['flash_message'] = "barang berhasil ditambahkan";
    $_SESSION['flash_class'] = "flash-success"; // Class untuk styling (optional)
} else {
    // Set flash message jika ada error
    $_SESSION['flash_message'] = "Error: " . $conn->error;
    $_SESSION['flash_class'] = "flash-error"; // Class untuk styling (optional)
}

$conn->close();

header("Location: ../dashboard.php?page=barang");
