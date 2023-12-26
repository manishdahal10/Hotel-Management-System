<?php 
$host = "localhost"; /* Host name */ 
$user = "root"; /* User */ 
$pass = ""; /* Password */ 
$dbname = "ho_tel"; /* Database name */ 
$conn = mysqli_connect($host, $user, $pass,$dbname); 
// Check connection 
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
}