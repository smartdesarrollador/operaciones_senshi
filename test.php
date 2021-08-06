<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "senshidb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$encriptedPassword = password_hash('motorizado1', PASSWORD_DEFAULT, ['cost' => 10]);

$sql = "INSERT INTO admin (correo, password)
VALUES ('motorizado1@senshi.pe', '$encriptedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
