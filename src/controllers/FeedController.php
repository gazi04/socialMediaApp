<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Feed.php";
require_once BASE_PATH . "/src/controllers/LikeController.php";

class FeedController{
  private $feedModel;
  private $likeController;

  public function __construct(){
    $this->feedModel = new Feed();
    $this->likeController = new LikeController();
  }

  public function getFeedFromFollowers($userId) {
    $posts = $this->feedModel->getFeedFromFollowers($userId); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    $likes = array();
    foreach ($posts as $post) {
      $likes[] = $this->likeController->getLikeCount($post["PostID"]);
    }
    include BASE_PATH . "/src/components/post.php";
  }

  public function getFeedFromNonFollowers($userId) {
    $posts = $this->feedModel->getFeedFromNonFollowers($userId); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    $likes = array();
    foreach ($posts as $post) {
      $likes[] = $this->likeController->getLikeCount($post["PostID"]);
    }
    include BASE_PATH . "/src/components/post.php";
    //return $this->feedModel->getFeedFromNonFollowers($userId);
  }

  public function getFeedWithMostLikes() {
    $posts = $this->feedModel->getFeedWithMostLike(); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    $likes = array();
    foreach ($posts as $post) {
      $likes[] = $this->likeController->getLikeCount($post["PostID"]);
    }
    include BASE_PATH . "/src/components/post.php";
    //return $this->feedModel->getFeedWithMostLike($userId);
  }
}
?>
