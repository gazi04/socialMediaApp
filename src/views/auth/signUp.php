<?php
require_once "../../vendor/autoload.php";
require "../../core/config.php";

use Controllers\UserController;

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

<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/script.js"></script>
  </head>
  <body>
    <div class="authentication-container">
      <div id="logOrsign-form">
        <fieldset>
        <div class="banner"><h1>Tungjatjeta</h1></div>
        <div class="credentials">
          <form method="post" action="signUp.php">
            <input type="text" name="username" placeholder="Username" required/><br><br>
            <input type="text" name="email" placeholder="Email" required/><br><br>
            <input type="password" name="password" placeholder="Passord" required/><br><br>
            <input type="submit" value="Sign Up" class="submit_button" />
          </form>
          <div id="strikethroughLink"> 
            <div class="line"></div>
            <a href="login.php">Log In</a>
            <div class="line"></div>
          </div>
        </div>
        <div class="login-with"></div>
        </fieldset>
      </div>
    </div>
</body>
</html>
