<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "<script>location.href='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup - Copilot</title>
    <style>
        body { font-family: sans-serif; background: #e9f0fb; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        input { margin: 10px 0; padding: 12px; width: 90%; border: 1px solid #ccc; border-radius: 10px; }
        button { padding: 12px; width: 100%; border: none; background: #0078D4; color: white; font-weight: bold; border-radius: 10px; }
        a { display: block; margin-top: 15px; color: #0078D4; text-decoration: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>Create Account</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button name="signup">Signup</button>
    </form>
    <a href="index.php">Login</a>
</div>
<?php
if (isset($_POST['signup'])) {
    include 'db.php';
    $u = $_POST['username'];
    $p = $_POST['password'];
    mysqli_query($conn, "INSERT INTO users(username, password) VALUES('$u', '$p')");
    echo "<script>alert('Account created'); location.href='index.php';</script>";
}
?>
</body>
</html>
