<?php
require_once "../../vendor/autoload.php";
use Controllers\UserController;

if(session_status() == PHP_SESSION_NONE){session_start();}

if(!isset($_SESSION["username"])){
  header("Location: ../auth/login.php");
}

$user = new UserController();
$user->getUserByName($_SESSION["username"]);
?>
