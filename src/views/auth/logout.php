<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/controllers/UserController.php";

$userController = new UserController();
$userController -> logout();

header("Location: login.php");
?>