<?php
require_once "../../vendor/autoload.php";
use Controllers\UserController;

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


<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
  </head>
  <body style="height: 100%;">
    <div class="login-container">
      <div class="login-form">
        <fieldset class="login-border">
        <div class="login-banner"><h1>Tungjatjeta</h1></div>
        <div class="login-credentials">
          <form method="post" action="login.php">
            <input type="text" name="username" placeholder="Username" required/><br><br>
            <input type="password" name="password" placeholder="Passord" required/><br><br>
            <input type="submit" value="Login" class="submit_button" />
          </form>
        </div>
        <div class="login-with"></div>
        </fieldset>
      </div>
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
  </body>
</html>
