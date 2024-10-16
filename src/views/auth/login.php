<?php
require_once "../../vendor/autoload.php";
use Controllers\UserController;

$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($userController->login($username, $password)){
    header("Location: ../feed/index.php");
    exit;
  } else{
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
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/script.js"></script>
  </head>
  <body>
    <div class="authentication-container">
      <div id="logOrsign-form">
        <fieldset>
        <div class="banner"><h1>Tungjatjeta</h1></div>
        <div class="credentials">
          <form method="post" action="login.php" >
            <input type="text" name="username" placeholder="Username" required/><br><br>
            <input type="password" name="password" placeholder="Passord" required/><br><br>
            <input type="submit" value="Log In" class="submit_button" />
          </form>
          <div id="strikethroughLink"> 
            <div class="line"></div>
            <a href="signUp.php">Sign Up</a>
            <div class="line"></div>
          </div>
        </div>
        <div class="login-with"></div>
        </fieldset>
      </div>
    </div>
</body>
</html>


