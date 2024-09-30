<?php
namespace Controllers;
use Models\Feed;

class FeedController{
  private $feedModel;

  public function __construct(){
    $this->feedModel = new Feed();
  }

  public function getFeedFromFollowers($userId) {
    $posts = $this->feedModel->getFeedFromFollowers($userId); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    include BASE_PATH . "/src/components/post.php";
  }

  public function getFeedFromNonFollowers($userId) {
    $posts = $this->feedModel->getFeedFromNonFollowers($userId); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    include BASE_PATH . "/src/components/post.php";
  }

  public function getFeedWithMostLikes() {
    $posts = $this->feedModel->getFeedWithMostLike(); 

    if(empty($posts)) {
      echo "No post to see.";
      return;
    }

    include BASE_PATH . "/components/post.php";
  }
}
?>
