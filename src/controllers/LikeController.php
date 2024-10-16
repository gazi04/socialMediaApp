<?php
namespace Controllers;
use Models\Like;

class LikeController{
  private $likeModel;

  public function __construct(){
    $this->likeModel = new Like();
  }

  public function likeOrUnlikePost($userId, $postId){
    try{
      if (!$this->isLiked($userId, $postId)){ return $this->likeModel->likePost($userId, $postId); }
      else {return $this->likeModel->unlikePost($userId, $postId);}
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function likePost($userId, $postId){
    try{
      if (!$this->isLiked($userId, $postId)){ return $this->likeModel->likePost($userId, $postId); }
      else { return; }
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function unlikePost($userId, $postId){
    try{
      if ($this->isLiked($userId, $postId)){ return $this->likeModel->unlikePost($userId, $postId); }
      else { return; }
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function isLiked($userId, $postId){
    try{
      return $this->likeModel->isLiked($userId, $postId);
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function getLikeCount($postId){
    try{
      return $this->likeModel->getLikeCount($postId);
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }
}
?>
