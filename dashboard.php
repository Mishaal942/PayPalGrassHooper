<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Example Lessons (You can replace or add more)
$lessons = [
    ["id" => 1, "title" => "Introduction to PHP"],
    ["id" => 2, "title" => "Variables and Data Types"],
    ["id" => 3, "title" => "Control Structures"],
    ["id" => 4, "title" => "Functions in PHP"],
    ["id" => 5, "title" => "Working with Forms"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #007bff;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            background: #0056b3;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background: #007bff;
            color: white;
        }
        .btn {
            padding: 8px 14px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>Welcome to Your Dashboard</h1>
    <a href="progress.php">View Progress</a>
</div>

<div class="container">
    <h2>Available Lessons</h2>
    <table>
        <tr>
            <th>Lesson Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($lessons as $lesson): ?>
            <tr>
                <td><?php echo $lesson['title']; ?></td>
                <td>
                    <a class="btn" href="start_lesson.php?lesson_id=<?php echo $lesson['id']; ?>">
                        Start Lesson
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
