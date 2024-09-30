<?php
require "../vendor/autoload.php";
use Controllers\LikeController;

if (isset($_POST["likeHandler"]) && isset($_POST["postId"]) && isset($_POST["userId"])) {
  $likeController = new LikeController();
  $likeController->likeOrUnlikePost($_POST["userId"], $_POST["postId"]);

  echo json_encode([
    "isLiked" => $likeController->isLiked($_POST["userId"], $_POST["postId"]),
    "likes" => $likeController->getLikeCount($_POST["postId"])
  ]);

  exit();
}
?>
