<?php
#require_once "../../config.php";
#require_once BASE_PATH . "/src/controllers/UserController.php";
#
#if ($_SERVER["REQUEST_METHOD"] == "POST") {
#    $userController = new UserController();
#    if ($userController->login($_POST["username"], $_POST["password"])) {
#        header("Location: ../feed/index.php");
#    } else {
#        echo "Login failed.";
#    }
#}
?>

<!--
<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
--!>

<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/controllers/UserController.php";

$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if ($userController->login($username, $password)) {
        header("Location: ../feed/index.php");
        exit;
    } else {
        echo "Login failed. Please check your username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Create an account.</a>
</body>
</html>
