<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username"><br><br>
        <label>Password:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>

<?php
session_start();
require_once 'db.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if(password_verify($password, $hashedPassword)) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
    } else {
        echo "Invalid username or password";
    }
}
?>
