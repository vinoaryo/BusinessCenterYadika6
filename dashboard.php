<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
// include file
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <h1>Welcome to the Dashboard</h1>
        </header>

        <nav class="navbar">
            <ul>
                <li><a href="?page=home">Home</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Data</a>
                    <div class="dropdown-content">
                        <a href="?page=kategori">Kategori</a>
                        <a href="?page=barang">Barang</a>
                    </div>
                </li>
                <li><a href="?page=transaksi">Transaksi</a></li>
                <li><a href="?page=laporan">Laporan</a></li>
                <li><a href="logout.php" onclick="return confirm('apakah yakin mau logout?')">Logout</a></li>
            </ul>
        </nav>

        <section class="main-content">
            <h2>Dashboard Overview</h2>
            <hr>
            <?php
            // Cek apakah flash message ada di session
            if (isset($_SESSION['flash_message'])):
            ?>
                <div class="<?= $_SESSION['flash_class']; ?>">
                    <?= $_SESSION['flash_message']; ?>
                </div>
            <?php
                // Hapus flash message setelah ditampilkan
                unset($_SESSION['flash_message']);
                unset($_SESSION['flash_class']);
            endif;
            ?>
            <br>
            <?php
            // Set default page to 'home' if no 'page' parameter is provided
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            // Sanitize the page parameter to prevent directory traversal attacks
            $page = basename($page);

            // Include the corresponding page file if it exists
            $pageFile = "pages/" . $page . '.php';
            if (file_exists($pageFile)) {
                include($pageFile);
            } else {
                // If the file doesn't exist, load a 404 page or error page
                include('pages/404.php');
            }
            ?>


        </section>
    </div>
</body>

</html>