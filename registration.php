<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
    <h2>Registration</h2>
    <form method="POST" action="registration.php">
        <label>Username:</label>
        <input type="text" name="username"><br><br>
        <label>Password:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>

<?php
require_once 'db.php';

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    if($stmt->execute()) {
        echo "Registration successful! You can now <a href='login.php'>login</a>.";
    } else {
        echo "Registration failed.";
    }
}
?>
