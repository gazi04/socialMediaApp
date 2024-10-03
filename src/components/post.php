<?php
/* if (session_status() == PHP_SESSION_NONE) { */
/*     session_start(); */
/* } */
/* global $likeController, $commentController, $followController, $profileUserId, $posts, $comments; */
/**/
/* if ($_SERVER["REQUEST_METHOD"] == "POST") { */
/*   $profileUserId = $_POST["userId"]; */
/**/
/*   if (isset($_POST["like"])) { */
/*     $likeController->likePost($_SESSION["userId"], $_POST["postId"]); */
/*   } elseif (isset($_POST["unlike"])) { */
/*     $likeController->unlikePost($_SESSION["userId"], $_POST["postId"]); */
/*   } */
/**/
/*   if (isset($_POST["commentPost"]) && isset($_POST["comment"])) { */
/*     $commentController->commentPostById($_SESSION["userId"], $_POST["postId"], $_POST["comment"]); */
/*   } */
/* } */
/**/
/* $comments = []; */
/* if(!empty($posts)){ */
/*   foreach($posts as $post){ */
/*     $comments[$post['PostID']] = $commentController->getCommentByPostId($post['PostID']); */
/*   } */
/* } */
?>


<?php //foreach ($posts as $post): ?>
<?php
/* $postId = $post["PostID"]; */
/* $postComments = $comments[$postId] ?? []; */
?>

<?php 
global $likeController;

if (isset($_POST["likeOrDislikePost"]) && isset($_POST["postId"]) && isset($_POST["userId"])) {
  $likeController->likeOrUnlikePost($_POST["userId"], $_POST["postId"]);
}

if (isset($_POST["dislikePost"]) && isset($_POST["postId"]) && isset($_POST["userId"])) {
  $likeController->unlikePost($_POST["userId"], $_POST["postId"]);
}

?>

<?php foreach ($posts as $post): ?>
<div class="post">
  <div class="account"> 
    <?php if (!empty($post["ProfileImage"])): ?>
      <div class="user-profile-image"><img src="data:image/jpeg;base64, <?php echo base64_encode($post["ProfileImage"]); ?>" /></div>
    <?php else: ?>
      <div class="user-profile-image"><img src="../../assets/images/defaultUser.jpg" /></div>
    <?php endif; ?>
    <div class="username"><?php echo htmlspecialchars($post["Username"]) ?></div>
  </div>
  <div class="image">
    <img src="data:image/jped;base64, <?php echo base64_encode($post["Post"]); ?>" />
  </div>
  <div class="caption">
    <div class="intercation">
      <a onclick="likeOrDislikePost(<?php echo $post["PostID"]; ?>, <?php echo $_SESSION["userId"]; ?>)">
        <img id="likeIcon<?php echo $post["PostID"]; ?>" src=<?php echo $likeController->isLiked($_SESSION["userId"], $post["PostID"])? "../../assets/icons/redHeart.png": "../../assets/icons/heart.png";?> />
      </a>
      <a><img src="../../assets/icons/share.png" /></a>
      <a><img src="../../assets/icons/send.png" /></a>
      <div class="like-counts">Likes: <span id="likes"><?php echo $post["LikeCount"] ?></span></div>
    </div>
    <div class="text"> 
      <b><?php echo htmlspecialchars($post["Username"]); ?>: </b> <?php echo htmlspecialchars($post["Caption"]) ?>
      <hr style="margin-block: 1em;">
    </div>
  </div>
</div>
<?php endforeach; ?>
