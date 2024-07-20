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

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Hyperspace</a>
    <nav>
      <ul>
        <li><a href="login.php">Log In</a></li>
      </ul>
    </nav>
  </header>

  <div id="wrapper">
    <section id="main" class="wrapper">
      <div class="inner">
        <h1 class="major">Create an account</h1>
        <form method="post" action="register.php">
          <div class="row gtr-uniform">
            <div class="col-6 col-12-xsmall">
              <input type="text" name="username" placeholder="Username" required/>
            </div>
            <div class="col-6 col-12-xsmall">
              <input type="password" name="password" placeholder="Passord" required/>
            </div>
            <div class="col-6 col-12-xsmall">
              <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="col-12">
              <ul class="actions">
                <li><input type="submit" value="Register" class="primary" /></li>
              </ul>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.scrollex.min.js"></script>
  <script src="assets/js/jquery.scrolly.min.js"></script>
  <script src="assets/js/browser.min.js"></script>
  <script src="assets/js/breakpoints.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
