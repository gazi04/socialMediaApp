<?php
    require_once "../../config.php";
    require BASE_PATH . "/src/controllers/UserController.php";
    require_once "../auth/check.php";

    $userController = new UserController();
    $userProfileData = $userController->getProfileData($_SESSION["userId"]);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $userId = $_SESSION["userId"];
        $profileImage = $_POST["profileImage"];
        $newUsername = $_POST["newUsername"];
        $bio = $_POST["bio"];

        if($userController->updateProfile($userId, $profileImage, $newUsername, $bio)){
            header("Location: profile.php");
        } else{
            echo "Editing profile failed";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <form method="post" action="profileManagement.php" enctype="multipart/form-data">
        <label>Change Profile Picture:</label>
        <input type="file" name="profileImage" required>
        <br>

        <label>Change you Username</label>
        <input type="text" name="newUsername" value="<?php echo $userProfileData["Username"]?>" required>
        <br>
       
        <label>Change Bio</label>
        <textarea name="bio" required><?php echo $userProfileData["Bio"]?></textarea>
        <br>

        <button type="submit">Change Profile</button>
    </form>
</body>
</html>