<?php
    require_once "../../config.php";
    require BASE_PATH . "/src/controllers/UserController.php";
    require_once "../auth/check.php";

    $userController = new UserController();
    $userProfileData = $userController->getProfileData($_SESSION["userId"]);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_SESSION["userId"];
        $profileImage = isset($_FILES["profileImage"]) ? $_FILES["profileImage"] : null;
        $newUsername = $_POST["newUsername"];
        $bio = $_POST["bio"];

        if ($userController->updateProfile($userId, $profileImage, $newUsername, $bio)) {
            header("Location: index.php");
        } else {
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
    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="../profile/index.php">Your Profile</a>
        <a href="../users/search.php">Search</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>

    <br><br>
    <form method="post" action="profileManagement.php" enctype="multipart/form-data">
        <img width="300px" src="data:image/jpeg;base64,<?php echo base64_encode($userProfileData["ProfileImage"]); ?>" alt="Post Image">
        <br>
        <label>Change Profile Picture:</label>
        <input type="file" name="profileImage" >
        <br><br>

        <label>Change you Username</label>
        <input type="text" name="newUsername" value="<?php echo $userProfileData["Username"]?>" required>
        <br><br>
       
        <label>Change Bio</label>
        <textarea name="bio" required><?php echo $userProfileData["Bio"]?></textarea>
        <br><br>

        <button type="submit">Change Profile</button>
    </form>
</body>
</html>