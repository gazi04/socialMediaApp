<?php
require "../vendor/autoload.php";
use Controllers\MessageController;
use Controllers\UserController;

$userController = new UserController();
$messageController = new MessageController();
session_start();

if(isset($_POST["getRooms"])){
  $messageController->getChatRooms();
}
else if(isset($_POST["searchRooms"]) && isset($_POST["term"]) && !empty($_POST["term"])){
  $messageController->searchRooms($_POST["term"]);
}
else if(isset($_POST["openRoom"]) && isset($_POST["username"])){
  $user = $userController->getUserByName($_POST["username"]);
  $response = ["messages" => $messageController->getChatHistory($_SESSION["userId"], $user["UserID"]), "sentToUserId" => $user["UserID"]];
  echo json_encode($response);
}
else if(isset($_POST["sendMessage"]) && isset($_POST["message"]) && isset($_POST["toId"])){
   $messageController->saveMessage($_SESSION["userId"], $_POST["toId"], $_POST["message"]);
  echo $_POST["message"];
}
?>
