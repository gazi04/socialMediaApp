<?php 
include_once "../../config.php";
include_once "../auth/check.php";
include_once BASE_PATH . "/src/controllers/PostController.php";

$postController = new PostController();
$posts = $postController->getAllPosts();
$userId = $_SESSION["userId"];
?>

<!DOCTYPE HTML>
<!--
  Hyperspace by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Feed</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Feed</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <section id="main" class="wrapper">
      <div class="inner">
        <h2>Hello, <?php echo $_SESSION["username"]; ?></h2>
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
