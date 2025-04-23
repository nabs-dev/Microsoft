<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "<script>window.location.href = 'dashboard.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Microsoft Copilot Clone</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #dbeafe, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 25px;
            color: #0078D4;
        }
        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }
        button {
            padding: 12px;
            width: 100%;
            border: none;
            background: #0078D4;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #005ea2;
        }
        a {
            display: block;
            margin-top: 15px;
            color: #0078D4;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Copilot Login</h2>
    <form method="post" id="loginForm">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button name="login">Login</button>
    </form>
    <a href="signup.php">Create a new account</a>
</div>

<?php
if (isset($_POST['login'])) {
    include 'db.php';
    $u = $_POST['username'];
    $p = $_POST['password'];
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q)) {
        $_SESSION['user'] = $u;
        echo "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
}
?>
</body>
</html>
