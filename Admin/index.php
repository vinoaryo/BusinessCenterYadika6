<?php

session_start();

if (isset($isAdmin) and $isAdmin === false) {
    return header("Location: ./");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Center</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
        width: 50%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<body>

    <h1>Users</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th> <!-- Avoid displaying passwords in real applications -->
        </tr>
        <tbody id="users-table">
            <!-- Data will be loaded here dynamically -->
        </tbody>
    </table>

    <br>

    <a href="#" onclick="addUser()">Add User</a>
    <a href="#" onclick="deleteUser()">Delete User</a>
    <a href="#" onclick="resetAutoIncrement()">Reset AI</a>


</body>
<script>
    function loadUsers() {
        $.ajax({
            url: 'fetch_users.php', // Fetch table rows from this file
            type: 'GET',
            success: function(data) {
                $("#users-table").html(data); // Update table content
            }
        });
    }

    function addUser() {
        let username = prompt("Enter Username:");
        if (!username) return;

        let password = prompt("Enter Password:");
        if (!password) return;

        $.ajax({
            url: 'add_user.php',
            type: 'GET',
            data: {
                username: username,
                password: password
            },
            success: function() {
                loadUsers(); // Reload table after adding
            }
        });
    }

    function deleteUser() {
        let id = prompt("Enter ID:");
        if (!id) return;

        $.ajax({
            url: 'delete_user.php',
            type: 'GET',
            data: {
                id: id
            },
            success: function() {
                loadUsers(); // Reload table after deleting
            }
        });
    }

    function resetAutoIncrement() {
        let table = prompt("Enter Table:");
        if (!table) return;

        $.ajax({
            url: 'reset_autoincrement.php',
            type: 'GET',
            data: {
                table: table
            },
            success: function() {
                loadUsers(); // Reload table
            }
        });
    }

    // Auto-refresh table every 1 seconds
    setInterval(loadUsers, 1000);
    loadUsers(); // Initial load on page load
</script>

</html>