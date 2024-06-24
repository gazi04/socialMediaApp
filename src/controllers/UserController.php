<?php
require_once '../../config.php';
require_once BASE_PATH . '/src/models/User.php';
require_once BASE_PATH . '/src/Database.php';

class UserController{
    private $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function register($data){
        // in the return statement in the create function you can decomment the line below and use a hashed password to saved it in the database
        // $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        try{
            return $this->userModel->create($data['username'], $data['email'], $data["password"]);
        }
        catch(PDOException $ex){
            if ($ex->getCode() == 23000) {
                echo 'Error: The username is already taken. Please choose a different username.';
            } else {
                error_log('PDOException: ' . $ex->getMessage());
                echo 'Database error occurred. Please try again later.';
            }
            return false;
        }
    }

    public function login($username, $password){
        $user = $this->userModel->findByUsername($username);
        if ($user && ($password == $user["Password"])) {
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

    // TODO: rename the functions correctly
    public function userExists($username){
        $user = $this->userModel->findByUsername($username);
        if($user){return true;}
        return false;
    }
    
    public function editProfile($userId, $profileImage, $newUsername, $bio){

    }

    public function getUserBio($userId) {
        try {
            return $this->userModel->getBioByUserId($userId);
        } catch (PDOException $ex) {
            error_log("Error occurred while fetching the user bio.");
            return false;
        }
    }
}
?>
