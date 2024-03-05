<?php
$servername = "localhost"; 
$username = "root"; 
$password = "webkul"; 
$databasename = "PhpTaskDb"; 

$conn = new mysqli($servername, $username, $password, $databasename); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
?>