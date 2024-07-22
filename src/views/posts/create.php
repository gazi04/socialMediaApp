<?php
    require_once "../../config.php";
    require BASE_PATH . "/src/controllers/PostController.php";
    require_once "../auth/check.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $postController = new PostController();
        $userId = $_SESSION["userId"];
        $image = $_FILES["image"];
        $caption = $_POST["caption"];
        if($postController->createPost($userId, $image, $caption)){
            header("Location: ../profile/index.php");
        } else{
            echo "Post creation failed.";
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
  <title>Create Post</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

  <header id="header">
    <a href="index.html" class="title">Profile</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <section id="main" class="wrapper">
      <div class="inner">
        <h1 class="major">Create a Post</h1>
        <form method="post" action="create.php" enctype="multipart/form-data">
            <input type="file" name="image" required style="margin-bottom: 3%;">
            <textarea name="caption" placeholder="Add a caption..." required style="margin-bottom:3%"></textarea>
            <button type="submit">Post Image</button>
        </form>
      </div>
    </section>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?>
</body>
</html>
