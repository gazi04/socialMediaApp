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

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Profile Management</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Profile Management</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <div class="row">
      <div class="col-4 col-12-medium">
        <div class="image fit">
          <img width="30%" src="data:image/jpeg;base64,<?php echo base64_encode($userProfileData["ProfileImage"]); ?>" alt="Post Image" style="margin-top: 25%; margin-left: 2%;">
        </div>
      </div>
      <div class="col-6 col-12-medium">
        <form method="post" action="profileManagement.php" enctype="multipart/form-data">
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
      </div>
    </div>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?>
</body>
</html>
