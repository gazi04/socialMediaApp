<?php 
require_once "../../core/config.php";
require_once "../../vendor/autoload.php";
include \BASE_PATH . "/views/auth/check.php";

use Controllers\UserController;
use Controllers\PostController;
use Controllers\FollowController;
use Controllers\LikeController;
use Controllers\CommentController;
use Controllers\FeedController;

$userController = new UserController();
$feedController = new FeedController();
$postController = new PostController();
$followController = new FollowController();
$likeController = new LikeController();
$commentController = new CommentController();

$profileUserId = $_SESSION["userId"];
?>


<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
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

    <script type="text/javascript" src="../../assets/js/script.js"></script>
  </body>
</html>

