<?php
require "../vendor/autoload.php";
use Controllers\FollowController;

$followController = new FollowController();
if(isset($_POST["getUsersThatIFollow"]) && isset($_POST["userId"])){
  echo $followController->getFollowings($_POST["userId"]);
}
else if(isset($_POST["getUsersThatFollowMe"]) && isset($_POST["userId"])){
  echo $followController->getFollowers($_POST["userId"]);
}
?>
