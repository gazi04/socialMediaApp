<?php
require_once "../../Database.php";

class Comment{
    private $db;

    public function __construct(){
       $this->db = new Database(); 
    }

    public function commentPost($userId, $postId, $comment){
        $this->db->query("INSERT INTO postcomments (PostID, UserID, Comment) VALUES (:postId, :userId, :comment)");
        $this->db->bind(":userId", $userId);
        $this->db->bind(":postId", $postId);
        $this->db->bind(":comment", $comment);
        return $this->db->execute();
    }

    public function getCommentByPostId($postId){
      $this->db->query("SELECT postcomments.*, users.Username FROM postcomments JOIN users ON postcomments.UserID = users.UserID WHERE PostID = :postId ORDER BY CreateAt DESC");
      $this->db->bind(":postId", $postId);
      return $this->db->resultSet();
    }

    public function getCommentCountByPost($postId){
      $this->db->query('SELECT COUNT(*) as comment_count FROM postcomments WHERE PostID = :postId');
      $this->db->bind(':postId', $postId);
      $result = $this->db->single();
      return $result['comment_count'];
   }
}

?>
