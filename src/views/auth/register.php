<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/controllers/UserController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userController = new UserController();
    $data = [
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ];
    if($userController->register($data)){
        header("Location: login.php");
    } else {
        echo "Registration failed.";
    }
}
?>

<form action="register.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Register</button>
</form>

<a href="login.php">Log In</a>
