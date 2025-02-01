<?php

require "../System/init.php";
require "../Database/connection.php";

// Start the session
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$table_users = "users";

// Use a prepared statement to avoid SQL injection
$query_users = $conn->prepare("SELECT * FROM $table_users WHERE username = ?");
$query_users->bind_param("s", $username); // 's' for string
$query_users->execute();
$users = $query_users->get_result();

if ($users->num_rows > 0) {
    while ($data = $users->fetch_assoc()) {
        // Verify the password with the stored hash
        if (!password_verify($password, $data['password'])) {
            echo "Invalid password";
            exit;
        }

        // Set session variable for login
        $_SESSION['isLogin'] = true;


        // Optionally, redirect to the home page after successful login

        header("../");

        exit;
    }
} else {
    echo "Username not found";
}
