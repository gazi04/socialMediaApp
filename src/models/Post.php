<?php
namespace Models;
use Core\Database;

class Post{
  private $db;

  public function __construct(){
    $this->db = new Database(); 
  }

  public function create($userId, $imageData, $caption){
    $this->db->query("INSERT INTO posts (UserID, Post, Caption) VALUES (:user_id, :post, :caption)");
    $this->db->bind(":user_id", $userId);
    $this->db->bind(":post", $imageData, \PDO::PARAM_LOB);
    $this->db->bind(":caption", $caption);
    return $this->db->execute();
  }

  public function delete($postId){
    $this->db->query("DELETE FROM `posts` WHERE `PostID` = :postId");
    $this->db->bind(":postId", $postId);
    return $this->db->execute();
  }

  public function getPostsByUserId($userId){
    $this->db->query("SELECT `PostID`, `Post`, `Caption` FROM `posts` WHERE `UserID` = :userId ORDER BY `CreateAt` DESC;");
    $this->db->bind(":userId", $userId);
    return $this->db->resultSet();
  }

  public function update($postId, $caption){
    $this->db->query("UPDATE `posts` SET `Caption`=:caption WHERE `PostID` = :postId");
    $this->db->bind(":caption", $caption);
    $this->db->bind(":postId", $postId);
    return $this->db->execute();
  }

  public function getAllPosts(){
    $this->db->query("SELECT * FROM posts ORDER BY CreateAt DESC");
    return $this->db->resultSet();
  }

  public function getPost($postId){
    $this->db->query("SELECT `UserID`, `Post`, `Caption`, `CreateAt` FROM posts WHERE `PostID` = :postId");
    $this->db->bind(":postId", $postId);
    return $this->db->single();
  }
}
?>
