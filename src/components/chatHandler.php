<?php
require "../vendor/autoload.php";
use Controllers\MessageController;

$messageController = new MessageController();

if(isset($_POST["getRooms"])){
  $messageController->getChatRooms();
}
else if(isset($_POST["searchRooms"]) && isset($_POST["term"]) && !empty($_POST["term"])){
  $messageController->searchRooms($_POST["term"]);
}
?>
