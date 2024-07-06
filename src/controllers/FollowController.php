<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/models.Follow.php";

class FollowController{
  private $followModel;

  public function __construct(){
    $this->followModel = new Follow();
  }

  public function followUser($followerUserId, $followingUserId){
     return $this->followModel->followUser($followerUserId, $followingUserId); 
  }

  public function unfollowUser($followerUserId, $followingUserId){
    return $this->followModel->unfollowUser($followerUserId, $followingUserId); 
  }

  public function isFollowing($followerUserId, $followingUserId){
     return $this->followModel->isFollowing($followerUserId, $followingUserId); 
  }
}

?>
