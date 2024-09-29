<?php 
namespace Models;

require_once "../vendor/autoload.php";
use Core\Database;

class Message{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function saveMessage($sender, $receiver, $msg){
    $this->db->query("INSERT INTO `messages`(`SenderID`, `ReceiverID`, `Message`) VALUES (':sender',':receiver',':message')");
    $this->db->bind(":sender", $sender);
    $this->db->bind(":receiver", $receiver);
    $this->db->bind(":message", $msg);
    return $this->db->execute();
  }

  public function getChatHistory($firstUser, $secondUser){
    $this->db->query("SELECT `SenderID`, `ReceiverID`, `Message`, `CreateAt` FROM `messages` WHERE `SenderID` == :firstUser AND `ReceiverID` == :secondUser; ORDER BY `CreateAt` ASC");
    $this->db->bind(":firstUser", $firstUser);
    $this->db->bind(":secondUser", $secondUser);
    return $this->db->execute();

  }
}
?>
