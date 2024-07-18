<?php
require_once "../../Database.php";

class Feed{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getFeed($userId){
    $this->db->query("SELECT posts.*, users.Username 
            FROM posts
            JOIN followers ON posts.UserID = followers.FollowingUserID
            JOIN users ON posts.UserID = users.UserID
            WHERE followers.FollowerUserID = :userId
            ORDER BY posts.CreateAt DESC");
    $this->db->bind(":userId", $userId);
    return $this->db->execute();
  }
}
?>
