<?php
require "../Database/connection.php";

$table_users = "users";
$query_users = "SELECT * FROM $table_users";
$users = $conn->query($query_users);

if ($users->num_rows > 0) {
    while ($row = $users->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td> 
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}

$conn->close();
