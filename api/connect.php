<?php
$servername = "localhost";
$username = "root";
$password = "your_password_here"; 
$dbname = "voting"; 


$connect = mysqli_connect($servername, $username, $password, $dbname);


if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>