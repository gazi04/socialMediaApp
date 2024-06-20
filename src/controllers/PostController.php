<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Post.php";

class PostController {
    private $postModel;

    public function __construct() {
       $this->postModel = new Post(); 
    }

    public function createPost($data){
        //TODO: validate the $data, by checking the image size and more
        try {
            $this->postModel->create($data["userId"], $data["image"], $data["caption"]);
        } catch (Exception $ex) {
            error_log("Error in the proccess of inserting the post in the database");
        }
    }

    public function deletePost($postId){
        try {
            return $this->postModel->delete($postId);
        } catch (PDOException $ex) {
            error_log("Error occurred by deleting a post from the database");
        }
    }

    public function getPostsByUserId($userId){
        try {
            $this->postModel->getPostsByUserId($userId);
        } catch (PDOException $ex) {
            error_log("Error by getting all the posts from the database.");
        }
    }
}
?>