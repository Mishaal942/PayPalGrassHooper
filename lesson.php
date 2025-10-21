<?php
// ✅ Always start session safely
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// ✅ If not logged in, redirect to login
if(!isset($_SESSION['user'])){
  echo "<script>window.location='login.php';</script>";
  exit;
}

// ✅ Securely get lesson number
$lesson = isset($_GET['lesson']) ? (int)$_GET['lesson'] : 1;

// ✅ Define lesson data
$lessons = [
  1 => ["Print 'Hello World!'", "console.log('Hello, World!');"],
  2 => ["Variables in JavaScript", "let name = 'Mishaal';\nconsole.log(name);"],
  3 => ["Loops in JavaScript", "for(let i=1;i<=5;i++){\n console.log(i);\n}"],
  4 => ["If-Else Conditions", "let age = 18;\nif(age >= 18){\n console.log('Adult');\n}else{\n console.log('Minor');\n}"]
];

// ✅ If lesson not found, fallback to 1
$title = isset($lessons[$lesson]) ? $lessons[$lesson][0] : $lessons[1][0];
$example = isset($lessons[$lesson]) ? $lessons[$lesson][1] : $lessons[1][1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lesson <?=$lesson?> | PayPal Grasshopper</title>
<style>
body{
  background:linear-gradient(135deg,#00c6ff,#0072ff);
  font-family:'Poppins',sans-serif;
  color:#fff;
  text-align:center;
  padding:40px;
}
h1{margin-bottom:10px;}
.lesson-box{
  background:#ffffff20;
  border-radius:20px;
  padding:25px;
  width:80%;
  margin:auto;
  box-shadow:0 0 15px rgba(0,0,0,0.3);
}
textarea{
  width:90%;
  height:220px;
  border-radius:10px;
  border:none;
  padding:15px;
  font-size:16px;
  margin-top:15px;
  resize:none;
  outline:none;
}
button{
  background:#fff;
  color:#0072ff;
  border:none;
  padding:10px 25px;
  border-radius:30px;
  cursor:pointer;
  margin:15px;
  font-weight:bold;
}
button:hover{background:#f1f1f1;}
pre{
  background:#000;
  color:#0f0;
  padding:20px;
  border-radius:10px;
  width:90%;
  margin:20px auto;
  text-align:left;
  min-height:80px;
}
.back{
  background:#ff4b2b;
  color:#fff;
}
.back:hover{background:#ff6b4b;}
</style>
</head>
<body>

<h1>Lesson <?=$lesson?> – <?=$title?> 💻</h1>
<p>Write your code below and click ‘Run Code’ to see the result!</p>

<div class="lesson-box">
  <textarea id="editor"><?=$example?></textarea><br>
  <button onclick="runCode()">Run Code</button>
  <button class="back" onclick="window.location='dashboard.php'">← Back to Dashboard</button>
  <pre id="output">Your output will appear here...</pre>
</div>

<script>
function runCode(){
  const code = document.getElementById('editor').value;
  const output = document.getElementById('output');
  try{
    let result = eval(code);
    if(result === undefined) output.innerText = '✅ Code executed successfully!';
    else output.innerText = '✅ Output: ' + result;
  }catch(e){
    output.innerText = '❌ Error: ' + e.message;
  }
}
</script>
</body>
</html>
