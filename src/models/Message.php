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
    $this->db->query("INSERT INTO `messages`(`SenderID`, `ReceiverID`, `Message`) VALUES (:sender,:receiver,:message)");
    $this->db->bind(":sender", $sender);
    $this->db->bind(":receiver", $receiver);
    $this->db->bind(":message", $msg);
    return $this->db->execute();
  }

  public function getChatHistory($firstUser, $secondUser){
    $this->db->query("
      SELECT * FROM `messages` 
      WHERE (SenderID = :firstUser AND ReceiverID = :secondUser) OR (SenderID = :secondUser AND ReceiverID = :firstUser)
      ORDER BY CreateAt");
    $this->db->bind(":firstUser", $firstUser);
    $this->db->bind(":secondUser", $secondUser);
    return $this->db->resultSet();
  }

  public function getChatRooms($userId){
    $this->db->query(" 
      SELECT u.UserID, u.Username, u.ProfileImage, m.Seen, m.CreateAt as MessageCreateAt
      FROM messages AS m
      INNER JOIN users AS u ON (
          (m.SenderID = u.UserID AND m.ReceiverID = :userId) OR
          (m.ReceiverID = u.UserID AND m.SenderID = :userId)
      )
      INNER JOIN (
          SELECT 
              CASE 
                  WHEN SenderID = :userId THEN ReceiverID 
                  ELSE SenderID 
              END AS ChatParticipantID,
              MAX(CreateAt) AS LatestMessageTime
          FROM messages
          WHERE SenderID = :userId OR ReceiverID = :userId
          GROUP BY ChatParticipantID
      ) AS latest_messages ON (
          (m.SenderID = latest_messages.ChatParticipantID OR m.ReceiverID = latest_messages.ChatParticipantID) 
          AND m.CreateAt = latest_messages.LatestMessageTime
      )
      ORDER BY m.Seen, m.CreateAt DESC;
    ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
  }

  public function searchRooms($userId, $username){
    $this->db->query(" SELECT u.UserID, u.Username, u.ProfileImage, m.Message, m.Seen, m.CreateAt as MessageCreateAt
        FROM messages AS m
        INNER JOIN users AS u ON m.SenderID = u.UserID
        INNER JOIN (
            SELECT SenderID, MAX(CreateAt) AS LatestMessageTime
            FROM messages
            WHERE ReceiverID = :userId
            GROUP BY SenderID
        ) AS latest_messages ON m.SenderID = latest_messages.SenderID AND m.CreateAt = latest_messages.LatestMessageTime
        WHERE m.ReceiverID = :userId AND u.Username LIKE :username
        ORDER BY m.Seen, m.CreateAt DESC; 
      ");
    $this->db->bind(":userId", $userId);
    $this->db->bind(":username", $username);
    return $this->db->resultSet();
  }

  public function getLastMessage($senderId, $receiverId){
      $this->db->query(" 
      SELECT SenderID, Message, Seen FROM messages AS m
      INNER JOIN (
        SELECT 
        MAX(CreateAt) AS LatestMessageTime
        FROM messages
        WHERE 
        (SenderID = :UserID1 AND ReceiverID = :UserID2)
        OR (SenderID = :UserID2 AND ReceiverID = :UserID1)
      ) AS latest_message ON m.CreateAt = latest_message.LatestMessageTime
      WHERE 
      (m.SenderID = :UserID1 AND m.ReceiverID = :UserID2)
      OR (m.SenderID = :UserID2 AND m.ReceiverID = :UserID1);
      ");
    $this->db->bind(":UserID1", $senderId);
    $this->db->bind(":UserID2", $receiverId);
    return $this->db->resultSet();
  }
}
?>
