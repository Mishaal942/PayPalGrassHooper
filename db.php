<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "uppbmi0whibtc";
$password = "bjgew6ykgu1v";
$database = "dbjs205nfe9kkt";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
  die("Database Connection Failed: " . mysqli_connect_error());
}
?>
