<?php

require "../Database/connection.php";

$table = $_GET['table'];

$conn->query("set @num := 0");
$conn->query("UPDATE $table SET id = @num := (@num+1);");

if ($conn->query("ALTER TABLE $table AUTO_INCREMENT =1;") === TRUE) {
    echo "Table altered successfully";
    header("location:javascript://history.go(-1)");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
};

$conn->close();
