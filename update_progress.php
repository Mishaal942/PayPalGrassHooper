<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])) die("Not logged in");

$user = $_SESSION['user'];
$lesson = isset($_GET['lesson']) ? (int)$_GET['lesson'] : 0;

if($lesson > 0){
  mysqli_query($conn,
    "INSERT INTO progress (user_email, lesson, status, points)
     VALUES ('$user', $lesson, 'completed', 10)");
  echo "success";
}
?>
