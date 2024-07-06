<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Like.php";

class LikeController{
  private $likeModel;

  public function __construct(){
    $this->likeModel = new Like();
  }

  public function likePost($userId, $postId) {
      return $this->postModel->likePost($userId, $postId);
  }

  public function unlikePost($userId, $postId) {
      return $this->postModel->unlikePost($userId, $postId);
  }

  public function isLiked($userId, $postId) {
      return $this->postModel->isLiked($userId, $postId);
  }
}
?>
