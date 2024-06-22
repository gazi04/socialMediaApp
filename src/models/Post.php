<?php
require_once "../../Database.php";

class Post {
    private $db;

    public function __construct(){
        $this->db = new Database(); 
    }

    public function create($userId, $imageData, $caption) {
        $this->db->query('INSERT INTO posts (UserID, Post, Caption) VALUES (:user_id, :post, :caption)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':post', $imageData, PDO::PARAM_LOB);
        $this->db->bind(':caption', $caption);
        return $this->db->execute();
    }

    public function delete($postId){
        $this->db->query("DELETE FROM `posts` WHERE `PostID` = ':postId'");
        $this->db->bind(":postId", $postId);
        return $this->db->execute();
    }

    public function getPostsByUserId($userId){
        $this->db->query("SELECT `PostID`, `Post`, `Caption` FROM `posts` WHERE `UserID` = ':userId' ORDER BY `CreateAt` DESC;");
        $this->db->bind(":userId", $userId);
        return $this->db->resultSet();
    }
}
?>