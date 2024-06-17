<?php
require_once '../../config.php';
require_once BASE_PATH . '/src/controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userController = new UserController();
    if ($userController->login($_POST['username'], $_POST['password'])) {
        header('Location: ../feed/index.php');
    } else {
        echo 'Login failed.';
    }
}
?>

<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
