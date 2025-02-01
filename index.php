<?php
require './System/init.php';

loadEnv("vendor/autoload.php");

var_dump($_SESSION) ;

if ($_SESSION['isLogin']) {
    header("Location: ./views/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/src/index.css">
    <title><?= $_ENV['WEBSITE_TITLE'] ?></title>
</head>

<body>

    <div class="login-card">
        <div class="brand">
            <div class="brand-logo"></div>
            <h1>Welcome</h1>
            <p>Enter your credentials to access</p>
        </div>

        <form id="loginForm" method="POST" action="./Auth/auth_verify.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password">
            </div>

            <button type="submit" class="login-btn" id="loginButton">
                Sign in
            </button>
        </form>

    </div>

</body>

</html>