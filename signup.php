<?php
session_start();
include 'db.php'; // Make sure db.php exists

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Insert ignore duplicate keys
    $stmt = $conn->prepare("INSERT IGNORE INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $success = "Signup successful! You can now login.";
        header("Refresh:2; url=login.php"); // redirect after 2 seconds
    } else {
        $success = "Signup failed. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup</title>
<style>
body { margin:0; padding:0; font-family:Arial; background:#e9f1ff; display:flex; justify-content:center; align-items:center; height:100vh; }
.signup-box { background:white; padding:35px; box-shadow:0 5px 15px rgba(0,0,0,0.2); border-radius:8px; width:350px; text-align:center; }
h2 { color:#1e70ff; margin-bottom:20px; }
input { width:90%; padding:10px; margin:10px 0; border:1px solid #bbb; border-radius:5px; }
button { background:#1e70ff; color:white; padding:10px; border:none; width:100%; border-radius:5px; cursor:pointer; font-size:16px; }
button:hover { background:#1556c0; }
.success { color:green; margin:8px 0; }
a { display:block; margin-top:15px; color:#1e70ff; }
</style>
</head>
<body>
<div class="signup-box">
<h2>Signup</h2>
<?php if ($success != "") echo "<div class='success'>$success</div>"; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Signup</button>
</form>
<a href="login.php">Already have an account? Login</a>
</div>
</body>
</html>
