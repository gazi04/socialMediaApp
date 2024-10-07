<?php
require "../vendor/autoload.php";
use Controllers\LikeController;

$likeController = new LikeController();

if (isset($_POST["likeHandler"]) && isset($_POST["postId"]) && isset($_POST["userId"])) {
  $likeController->likeOrUnlikePost($_POST["userId"], $_POST["postId"]);

  echo json_encode([
    "isLiked" => $likeController->isLiked($_POST["userId"], $_POST["postId"]),
    "likes" => $likeController->getLikeCount($_POST["postId"])
  ]);

  exit();
}
else if (isset($_POST["likeStatus"]) && isset($_POST["postId"]) && isset($_POST["userId"])){
  echo json_encode([
    "isLiked" => $likeController->isLiked($_POST["userId"], $_POST["postId"]),
    "likes" => $likeController->getLikeCount($_POST["postId"])
  ]);

  exit();
} 
else {
  echo json_encode(["error" => "Invalid request"]);
  exit();
}

?>
