<?php
use Controllers\UserController;
use Controllers\PostController;
use Controllers\FollowController;
use Controllers\LikeController;
use Controllers\CommentController;

$userController = new UserController();
$postController = new PostController();
$followController = new FollowController();
$likeController = new LikeController();
$commentController = new CommentController();

$userProfileData = $userController->getProfileData($_SESSION["userId"]);
$numberOfFollowers = $followController->getFollowerCount($_SESSION["userId"]);
$numberOfFollowing =  $followController->getFollowingCount($_SESSION["userId"]);

$posts = $postController->getPostsByUserId($_SESSION["userId"]);
$rows = [];
$_currentRow = [];

foreach ($posts as $post) {
  $_currentRow[] = $post;
  if (count($_currentRow) >= 3) {
    $rows[] = $_currentRow;
    $_currentRow = [];
  }
}

if (!empty($_currentRow)) {
  $rows[] = $_currentRow;
}
?>
<div class="user-profile">
  <div class="profile">
    <div class="profile-image"> <img src="data:image/jped;base64, <?php echo base64_encode($userProfileData["ProfileImage"]); ?>" /> </div>

    <div class="profile-details">
      <div class="username">
        <div class="name"><?php echo $userProfileData["Username"]; ?></div>
        <div class="options">
          <a id="editProfile" href="editAccount.php">Edit</a>
        </div>
      </div>
      <div class="stats"> 
        <div id="number-of-posts"><?php echo count($posts); ?> posts</div>&nbsp;
        <div id="number-of-followers"><?php echo $numberOfFollowers; ?> followers</div>&nbsp;
        <div id="number-of-followings"><?php echo $numberOfFollowing; ?> following</div>
      </div>
      <div class="bio">
        <p><?php echo $userProfileData["Bio"]; ?></p>
      </div>
    </div>
  </div>

  <div id="posts">
    <?php
    foreach ($rows as $row) {
      echo "<div class='row'>";
      foreach ($row as $post) {
        $caption = htmlspecialchars($post["Caption"], ENT_QUOTES, "UTF-8");
        $username = htmlspecialchars($userController->getUsernameByPostId($post["PostID"]));
        $postImage = base64_encode($post["Post"]);

        $postDataArray[] = [
          "postId" => $post["PostID"],
          "userId" => $_SESSION["userId"],
          "caption" => $caption,
          "username" => $username,
          "imageSrc" => "data:image/jped;base64, ".$postImage
        ];

        echo '<div class="post" onclick="openModal(this)" 
        data-post-id='.$post["PostID"].'
        data-user-id='.$_SESSION["userId"].'
        data-username="'.$username.'"
        data-caption="'.$caption.'"
        data-image="data:image/jped;base64, '.$postImage.'"
        ><img src="data:image/jped;base64, '.$postImage.'"/></div>';
      }
      echo "</div>";
    }
    echo "<script>setPostsArray(".json_encode($postDataArray).");</script>";
    ?>
  </div>
</div>

<dialog data-model id="postModal" style="border: none; width: 70%;">
  <div class="post-modal">
    <div class="post-image">
      <img id="modalImage" src="../../assets/images/sunflower.jpg" />
    </div>
    <div class="post-interaction">
      <div class="user" id="modalUserProfile">
        <div id="modalProfileImage"></div>
        <span id="modalUsername"></span> <span id="modalCaption"></span>
      </div>

      <div id="comments"></div>

      <div class="interactions">
        <a class="likeButton icon" 
          data-postid="<?php echo $post["PostID"]; ?>"
          data-userid="<?php echo $_SESSION["userId"]; ?>"
        >
          <img id="likeIcon" src=<?php echo $likeController->isLiked($_SESSION["userId"], $post["PostID"])? "../../assets/icons/redHeart.png": "../../assets/icons/heart.png";?> />
        </a>
        <a class="icon" style="margin-inline: 0.4em;"><img src="../../assets/icons/share.png" /></a>
        <a class="icon"><img src="../../assets/icons/send.png" /></a>
        <div class="like-counts">Likes: <span id="likes"></span></div>
      </div>

      <div class="add-comment">
        <div class="input-container">
          <input placeholder="Enter text" id="inputField" class="input-field" type="text">
        </div>
        <button id="postCommentButton" disabled>Post</button>
      </div>
      <!-- <button id="closeModal" data-close-modal>Close</button> -->
    </div>
  </div>
</dialog>
