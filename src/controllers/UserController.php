<?php
namespace Controllers;
use Models\User;

class UserController{
  private $userModel;

  public function __construct(){
    $this->userModel = new User();
  }

  public function register($data){
    // in the return statement in the create function you can decomment the line below and use a hashed password to saved it in the database
    // $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);

    try{
      return $this->userModel->create($data["username"], $data["email"], $data["password"]);
    }
    catch(\PDOException $ex){
      if ($ex->getCode() == 23000) {
        echo "Error: The username is already taken. Please choose a different username.";
      } else {
        echo "PDOException: " . $ex->getMessage();
        echo "Database error occurred. Please try again later." . $ex->getCode();
      }
      return false;
    }
  }

  public function login($username, $password){
    $user = $this->userModel->findByUsername($username);

    if (!empty($user) && ($password == $user["Password"])) {
      session_start();
      $_SESSION["userId"] = $user["UserID"];
      $_SESSION["username"] = $user["Username"];
      return true;
    }
    return false;
  }

  public function logout(){
    session_start();
    session_unset();
    session_destroy();
  }

  public function doesUsernameExists($username){
    $user = $this->userModel->findByUsername($username);
    if($user){return true;}
    return false;
  }

  public function updateProfile($userId, $profileImage = null, $newUsername, $bio){
    $imageData = null;
    if($profileImage && $profileImage["tmp_name"]){
      $imageData = file_get_contents($profileImage["tmp_name"]);

      if($profileImage["size"] > 500000){
        echo "Your profile image is too large";
        return;
      }       
    }

    $result = $this->userModel->update($userId, $newUsername, $imageData, $bio);

    if($result){
      $_SESSION["username"] = $newUsername;
    }

    return $result;
  }

  public function getProfileData($userId){
    try{
      return $this->userModel->getProfileDataFromUser($userId);
    } catch (\PDOException $ex){
      error_log("Error occurred while fetching the profile data from the user.");
    }
  }

  public function getUserByName($username){
    try{
      return $this->userModel->findByUsername($username);
    } catch (\PDOException $ex){
      error_log("Error occurred while fetching the profile data from the user.");
    }
  }

  public function searchUsers($username){
    return $this->userModel->searchUsers($username);
  }

  public function doesUserIdExists($userId){
    return $this->userModel->doesUserIdExists($userId);
  }

  public function getUserIdByPostId($postId){
    try{ return $this->userModel->getUserIdByPostId($postId);}
    catch(\PDOException $ex) { error_log($ex);}
  }

  public function getSessionId($userId){

  }

  public function updateSessionId($userId, $newSessionId){

  }

  public function getUserBySession($sessionId){}
}
?>
