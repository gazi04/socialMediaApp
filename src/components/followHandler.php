<?php
require "../vendor/autoload.php";
use Controllers\FollowController;

if(isset($_POST["followOrUnfollowUser"]) && isset($_POST["userid"])){
  session_start();
  $followController = new FollowController();
  echo $followController->followOrUnfollowUser($_SESSION["userId"], $_POST["userid"]);
}
?>
