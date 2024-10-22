<?php 
require_once "../../core/config.php";
require_once "../../vendor/autoload.php";
include \BASE_PATH . "/views/auth/check.php";

use Controllers\LikeController;
use Controllers\FeedController;

$feedController = new FeedController();
$likeController = new LikeController();

$profileUserId = $_SESSION["userId"];
?>


<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="navbar"><?php include(BASE_PATH."/components/navbar.php"); ?></div>

      <div class="content">
        <?php $feedController->getFeedWithMostLikes()?>
      </div>

      <div class="recommendations"></div>

      <div class="footer"><?php include(BASE_PATH."/components/footer.php"); ?></div>
    </div>
  </body>
</html>

