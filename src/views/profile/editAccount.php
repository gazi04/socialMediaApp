<?php

use Controllers\UserController;

require_once "../auth/check.php";

$userController = new UserController;
$user = $userController->getProfileData($_SESSION["userId"]);
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Edit Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <script src="../../assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="container-without-leftbar">
      <div class="navbar"><?php require(BASE_PATH."/components/navbar.php"); ?></div>
      <div class="edit-profile-content">
        <h2>Edit Profile</h2>
        <div class="change-profile-image">
          <div class="current-user">
            <img src="data:image/jpeg;base64, <?php echo base64_encode($user["ProfileImage"]); ?>" />
            <span class="username"><?php echo $user["Username"]; ?></span>
          </div>
          <input type="file" id="imageInput" accept="image/*" style="display: none;" />
          <div id="changePhotoLink"><a>Change photo</a></div> 
        </div>

        <h2>Bio</h2>
        <div class="edit-bio">
          <textarea id="bioInput" placeholder="Bio" rows="5" cols="40"><?php echo $user["Bio"] ?></textarea>
        </div>

        <div class="submit-button"><button id="submitProfile" disabled>Submit</button></div>
      </div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
  </body>
</html>
