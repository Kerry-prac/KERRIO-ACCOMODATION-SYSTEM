<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kerrio"; // use the same name as your database

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
