<?php
require "../vendor/autoload.php";
use Controllers\FollowController;

$followController = new FollowController();
if(isset($_POST["getUsersThatIFollow"]) && isset($_POST["userId"])){
  $users = $followController->getFollowings($_POST["userId"]);
  $result = [];
  foreach($users as $user){
    $id = htmlspecialchars($user["UserID"], ENT_QUOTES, "UTF-8");
    $username = htmlspecialchars($user["Username"], ENT_QUOTES, "UTF-8");
    $profileImage = "data:image/jped;base64, ".base64_encode($user["ProfileImage"]);
    $result[] = ["UserID" => $id, "Username" => $username, "ImageSrc" => $profileImage];
  }

  echo json_encode($result);
}
else if(isset($_POST["getUsersThatFollowMe"]) && isset($_POST["userId"])){
  $users = $followController->getFollowers($_POST["userId"]);
  $result = [];
  foreach($users as $user){
    $id = htmlspecialchars($user["UserID"], ENT_QUOTES, "UTF-8");
    $username = htmlspecialchars($user["Username"], ENT_QUOTES, "UTF-8");
    $profileImage = "data:image/jped;base64, ".base64_encode($user["ProfileImage"]);
    $result[] = ["UserID" => $id, "Username" => $username, "ImageSrc" => $profileImage];
  }

  echo json_encode($result);
}
?>
