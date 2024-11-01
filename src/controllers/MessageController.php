<?php
namespace Controllers;
use Models\Message;
use Models\User;
use Controllers\UserController;

class MessageController{
  private $messageModel;
  private $userModel;
  private $userController;

  public function __construct(){
    $this->messageModel = new Message();
    $this->userModel = new User();
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

  public function getChatRooms(){
    session_start();
    $this->updateHtmlRooms($this->messageModel->getChatRooms($_SESSION["userId"]));
  }

  public function searchRooms($username){
    session_start();
    $rooms = $this->messageModel->searchRooms($_SESSION["userId"], "%".$username."%");

    if(count($rooms) != 0){
      $this->updateHtmlRooms($rooms);
      exit();
    }

    $users = $this->userModel->searchUsers($username, $_SESSION["userId"]);
    $this->generateNewHtmlRooms($users);
  }

  public function updateHtmlRooms($rooms){
    foreach($rooms as $room){
      $userid = htmlspecialchars($room["UserID"]);
      $username = htmlspecialchars($room["Username"], ENT_QUOTES, "UTF-8");
      $result = $this->messageModel->getLastMessage($_SESSION["userId"], $userid);
      $message = $result[0]["Message"];
      $seen = $room["Seen"];
      $trimmedString = (strlen($message) > 10) ? substr($message, 0, 10) . "..." : $message;

      if(empty($room["ProfileImage"])){
        $profileImage = "<img src='../../assets/images/defaultUser.jpg' />";
      }
      else{
        $profileImage = "<img src='data:image/jpeg;base64, ".base64_encode($room["ProfileImage"])."' />";
      }

      if($seen == 0){ $messageIndicator = "<span id='unread-message-indicator'></span>"; }
      else { $messageIndicator = ""; }
      echo '
        <a class="room">
        <div class="user">
        '.$profileImage.'
          <div>
            <span class="username">'.$username.'</span><br>
            <span style="font-size:small; color:gray;">'.$trimmedString.'</span>
          </div>
        '.$messageIndicator.'
        </div>
        </a>';
    }
  }

  public function generateNewHtmlRooms($rooms){
    foreach($rooms as $room){
      $userid = htmlspecialchars($room["UserID"]);
      $username = htmlspecialchars($room["Username"], ENT_QUOTES, "UTF-8");

      if(empty($room["ProfileImage"])){
        $profileImage = "<img src='../../assets/images/defaultUser.jpg' />";
      }
      else{
        $profileImage = "<img src='data:image/jpeg;base64, ".base64_encode($room["ProfileImage"])."' />";
      }

      echo '
        <div class="user">
        '.$profileImage.'
          <div>
            <span class="username">'.$username.'</span><br>
          </div>
        </div>';
    }
  }
}
?>
