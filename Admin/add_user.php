<?php

require "../Database/connection.php";

header("Content-type: text/plain");

$username = $_GET['username'];
$password = password_hash($_GET['password'], PASSWORD_DEFAULT);
$table = "users";

$query = "INSERT INTO $table (`id`, `username`, `password`) VALUES (NULL, '$username', '$password')";

if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
    header("location:javascript://history.go(-1)");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
};

$conn->close();
