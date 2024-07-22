<?php
    include_once "../../config.php";
    include_once "../auth/check.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";

    $postController = new PostController();
    $postId = $_GET["postId"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["yes"])){
        $postId = $_GET["postId"];
        if ($postController->deletePost($postId)){
            header("Location: ../profile/index.php");
        } else {
            echo "Post deletion failed.";
        }
    }
    elseif($_SERVER["REQUEST_METHOD"] && isset($_POST["no"])){
      header("Location: ../profile/index.php");
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
  <title>Delete Post</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

  <header id="header">
    <a href="../profile/index.html" class="title">Profile</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <section id="main" class="wrapper">
      <div class="inner">
        <h1 class="major">Are you sure you want to delete this post?</h1>
        <form action="delete.php?postId=<?php echo $postId; ?>" method="POST">
            <button type="submit" name="yes">Yes, Delete Post</button>
            <button type="submit" name="no">No</button> 
        </form>      
      </div>
    </section>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?>
</body>
</html>
