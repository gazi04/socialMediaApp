<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Feed.php";

class FeedController{
  private $feedModel;

  public function __construct(){
    $this->feedModel = new Feed();
  }

  public function getFeedFromFollowers($userId) {
    return $this->feedModel->getFeedFromFollowers($userId);
  }

  public function getFeedFromNonFollowers($userId) {
    return $this->feedModel->getFeedFromNonFollowers($userId);
  }

  public function getFeedWithMostLikes($userId) {
    return $this->feedModel->getFeedWithMostLike($userId);
  }
}
?>
