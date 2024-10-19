<?php
require "../vendor/autoload.php";
use Controllers\FollowController;

if(isset($_POST["followOrUnfollowUser"]) && isset($_POST["userid"])){
  session_start();
  $followController = new FollowController();

  echo json_encode([
    "status" => $followController->followOrUnfollowUser($_SESSION["userId"], $_POST["userid"]),
    "followersCount" => $followController->getFollowerCount($_POST["userid"])
  ]);

  exit();
}
?>
