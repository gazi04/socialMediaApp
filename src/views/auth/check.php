<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/models/User.php";
    $PATH = BASE_PATH . "src/views/auth/login.php";

    if(session_status() == PHP_SESSION_NONE){session_start();}

    if(!isset($_SESSION["username"])){
        header("Location: ../auth/login.php");
    }

    $user = new User();
    $user->findByUsername($_SESSION["username"]);
?>