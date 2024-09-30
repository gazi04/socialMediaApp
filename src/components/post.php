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
<!-- <tr> -->
<!--   <input type="hidden" name="userId" value="<?php //echo $profileUserId; ?>"/> -->
<!--   <td><img src="data:image/jpeg;base64,<?php //echo base64_encode($post["Post"]); ?>" alt="Post Image" style="max-width: 100px;"></td> -->
<!--   <td><?php //echo htmlspecialchars($post["Caption"]); ?></td> -->
<!---->
<!--   <td> -->
<!--     <form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
<!--       <input type="hidden" name="postId" value="<?php //echo $post["PostID"]; ?>"/> -->
<!--       <input type="hidden" name="userId" value="<?php //echo $profileUserId; ?>"/> -->
<!--       <?php //echo $likeController->getLikeCount($post["PostID"]); ?> -->
<!---->
<!--       <?php //if ($likeController->isLiked($_SESSION["userId"], $post["PostID"])): ?> -->
<!--           <input type="submit" name="unlike" value="Unlike" style="margin-left: 10%;"> -->
<!--       <?php //else: ?> -->
<!--           <input type="submit" name="like" value="Like" style="margin-left: 10%;"> -->
<!--       <?php //endif; ?> -->
<!--     </form>  -->
<!--   </td> -->
<!---->
<!--   <td colspan="5"> -->
<!--   <div class="comment-section"> -->
<!--      <?php //if (!empty($postComments)): ?> -->
<!--         <?php //foreach ($postComments as $comment): ?> -->
<!--           <div class="comment-box"> -->
<!--               <input type="text" value="<?php //echo htmlspecialchars($comment["Comment"]); ?>" readonly/> -->
<!--               <p><strong><?php //echo htmlspecialchars($comment["Username"]); ?>:</strong> <?php //echo htmlspecialchars($comment["CreateAt"]); ?></p> -->
<!--               <hr> -->
<!--           </div> -->
<!--         <?php //endforeach; ?> -->
<!--     <?php //else: ?> -->
<!--         <p>No comments available.</p> -->
<!--     <?php //endif; ?> -->
<!--   </div> -->
<!--   </td> -->
<!---->
<!--   <td> -->
<!--     <form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
<!--       <input type="hidden" name="userId" value="<?php //echo $profileUserId; ?>"/> -->
<!--       <input type="hidden" name="postId" value="<?php //echo $post["PostID"]; ?>"/> -->
<!--       <input type="text" name="comment"/>  -->
<!--       <input type="submit" name="commentPost" value="Comment" style="margin-top: 2%;"/> -->
<!--     </form> -->
<!--   </td> -->
<!-- </tr> -->
<?php //endforeach; ?>

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
      <div class="like-counts">Likes: <span id="likes<?php echo $post["PostID"]; ?>"><?php echo $post["LikeCount"] ?></span></div>
    </div>
    <div class="text"> 
      <b><?php echo htmlspecialchars($post["Username"]); ?>: </b> <?php echo htmlspecialchars($post["Caption"]) ?>
      <hr style="margin-block: 1em;">
    </div>
  </div>
</div>
<?php endforeach; ?>
