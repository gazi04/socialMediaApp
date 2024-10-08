<?php
namespace Controllers;
use Models\Comment;

class CommentController{
  private $commentModel;

  public function __construct(){
    $this->commentModel = new Comment();
  }

  public function commentPostById($userId, $postId, $comment){
    return $this->commentModel->commentPost($userId, $postId, $comment);
  }


  public function getCommentByPostId($postId){
    $comments = $this->commentModel->getCommentByPostId($postId);

    foreach ($comments as $comment) {
      echo '
        <div class="comment">
          <div class="user-image"><img src="data:image/jped;base64, '.base64_encode($comment["ProfileImage"]).'"/></div>
          <div class="text">
            <span class="username">'.$comment["Username"].'</span>
            <span class="comment-text">'.$comment["Comment"].'</span>
          </div>
        </div>
      ';
    }
  }


  public function getCommentCountByPost($postId){
    return $this->commentModel->getCommentCountByPost($postId);
  }
}
?>
