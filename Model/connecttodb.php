<?php 
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "lms_db";


$conn = new mysqli($localhost, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
    
?>