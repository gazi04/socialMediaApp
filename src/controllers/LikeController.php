<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Like.php";

class LikeController{
  private $likeModel;

  public function __construct(){
    $this->likeModel = new Like();
  }

  public function likePost($userId, $postId){
    try {
      return $this->likeModel->likePost($userId, $postId);
    } catch (PDOException $ex) {
      throw $ex;
    }
  }

  public function unlikePost($userId, $postId){
    return $this->likeModel->unlikePost($userId, $postId);
  }

  public function isLiked($userId, $postId){
    return $this->likeModel->isLiked($userId, $postId);
  }

  public function getLikeCount($postId){
    return $this->likeModel->getLikeCount($postId);
  }
}
?>
