<?php
require_once "../../Database.php";

class Follow{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function followUser($followerUserId, $followingUserId) {
        $this->db->query('INSERT INTO followers (FollowerUserID, FollowingUserID) VALUES (:followerUserId, :followingUserId)');
        $this->db->bind(':followerUserId', $followerUserId);
        $this->db->bind(':followingUserId', $followingUserId);
        return $this->db->execute();
    }

    public function unfollowUser($followerUserId, $followingUserId) {
        $this->db->query('DELETE FROM followers WHERE FollowerUserID = :followerUserId AND FollowingUserID = :followingUserId');
        $this->db->bind(':followerUserId', $followerUserId);
        $this->db->bind(':followingUserId', $followingUserId);
        return $this->db->execute();
    }

    public function isFollowing($followerUserId, $followingUserId) {
        $this->db->query('SELECT COUNT(*) as count FROM followers WHERE FollowerUserID = :followerUserId AND FollowingUserID = :followingUserId');
        $this->db->bind(':followerUserId', $followerUserId);
        $this->db->bind(':followingUserId', $followingUserId);
        $result = $this->db->single();
        return $result['count'] > 0;
    }

}

?>