<?php
require_once "../../vendor/autoload.php";
use Controllers\UserController;

$userController = new UserController();
$userController -> logout();

header("Location: login.php");
?>
