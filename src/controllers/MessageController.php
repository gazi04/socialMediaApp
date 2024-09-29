<?php
require_once "../vendor/autoload.php";
namespace Controllers;
use Models\Message;
use Controllers\UserController;

class MessageController{
  private $messageModel;
  private $userController;

  public function __construct(){
    $this->messageModel = new Message();
    $this->userController = new UserController();
  }

  public function saveMessage($senderId, $receiverId, $message){
    /* parameter validation  */
    if(!$this->userController->doesUserIdExists($senderId) && !$this->userController->doesUserIdExists($receiverId)){
      echo "error the sender or the receiver does not exists in the database.";
    }

    /* we sent the msg to the receiver by using the websocket server and we also need to save it in the database */
    return $this->messageModel->saveMessage($senderId, $receiverId, $message);
  }

  public function getChatHistory($loggedUserId, $userChatingWithId){
    /* parameter validation  */
    if(!$this->userController->doesUserIdExists($loggedUserId) && !$this->userController->doesUserIdExists($userChatingWithId)){
      echo "error the sender or the receiver does not exists in the database.";
    }

    return $this->messageModel->getChatHistory($loggedUserId, $userChatingWithId);
  }
}

?>
