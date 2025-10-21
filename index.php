<?php
session_start();
if(isset($_SESSION['user'])) {
  echo "<script>window.location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PayPal Grasshopper Clone</title>
<style>
body {
  font-family: Poppins, sans-serif;
  background: linear-gradient(120deg, #00b4db, #0083b0);
  color: #fff;
  text-align: center;
  padding: 80px;
}
h1 {font-size: 48px; margin-bottom: 10px;}
p {font-size: 20px;}
button {
  background: #fff;
  color: #0083b0;
  border: none;
  padding: 12px 30px;
  border-radius: 30px;
  cursor: pointer;
  font-size: 18px;
  margin: 10px;
  transition: 0.3s;
}
button:hover {background: #f1f1f1;}
</style>
</head>
<body>
  <h1>Welcome to PayPal Grasshopper 🚀</h1>
  <p>Learn to code with fun, interactive challenges!</p>
  <button onclick="window.location='signup.php'">Sign Up</button>
  <button onclick="window.location='login.php'">Login</button>
</body>
</html>
