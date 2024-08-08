<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Comment.php";

class CommentController{
  private $commentModel;

  public function __construct(){
    $this->commentModel = new Comment();
  }

  public function commentPostById($userId, $postId, $comment){
    return $this->commentModel->commentPost($userId, $postId, $comment);
  }


  public function getCommentByPostId($postId){
    return $this->commentModel->getCommentByPostId($postId);
  }


  public function getCommentCountByPost($postId){
    return $this->commentModel->getCommentCountByPost($postId);
  }
}
?>
