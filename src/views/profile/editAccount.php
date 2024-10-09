<?php require_once "../auth/check.php"; ?>

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
          <div class="current-image">
            <img src="../../assets/images/sunflower.jpg" />
            <span class="username">gazzmend.h</span>
          </div>
          <div id="submitImage"><a>Change photo</a></div> 
        </div>

        <h2>Bio</h2>
        <div class="edit-bio">
          <textarea placeholder="Bio"></textarea>
        </div>

        <button id="submitProfile">Submit</button>
      </div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
  </body>
</html>
