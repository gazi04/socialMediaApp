<?php
require_once "../auth/check.php";

use Controllers\UserController;
use Controllers\PostController;
use Controllers\FollowController;
use Controllers\LikeController;
use Controllers\CommentController;

$userController = new UserController();
$postController = new PostController();
$followController = new FollowController();
$likeController = new LikeController();
$commentController = new CommentController();

$userProfileData = $userController->getProfileData($_SESSION["userId"]);

$posts = $postController->getPostsByUserId($_SESSION["userId"]);
$numberOfFollowers = $followController->getFollowerCount($_SESSION["userId"]);
$numberOfFollowing =  $followController->getFollowingCount($_SESSION["userId"]);

?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Your Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
  </head>
  <body>
    <div class="container-profile">

      <div class="navbar"><?php include(BASE_PATH."/components/navbar.php"); ?></div>

      <div class="content"><?php include(BASE_PATH."/components/userProfile.php"); ?></div>
    </div>

    <script type="text/javascript" src="../../assets/js/script.js"></script>
  </body>
</html>

