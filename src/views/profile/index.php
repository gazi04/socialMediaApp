<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";
    include_once BASE_PATH . "/src/controllers/FollowController.php";
    include_once "../auth/check.php";

    $userController = new UserController();
    $userProfileData = $userController->getProfileData($_SESSION["userId"]);

    $postController = new PostController();
    $posts = $postController->getPostsByUserId($_SESSION["userId"]);

    $followController = new FollowController();
    $numberOfFollowers = $followController->getFollowerCount($_SESSION["userId"]);
    $numberOfFollowing =  $followController->getFollowingCount($_SESSION["userId"]);

?>


<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Profile</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Profile</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <div class="row">
      <div class="col-4 col-12-medium">
        <div class="image fit">
          <img width="30%" src="data:image/jpeg;base64,<?php echo base64_encode($userProfileData["ProfileImage"]); ?>" alt="Post Image" style="margin-top: 9%; margin-left: 2%;">
        </div>
      </div>
      <div class="col-6 col-12-medium" style="padding-top: 5%; padding-left: 3rem;">
        <div class="row"> 
           <div class="col-6">
            <h3>Username: <?php echo $userProfileData["Username"] ?></h3>
            <h3>Bio: <?php echo $userProfileData["Bio"] ?></h3>
          </div>
          <div class="col-6">
            <ul class="actions">
              <h3><a href="followers.php">Followers:  <?php echo $numberOfFollowers; ?></a> | <a href="following.php">Following:  <?php echo $numberOfFollowing; ?></a></h3>
          </ul> 
          </div>
        </div>
        <div class="row" style="padding-top: 5%; padding-left: 5%;">
          <ul class="actions">
            <a class="button" href="profileManagement.php">Edit Profile</a>
            <a  class="button" href="../posts/create.php" style="margin-left: 5%;">Create Post</a>
          </ul>
        </div>
      </div>
    </div>

    <div class="row table-wrapper">
    <?php if (!empty($posts)): ?>
        <table class="alt" style="margin: 1%;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image" style="max-width: 100px;"></td>
                        <td><?php echo htmlspecialchars($post["Caption"]); ?></td>
                        <td style="align-content: center;">
                            <a class="button primary" href="../posts/edit.php?postId=<?php echo $post['PostID']; ?>">Edit</a>
                            <a class="button primary" href="../posts/delete.php?postId=<?php echo $post['PostID']; ?>" style="margin-left: 2%;">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>

  
    </div>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?>
</body>
</html>
</body>
</html>
