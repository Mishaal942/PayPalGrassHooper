<?php
session_start();
include 'db.php'; // your DB connection file

// If already logged in, go to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['username_or_email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($input === '' || $password === '') {
        $error = "Please enter username/email and password.";
    } else {
        // Prepare and execute safe query
        $sql = "SELECT id, username, email, password FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $error = "Database error: " . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param("ss", $input, $input);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();
                $dbPass = $user['password'];

                // Support both hashed and plain passwords:
                $ok = false;
                if (password_verify($password, $dbPass)) {
                    $ok = true; // hashed password matches
                } elseif ($password === $dbPass) {
                    $ok = true; // plain-text match
                }

                if ($ok) {
                    // Successful login: set session and redirect
                    $_SESSION['user_id'] = (int)$user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "User not found!";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Login — PayPal Grasshopper Clone</title>
<style>
  :root{
    --brand:#1e70ff;
    --brand-dark:#1556c0;
    --bg:#f3f6fc;
    --card:#ffffff;
    --muted:#6b7280;
  }
  *{box-sizing:border-box}
  body{
    margin:0;
    font-family:Inter,Segoe UI,Roboto,Arial,sans-serif;
    background:linear-gradient(180deg,var(--bg),#eef4ff);
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:100vh;
    color:#111827;
  }
  .card{
    width:380px;
    background:var(--card);
    border-radius:12px;
    padding:28px;
    box-shadow:0 10px 30px rgba(16,24,40,0.08);
  }
  h2{margin:0 0 10px 0;color:var(--brand)}
  p.lead{margin:0 0 18px 0;color:var(--muted);font-size:14px}
  .field{margin-bottom:12px}
  input[type="text"], input[type="password"]{
    width:100%;
    padding:12px 14px;
    border:1px solid #e6e9ef;
    border-radius:8px;
    font-size:14px;
    outline:none;
    transition:box-shadow .15s, border-color .15s;
  }
  input:focus{box-shadow:0 6px 18px rgba(30,112,255,0.08); border-color:var(--brand)}
  .btn{
    width:100%;
    padding:12px 14px;
    background:var(--brand);
    color:#fff;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    font-size:15px;
    margin-top:6px;
  }
  .btn:hover{background:var(--brand-dark)}
  .meta{display:flex;justify-content:space-between;align-items:center;margin-top:10px}
  .link{color:var(--brand);text-decoration:none;font-size:14px}
  .error{background:#fff1f0;color:#9f1239;padding:10px;border-radius:8px;margin-bottom:12px;border:1px solid #fecaca;font-size:14px}
  .note{font-size:13px;color:var(--muted);margin-top:12px;text-align:center}
</style>
</head>
<body>
  <div class="card" role="main">
    <h2>Login</h2>
    <p class="lead">Use your username or email to sign in</p>

    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off" novalidate>
      <div class="field">
        <input type="text" name="username_or_email" placeholder="Username or Email" required value="<?php echo isset($_POST['username_or_email']) ? htmlspecialchars($_POST['username_or_email']) : '' ?>">
      </div>
      <div class="field">
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button class="btn" type="submit">Login</button>

      <div class="meta">
        <a class="link" href="signup.php">Create account</a>
        <a class="link" href="#">Forgot?</a>
      </div>

      <div class="note">Tip: This form accepts both plain-text and hashed passwords.</div>
    </form>
  </div>
</body>
</html>
