<?php
namespace Controllers;
use Models\Follow;

class FollowController{
  private $followModel;

  public function __construct(){
    $this->followModel = new Follow();
  }

  public function followOrUnfollowUser($followerUserId, $followingUserId){
    if($this->isFollowing($followerUserId, $followingUserId)){
      return $this->followModel->unfollowUser($followerUserId, $followingUserId); 
    }

    return $this->followModel->followUser($followerUserId, $followingUserId); 
  }

  public function isFollowing($followerUserId, $followingUserId){
    return $this->followModel->isFollowing($followerUserId, $followingUserId); 
  }

  public function getFollowerCount($userId){
    return $this->followModel->getFollowerCount($userId);
  }

  public function getFollowingCount($userId){
    return $this->followModel->getFollowingCount($userId);
  }

  public function getFollowers($userId){
    $users = $this->followModel->getFollowers($userId);

    foreach($users as $user){
      $username = htmlspecialchars($user["Username"], ENT_QUOTES, "UTF-8");
      $profileImage = "data:image/jped;base64, ".base64_encode($user["ProfileImage"]);
      echo "
      <div class='user'>
      <img src='".$profileImage."' />
      <span class='username'>".$username."</span>
      </div> ";
    }
  }

  public function getFollowings($userId){
    $users = $this->followModel->getFollowings($userId);

    foreach($users as $user){
      $username = htmlspecialchars($user["Username"], ENT_QUOTES, "UTF-8");
      $profileImage = "data:image/jped;base64, ".base64_encode($user["ProfileImage"]);
      echo "
      <div class='user'>
      <img src='".$profileImage."' />
      <span class='username'>".$username."</span>
      </div> ";
    }
  }
}
?>
