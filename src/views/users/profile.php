<?php
include_once "../../config.php";
include_once BASE_PATH . "/src/controllers/UserController.php";
include_once BASE_PATH . "/src/controllers/PostController.php";
include_once BASE_PATH . "/src/controllers/FollowController.php";
include_once BASE_PATH . "/src/controllers/LikeController.php";
include_once BASE_PATH . "/src/controllers/CommentController.php";
include_once BASE_PATH . "/src/views/auth/check.php";

$userController = new UserController();
$postController = new PostController();
$followController = new FollowController();
$likeController = new LikeController();
$commentController = new CommentController();
$profileUserId;
$isFollowing;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $profileUserId = $_POST["userId"];
  $user = $userController->getProfileData($profileUserId);
  $posts = $postController->getPostsByUserId($profileUserId);

  if(isset($_POST["follow"])){
    $followController->followUser($_SESSION["userId"], $profileUserId);
  } elseif(isset($_POST["unfollow"])){
    $followController->unfollowUser($_SESSION["userId"], $profileUserId);
  }

  if(isset($_POST["like"])){
    $likeController->likePost($_SESSION["userId"], $_POST["postId"]);
  } elseif(isset($_POST["unlike"])){
    $likeController->unlikePost($_SESSION["userId"], $_POST["postId"]);
  }

  if(isset($_POST["commentPost"]) && isset($_POST["comment"])){
    $commentController->commentPostById($_SESSION["userId"], $_POST["postId"], $_POST["comment"]);
  }

  $isFollowing = $followController->isFollowing($_SESSION["userId"], $profileUserId);
  $followerCount = $followController->getFollowerCount($profileUserId);
  $followingCount = $followController->getFollowingCount($profileUserId);
}

$comments = [];
if(!empty($posts)){
  foreach($posts as $post){
    $comments[$post['PostID']] = $commentController->getCommentByPostId($post['PostID']);
  }
}
?>

<!doctype html>
<!--
  hyperspace by html5 up
  html5up.net | @ajlkn
  free for personal and commercial use under the cca 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title><?php echo htmlspecialchars($user["Username"]) ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
  <style>
    .comment-box{
        width: 90%;
        padding: 10px;
        margin-bottom: 10px;
    }
    .comment-box p{
        margin: 5px 0;
    }
    .comment-box input{
        width: 100%;
        border: none;
        font-size: 17px;
    }
    .comment-section{
      max-height: 145px;
      overflow-y: auto;
      padding: 10px;
    }
  </style>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title"><?php echo htmlspecialchars($user["Username"]) ?></a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <div class="row" style="padding-left: 1%;">
      <div class="col-4 col-12-medium">
        <div class="image fit">
          <img width="30%" src="data:image/jpeg;base64,<?php echo base64_encode($user["ProfileImage"]); ?>" alt="Post Image" style="margin-top: 9%; margin-left: 2%;">
        </div>
      </div>
      <div class="col-6 col-12-medium" style="padding-top: 5%; padding-left: 3rem;">
        <div class="row"> 
           <div class="col-6">
            <h3>Username: <?php echo $user["Username"] ?></h3>
            <h3>Bio: <?php echo $user["Bio"] ?></h3>
          </div>
          <div class="col-6">
            <ul class="actions">
              <h3>Followers:<?php echo $followerCount; ?> | Following:<?php echo $followingCount; ?></h3>
            </ul> 

            <form method="post" action="profile.php">
              <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
              <?php if ($isFollowing): ?>
                  <input type="submit" name="unfollow" value="Unfollow">
              <?php else: ?>
                  <input type="submit" name="follow" value="Follow">
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    </div>

  <div class="table-wrapper">
  <?php if (!empty($posts)): ?>
    <table class="alt" style="padding-left: 2%; padding-right: 2%;">
      <thead>
        <tr>
          <th>Image</th>
          <th>Caption</th>
          <th>Likes</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post): ?>
<?php
$postId = $post["PostID"];
$postComments = $comments[$postId] ?? [];
?>
          <tr>
            <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image" style="max-width: 100px;"></td>
            <td><?php echo htmlspecialchars($post["Caption"]); ?></td>

            <td>
              <form method="POST" action="profile.php">
                <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
                <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
                <?php echo $likeController->getLikeCount($post["PostID"]); ?>

                <?php if ($likeController->isLiked($_SESSION["userId"], $post["PostID"])): ?>
                    <input type="submit" name="unlike" value="Unlike" style="margin-left: 10%;">
                <?php else: ?>
                    <input type="submit" name="like" value="Like" style="margin-left: 10%;">
                <?php endif; ?>
              </form> 
            </td>

            <td colspan="5">
            <div class="comment-section">
               <?php if (!empty($postComments)): ?>
                  <?php foreach ($postComments as $comment): ?>
                    <div class="comment-box">
                        <input type="text" value="<?php echo htmlspecialchars($comment["Comment"]); ?>" readonly/>
                        <p><strong><?php echo htmlspecialchars($comment["Username"]); ?>:</strong> <?php echo htmlspecialchars($comment["CreateAt"]); ?></p>
                        <hr>
                    </div>
                  <?php endforeach; ?>
              <?php else: ?>
                  <p>No comments available.</p>
              <?php endif; ?>
              </form>
            </div>
            </td>

            <td>
              <form method="POST" action="profile.php">
                <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
                <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
                <input type="text" name="comment"/> 
                <input type="submit" name="commentPost" value="Comment" style="margin-top: 2%;"/>
              </form>
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
  <?php include(BASE_PATH."/src/components/scripts.php"); ?></body>
</html>
