<?php
namespace Models;
use Core\Database;

class Follow{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function followUser($followerUserId, $followingUserId){
    $this->db->query("INSERT INTO followers (FollowerUserID, FollowingUserID) VALUES (:followerUserId, :followingUserId)");
    $this->db->bind(":followerUserId", $followerUserId);
    $this->db->bind(":followingUserId", $followingUserId);
    return $this->db->execute();
  }

  public function unfollowUser($followerUserId, $followingUserId){
    $this->db->query("DELETE FROM followers WHERE FollowerUserID = :followerUserId AND FollowingUserID = :followingUserId");
    $this->db->bind(":followerUserId", $followerUserId);
    $this->db->bind(":followingUserId", $followingUserId);
    return $this->db->execute();
  }

  public function isFollowing($followerUserId, $followingUserId){
    $this->db->query("SELECT COUNT(*) as count FROM followers WHERE FollowerUserID = :followerUserId AND FollowingUserID = :followingUserId");
    $this->db->bind(":followerUserId", $followerUserId);
    $this->db->bind(":followingUserId", $followingUserId);
    $result = $this->db->single();
    return $result["count"] > 0;
  }

  public function getFollowerCount($userId){
    $this->db->query("SELECT COUNT(*) as follower_count FROM followers WHERE FollowingUserID = :userId");
    $this->db->bind(":userId", $userId);
    $result = $this->db->single();
    return $result["follower_count"];
  }

  public function getFollowingCount($userId){
    $this->db->query("SELECT COUNT(*) as following_count FROM followers WHERE FollowerUserID = :userId");
    $this->db->bind(":userId", $userId);
    $result = $this->db->single();
    return $result["following_count"];
  }

  public function getFollowers($userId){
    $this->db->query("
        SELECT users.UserID, users.Username, users.ProfileImage 
        FROM followers JOIN users ON followers.FollowerUserID = users.UserID      WHERE followers.FollowingUserID = :userId");
      $this->db->bind(":userId", $userId);
      return $this->db->resultSet();
    }


    public function getFollowings($userId){
      $this->db->query("
            SELECT users.UserID, users.Username, users.ProfileImage 
            FROM followers 
            JOIN users ON followers.FollowingUserID = users.UserID 
            WHERE followers.FollowerUserID = :userId");
      $this->db->bind(":userId", $userId);
      return $this->db->resultSet();
    }
}
?>
