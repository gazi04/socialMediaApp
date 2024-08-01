<?php
require_once "../../Database.php";

class User{
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function create($username, $email, $password){
    $this->db->query("INSERT INTO users (`Username`, `Password`, `Email`, `Bio`) VALUES (:username, :password, :email, '')");
    $this->db->bind(":username", $username);
    $this->db->bind(":email", $email);
    $this->db->bind(":password", $password);
    return $this->db->execute();
  }

  public function findByUsername($username){
    $this->db->query("SELECT * FROM users WHERE username = :username");
    $this->db->bind(":username", $username);
    return $this->db->single();
  }

  public function getProfileDataFromUser($userid){
    $this->db->query("SELECT `Username`, `Bio`, `ProfileImage`, `Email` FROM `users` WHERE `UserID` = :userId;");
    $this->db->bind(":userId", $userid);
    return $this->db->single();
  }

  public function doesUserExists($username){
    $this->db->query("SELECT COUNT(*) as count FROM users WHERE username = :username");
    $this->db->bind(":username", $username);
    $result = $this->db->single();
    return $result["count"] > 0;
  }

  public function update($userId, $username, $imageData = null, $bio){
    if ($imageData){
      $this->db->query("UPDATE users SET Username = :username, ProfileImage = :imageData, Bio = :bio WHERE UserID = :userId");
      $this->db->bind(":imageData", $imageData, PDO::PARAM_LOB);
    } else{
      $this->db->query("UPDATE users SET Username = :username, Bio = :bio WHERE UserID = :userId");
    }

    $this->db->bind(":userId", $userId);
    $this->db->bind(":username", $username);
    $this->db->bind(":bio", $bio);

    return $this->db->execute();
  }

  public function searchUsers($username){
    $this->db->query('SELECT UserID, Username, Email, ProfileImage, Bio FROM users WHERE Username LIKE :username');
    $this->db->bind(':username', '%' . $username . '%');
    return $this->db->resultSet(); 
  }

  public function doesUserIdExists($userId){
    $this->db->query();
    $this->db->bind(":userId", $userId);
    return $this->db->rowCount();
  }
}
?>
