<?php
session_start(); // Mulai session untuk menyimpan pesan
// include file
include "../koneksi.php";
// print_r($_POST);
// die;
extract($_POST);
$datetimenow = date('Y-m-d H:i:s');
$user_id = $_SESSION['id'];
$totalnya = str_replace(',', '', $total);
// Ambil data keranjang
$cartData = json_decode($_POST['cart_data'], true);

if (is_numeric($totalnya) && $totalnya > 0) {
    $query = "INSERT INTO transactions 
        (tanggal,total,user_id,created_at) 
        VALUES 
        (
        '$tanggal',
        '$totalnya',
        '$user_id',
        '$datetimenow'
        )";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        // Ambil id terakhir yang dimasukkan
        $transaction_id = $conn->insert_id;
        // Lakukan proses penyimpanan transaksi
        // Contoh simpan data transaksi dan data produk di keranjang
        // struktur products

        foreach ($cartData as $item) {
            $productId = $item['id'];
            $productName = $item['name'];
            $category = $item['category'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $subtotal = $item['subtotal'];
            $queryDetail = "INSERT INTO transaction_details 
                (transaction_id,product_id,product_name,harga,jumlah,subtotal) 
                VALUES 
                (
                '$transaction_id',
                '$productId',
                '$productName',
                '$price',
                '$quantity',
                '$subtotal'
                )";
            // Simpan data $productId, $quantity, $subtotal sesuai kebutuhan
            $conn->query($queryDetail);

            // Kurangi stok produk
            $updateStockQuery = "UPDATE products 
                             SET stok = stok - $quantity 
                             WHERE id = $productId";
            $conn->query($updateStockQuery);
        }
        $_SESSION['flash_message'] = "transaksi berhasil ditambahkan";
        $_SESSION['flash_class'] = "flash-success"; // Class untuk styling (optional)
    } else {
        $_SESSION['flash_message'] = "Error: " . $conn->error;
        $_SESSION['flash_class'] = "flash-error"; // Class untuk styling (optional)
    }

    $conn->close();

    header("Location: ../dashboard.php?page=transaksi");
} else {
    // Set flash message jika ada error
    $_SESSION['flash_message'] = "Error: Total Transaksi anda $totalnya , pastikan dengan benar terlebih dahulu..";
    $_SESSION['flash_class'] = "flash-error"; // Class untuk styling (optional)
    header("Location: ../dashboard.php?page=transaksi");
    exit;
}
