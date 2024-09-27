<?php 
include_once "../../config.php";
include_once "../auth/check.php";
include_once BASE_PATH . "/src/controllers/UserController.php";
include_once BASE_PATH . "/src/controllers/PostController.php";
include_once BASE_PATH . "/src/controllers/FollowController.php";
include_once BASE_PATH . "/src/controllers/LikeController.php";
include_once BASE_PATH . "/src/controllers/CommentController.php";
include_once BASE_PATH . "/src/controllers/FeedController.php";

$userController = new UserController();
$feedController = new FeedController();
$postController = new PostController();
$followController = new FollowController();
$likeController = new LikeController();
$commentController = new CommentController();

$profileUserId = $_SESSION["userId"];
/* $posts = $feedController->getFeedFromFollowers($profileUserId); */

?>

<!DOCTYPE HTML>
<!--
  Hyperspace by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<!-- <html> -->
<!-- <head> -->
<!--   <title>Feed</title> -->
<!--   <meta charset="utf-8" /> -->
<!--   <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" /> -->
<!--   <link rel="stylesheet" href="../../../assets/css/main.css" /> -->
<!--   <noscript><link rel="stylesheet" href="../../../assets/css/noscript.css" /></noscript> -->
<!--   <style> -->
<!--     .comment-box{ -->
<!--         width: 90%; -->
<!--         padding: 10px; -->
<!--         margin-bottom: 10px; -->
<!--     } -->
<!--     .comment-box p{ -->
<!--         margin: 5px 0; -->
<!--     } -->
<!--     .comment-box input{ -->
<!--         width: 100%; -->
<!--         border: none; -->
<!--         font-size: 17px; -->
<!--     } -->
<!--     .comment-section{ -->
<!--       max-height: 145px; -->
<!--       overflow-y: auto; -->
<!--       padding: 10px; -->
<!--     } -->
<!--   </style> -->
<!-- </head> -->
<!-- <body class="is-preload"> -->
<!--   <header id="header"> -->
<!--     <a href="#" class="title">Welcome <?php echo $_SESSION["username"]; ?></a> -->
<!--     <?php include(BASE_PATH."/src/components/navbar.php"); ?> -->
<!--   </header> -->
<!---->
<!--   <div id="wrapper"> -->
<!--     <section id="one" class="wrapper"> -->
<!--     <div class="table-wrapper"> -->
<!--     <?php if (!empty($posts)): ?> -->
<!--       <table class="alt" style="padding-left: 2%; padding-right: 2%; padding-top: 2%;"> -->
<!--         <thead> -->
<!--           <tr> -->
<!--             <th>Image</th> -->
<!--             <th>Caption</th> -->
<!--             <th>Likes</th> -->
<!--             <th>Comments</th> -->
<!--           </tr> -->
<!--         </thead> -->
<!--         <tbody> -->
<!--           <?php include BASE_PATH."/src/components/post.php"; ?> -->
<!--         </tbody> -->
<!--       </table> -->
<!--     <?php else: ?> -->
<!--       <p>No posts available.</p> -->
<!--     <?php endif; ?> -->
<!--     </div> -->
<!--     </section> -->
<!--   </div> -->
<!---->
<!--   <?php include(BASE_PATH."/src/components/footer.php"); ?> -->
<!---->
<!--   <script src="../assets/js/jquery.min.js"></script> -->
<!--   <script src="../assets/js/jquery.scrollex.min.js"></script> -->
<!--   <script src="../assets/js/jquery.scrolly.min.js"></script> -->
<!--   <script src="../assets/js/browser.min.js"></script> -->
<!--   <script src="../assets/js/breakpoints.min.js"></script> -->
<!--   <script src="../assets/js/util.js"></script> -->
<!--   <script src="../assets/js/main.js"></script> -->
<!-- </body> -->
<!-- </html> -->


<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="navbar"><?php include(BASE_PATH."/src/components/navbar.php"); ?></div>

      <div class="content">
        <?php $feedController->getFeedFromFollowers($profileUserId)?>
      </div>

      <div class="recommendations"></div>

      <div class="footer"><?php include(BASE_PATH."/src/components/footer.php"); ?></div>
    </div>

    <script type="text/javascript" src="../../assets/js/script.js"></script>
  </body>
</html>

