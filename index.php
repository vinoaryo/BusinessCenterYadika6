<?php
// Mulai sesi
session_start();

// include file
include "koneksi.php";

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan escape untuk mencegah SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query cek username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];

            // Redirect ke halaman lain setelah login
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Autentikasi gagal!";
        }
    } else {
        $error = "Gagal autentikasi, mungkin ada yang salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- Link to external CSS file -->
</head>

<body style="margin: 0; padding: 0; background-image: url('assets/bg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; font-family: Arial, sans-serif;">
    <div class="login-container">
        <p style="text-align: center;">
            <img src="assets/logo.png" style="max-width: 150px;" alt="logo">
        </p>
        <h2>Login Business Center SMK Yadika 6</h2>
        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post" action="">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>