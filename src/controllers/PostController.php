<?php
namespace Controllers;
use Models\Post;

class PostController{
  private $postModel;

  public function __construct(){
    $this->postModel = new Post(); 
  }

  public function createPost($userId, $image, $caption){
    if($image["size"] > 500000){
      echo "Sorry, your file is too large.";
      return false;
    }

    $imageData = file_get_contents($image["tmp_name"]);

    if($this->postModel->create($userId, $imageData, $caption)){
      echo "The file " . htmlspecialchars(basename($image["name"])) . " has been uploaded.";
      return true;
    } else{
      echo "Sorry, there was an error saving your post.";
    }

    return false;
  }

  public function deletePost($postId){
    try{
      return $this->postModel->delete($postId);
    } catch (\PDOException $ex){
      error_log("Error occurred by deleting a post from the database");
    }
  }

  public function getPostsByUserId($userId){
    try{
      return $this->postModel->getPostsByUserId($userId);
    } catch (\PDOException $ex){
      error_log("Error by getting all the posts from the database.");
    }
  }

  public function getAllPosts(){
    try{
      return $this->postModel->getAllPosts();
    } catch (\PDOException $ex){
      error_log("Error: It seems we can't get the posts from the database.");
    }
  }

  public function getPostById($postId){
    return $this->postModel->getPost($postId);
  }

  public function updatePost($postId, $caption){
    try{
      return $this->postModel->update($postId, $caption);
    }
    catch (\PDOException $ex){
      error_log("Error in the process of updating the post.");
    }
  }
}
?>
