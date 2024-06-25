<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once "../auth/check.php";

    $userController = new UserController();
    $userProfileData = $userController->getProfileData($_SESSION["userId"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <h2>Username: <?php echo $userProfileData["Username"] ?></h2>
    <h2>Bio: <?php echo $userProfileData["Bio"] ?></h2>

    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="profileManagement.php">Edit Profile</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
</body>
</html>