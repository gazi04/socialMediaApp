<?php
require "../vendor/autoload.php";
use Controllers\MessageController;
use Controllers\UserController;

$userController = new UserController();
$messageController = new MessageController();

if(isset($_POST["getRooms"])){
  $messageController->getChatRooms();
}
else if(isset($_POST["searchRooms"]) && isset($_POST["term"]) && !empty($_POST["term"])){
  $messageController->searchRooms($_POST["term"]);
}
else if(isset($_POST["openRoom"]) && isset($_POST["username"])){
  session_start();
  $user = $userController->getUserByName($_POST["username"]);
  $response = ["messages" => $messageController->getChatHistory($_SESSION["userId"], $user["UserID"]), "sentToUserId" => $user["UserID"]];
  echo json_encode($response);
}
?>
