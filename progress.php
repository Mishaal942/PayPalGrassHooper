<?php
session_start();
include 'db.php';

// ✅ Check login
if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Count completed lessons as score
$query = "SELECT COUNT(*) AS total_score FROM progress WHERE status='completed'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$score = $row['total_score'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Progress Score</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        .container {
            background: #ffffff;
            color: #333;
            padding: 30px;
            width: 420px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }
        .label {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }
        .score-box {
            font-size: 40px;
            background: #2ecc71;
            color: #fff;
            padding: 18px 0;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 18px;
            background: #2575fc;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            transition: 0.3s;
        }
        .back-btn:hover {
            background: #1a5edb;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Progress</h2>
    <div class="label">Your Total Score</div>
    <div class="score-box"><?= $score ?></div>
    <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
