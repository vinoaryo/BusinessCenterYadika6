<?php
require "../System/init.php";

loadEnv("../vendor/autoload.php");

if (empty($_GET['pages'])) {
    $_GET['pages'] = "home";
}

// Sanitize and format the input
$pages = filter_var($_GET['pages'], FILTER_SANITIZE_STRING);

// Prevent directory traversal attacks
$pages = str_replace('..', '', $pages);

// Determine the file to include
$file = "./$pages";
if (!str_contains($pages, "/")) {
    $file .= "/index.php";
}

// Ensure the file exists before including
if (!file_exists($file)) {
    die("<h1>Page not found!</h1>");
}

if (!$_SESSION['isLogin']) {
    header("Location: ../");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($_ENV['WEBSITE_TITLE']) ?></title>
</head>

<body>
    
    <?php require $file; ?>

</body>

</html>