<?php

require "../Database/connection.php";

$id = $_GET['id'];

$table = "users";

$query = "DELETE FROM `users` WHERE `id` = '$id' ";

if ($conn->query($query) === TRUE) {
    echo "Record deleted successfully";
    header("location:javascript://history.go(-1)");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
};

$conn->close();