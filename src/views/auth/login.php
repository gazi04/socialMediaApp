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


<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
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
