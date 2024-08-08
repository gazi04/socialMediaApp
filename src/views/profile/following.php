<?php
include_once "../../config.php";
include_once BASE_PATH . "/src/controllers/FollowController.php";
include_once "../auth/check.php";

$followerController = new FollowController();
$followings = $followerController->getFollowings($_SESSION["userId"]);
?>

<!DOCTYPE HTML>
<!--
  Hyperspace by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Hyperspace by HTML5 UP</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Followings</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <div class="table-wrapper" style="margin: 1%;">
      <?php if (!empty($followings)): ?>
      <table>
        <thead>
          <tr>
            <th>Profile Picture</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($followings as $follower): ?>
            <tr>
              <td><img src="data:image/jpeg;base64,<?php echo base64_encode($follower["ProfileImage"]); ?>" alt="Post Image" style="max-width: 100px;"></td>
              <td><?php echo htmlspecialchars($follower["Username"]); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
       </table>
      <?php else: ?>
          <p>You have no followings.</p>
      <?php endif; ?>
    </div>


  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?></body>
</html>
