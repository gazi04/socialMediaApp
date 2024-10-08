<?php
require "../vendor/autoload.php";
use Controllers\CommentController;

if (isset($_POST["getComments"]) && isset($_POST["postId"])){
  $commentController = new  CommentController();
  echo $commentController->getCommentByPostId($_POST["postId"]);
}
?>
