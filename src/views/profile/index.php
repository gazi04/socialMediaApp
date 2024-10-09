<?php require_once "../auth/check.php"; ?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Your Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <script src="../../assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="container-without-leftbar">
      <div class="navbar"><?php require(BASE_PATH."/components/navbar.php"); ?></div>
      <div class="content"><?php require(BASE_PATH."/components/userProfile.php"); ?></div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
  </body>
</html>
