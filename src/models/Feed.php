<?php
require_once "../../Database.php";

class Feed{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getFeedFromFollowers($userId) {
    $this->db->query("SELECT posts.*, users.Username 
      FROM posts 
      JOIN users ON posts.UserID = users.UserID 
      JOIN followers ON posts.UserID = followers.FollowingUserID 
      WHERE followers.FollowerUserID = :userId
      ORDER BY posts.CreateAt DESC;
    ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
  }

  public function getFeedFromNonFollowers($userId) {
    $this->db->query("SELECT posts.*, users.Username 
      FROM posts 
      JOIN users ON posts.UserID = users.UserID 
      WHERE posts.UserID NOT IN (
          SELECT FollowingUserID 
          FROM followers 
          WHERE FollowerUserID = :userId
      ) AND posts.UserID != :userId 
      ORDER BY posts.CreateAt DESC;
    ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
    
  }

  public function getFeedWithMostLike($userId) {
    $this->db->query("
      SELECT posts.*, users.Username, COUNT(postlikes.PostID) as like_count 
      FROM posts 
      JOIN users ON posts.UserID = users.UserID 
      LEFT JOIN postlikes ON posts.PostID = postlikes.PostID 
      GROUP BY posts.PostID 
      ORDER BY like_count DESC, posts.CreateAt DESC;
    ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
  }
}
?>
