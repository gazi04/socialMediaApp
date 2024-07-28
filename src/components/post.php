<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
global $likeController, $commentController, $followController, $profileUserId, $posts, $comments;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $profileUserId = $_POST["userId"];

  if (isset($_POST["like"])) {
    $likeController->likePost($_SESSION["userId"], $_POST["postId"]);
  } elseif (isset($_POST["unlike"])) {
    $likeController->unlikePost($_SESSION["userId"], $_POST["postId"]);
  }

  if (isset($_POST["commentPost"]) && isset($_POST["comment"])) {
    $commentController->commentPostById($_SESSION["userId"], $_POST["postId"], $_POST["comment"]);
  }
}

$comments = [];
if(!empty($posts)){
  foreach($posts as $post){
    $comments[$post['PostID']] = $commentController->getCommentByPostId($post['PostID']);
  }
}
?>


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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
  </div>
  </td>

  <td>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
      <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
      <input type="text" name="comment"/> 
      <input type="submit" name="commentPost" value="Comment" style="margin-top: 2%;"/>
    </form>
  </td>
</tr>
<?php endforeach; ?>
