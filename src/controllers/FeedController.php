<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models/Feed.php";

class FeedController{
  private $feedModel;

  public function __construct(){
    $this->feedModel = new Feed();
  }

  public function getFeed($userId){
    return $this->feedModel->getFeed($userId);
  }
}
?>
