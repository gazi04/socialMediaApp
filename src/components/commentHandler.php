<?php
require "../vendor/autoload.php";
use Controllers\CommentController;

if (isset($_POST["postComment"]) && isset($_POST["postId"]) && isset($_POST["comment"])) {
  session_start();
  $commentController = new CommentController();
  $commentController->commentPost($_SESSION["userId"], $_POST["postId"], $_POST["comment"]);
  exit();
}
else if (isset($_POST["getComments"]) && isset($_POST["postId"])){
  $commentController = new  CommentController();
  echo $commentController->getCommentByPostId($_POST["postId"]);
  exit();
}
?>
