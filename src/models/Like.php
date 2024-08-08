<?php
require_once "../../Database.php";

class Like{
  private $db;

  public function __construct(){
    $this->db = new Database(); 
  }

  public function likePost($userId, $postId){
    $this->db->query("INSERT INTO postlikes (UserID, PostID) VALUES (:userId, :postId)");
    $this->db->bind(":userId", $userId);
    $this->db->bind(":postId", $postId);
    return $this->db->execute();
  }

  public function unlikePost($userId, $postId){
    $this->db->query("DELETE FROM postlikes WHERE UserID = :userId AND PostID = :postId");
    $this->db->bind(":userId", $userId);
    $this->db->bind(":postId", $postId);
    return $this->db->execute();
  }

  public function isLiked($userId, $postId){
    $this->db->query("SELECT COUNT(*) as count FROM postlikes WHERE UserID = :userId AND PostID = :postId");
    $this->db->bind(":userId", $userId);
    $this->db->bind(":postId", $postId);
    $result = $this->db->single();
    return $result["count"] > 0;
  }

  public function getLikeCount($postId){
    $this->db->query("SELECT COUNT(*) as like_count FROM postlikes WHERE PostID = :postId;");
    $this->db->bind(":postId", $postId);
    $result = $this->db->single();
    return $result["like_count"];
  }
}

?>
