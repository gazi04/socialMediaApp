<?php
require "../vendor/autoload.php";
use Controllers\CommentController;

if (isset($_POST["postComment"]) && isset($_POST["postId"])) {
  session_start();
  $commentController = new CommentController();
  $commentController->commentPost($_SESSION["userId"], $_POST["postId"], $_POST["comment"]);
}
?>
