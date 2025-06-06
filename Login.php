<?php
require_once './Create_tables.php';
session_start();

$error = ''; // Khởi tạo biến lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $user->login($username, $password);

    if ($result === true) {
        $_SESSION['username'] = $username;
        header("Location: Welcome.html");
        exit();
    } elseif ($result === false) {
        $error = "Wrong password.";
    } else {
        $error = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Error</title>
</head>
<body>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <a href="login.html">Try Again</a>
</body>
</html>
