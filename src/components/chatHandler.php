<?php
require "../vendor/autoload.php";
use Controllers\MessageController;

$messageController = new MessageController();

if(isset($_POST["getRooms"])){
  $messageController->getChatRooms();
}
?>
