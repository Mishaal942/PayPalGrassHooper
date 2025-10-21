<?php
session_start();
include 'db.php';

// ✅ Agar user login nahi hai
if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit();
}

// ✅ Jab "Mark Lesson as Complete" click ho
if (isset($_POST['complete'])) {
    $status = "completed";

    // Agar sirf status column hai progress table me
    $query = "INSERT INTO progress (status) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Lesson marked as complete successfully!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Start Lesson</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 25px;
            width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        textarea {
            width: 100%;
            height: 150px;
            font-size: 16px;
            padding: 10px;
        }
        button {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
        }
        .run-btn { background: #3498db; color: white; }
        .complete-btn { background: #2ecc71; color: white; }
        .output-box {
            background: #eee;
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Lesson: Run & Complete</h2>

    <!-- ✅ Run Code Form -->
    <form method="post">
        <textarea name="code" placeholder="Write code here..."><?php
            echo isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "<?php echo 'Hello World!'; ?>";
        ?></textarea><br>
        <button type="submit" name="run" class="run-btn">Run Code</button>
    </form>

    <!-- ✅ Output Display -->
    <?php
    if (isset($_POST['run'])) {
        echo "<div class='output-box'><strong>Output:</strong><br>";
        $code = $_POST['code'];
        eval("?>$code");
        echo "</div>";
    }
    ?>

    <!-- ✅ Mark as Complete -->
    <form method="post">
        <button type="submit" name="complete" class="complete-btn">Mark Lesson as Complete</button>
    </form>
</div>

</body>
</html>
