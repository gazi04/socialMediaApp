<?php
require_once "../../Database.php";

class Post {
    private $db;

    public function __construct(){
        $this->db = new Database(); 
    }

    public function create($userID, $image, $caption){
        $this->db->query("INSERT INTO `posts`(`UserID`, `Post`, `Caption`) VALUES (':userId', ':image',':caption')");
        $this->db->bind(":userId", $userID);
        $this->db->bind(":image", $image);
        $this->db->bind(":caption", $caption);
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