<?php
namespace Models;

require_once "../vendor/autoload.php";
use Core\Database;


class Feed{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getFeedFromFollowers($userId) {
    $this->db->query("
      SELECT posts.*, users.Username, users.ProfileImage, COUNT(postlikes.LikeID) as LikeCount
      FROM posts
      JOIN users ON posts.UserID = users.UserID
      JOIN followers ON posts.UserID = followers.FollowingUserID
      LEFT JOIN postlikes ON posts.PostID = postlikes.PostID
      WHERE followers.FollowerUserID = :userId
      GROUP BY posts.PostID
      ORDER BY posts.CreateAt DESC;
      ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
  }

  public function getFeedFromNonFollowers($userId) {
    $this->db->query("
      SELECT posts.*, users.Username, users.ProfileImage, COUNT(postlikes.LikeID) AS LikeCount
      FROM posts
      JOIN users ON posts.UserID = users.UserID
      LEFT JOIN postlikes ON posts.PostID = postlikes.PostID
      WHERE posts.UserID NOT IN (
          SELECT FollowingUserID 
          FROM followers 
          WHERE FollowerUserID = 3
      ) 
      AND posts.UserID != 3
      GROUP BY posts.PostID
      ORDER BY posts.CreateAt DESC;
    ");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
    
  }

  public function getFeedWithMostLike() {
    $this->db->query("
      SELECT posts.*, users.Username, users.ProfileImage, COUNT(postlikes.PostID) as LikeCount 
      FROM posts 
      JOIN users ON posts.UserID = users.UserID 
      LEFT JOIN postlikes ON posts.PostID = postlikes.PostID 
      GROUP BY posts.PostID 
      ORDER BY LikeCount DESC, posts.CreateAt DESC;
    ");
    return $this->db->resultSet();
  }
}
?>
