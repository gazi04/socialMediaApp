<?php
require "../vendor/autoload.php";
use Controllers\FollowController;
use Controllers\UserController;

$followController = new FollowController();
$userController = new UserController();
if(isset($_POST["getUsersThatIFollow"]) && isset($_POST["userId"])){
  echo $followController->getFollowings($_POST["userId"]);
}
else if(isset($_POST["getUsersThatFollowMe"]) && isset($_POST["userId"])){
  echo $followController->getFollowers($_POST["userId"]);
}
else if(isset($_POST["searchUser"]) && isset($_POST["term"])){
  session_start();
  echo $userController->searchUsers($_POST["term"], $_SESSION["userId"]);
}
exit();
?>
