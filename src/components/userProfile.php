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
          <a class="follow" style="margin-right: 5px;">Follow</a>
          <a class="follow">Follow</a>
        </div>
      </div>
      <div class="stats"> 
        <div id="number-of-posts"><?php echo count($posts); ?> posts</div>&nbsp;
        <div id="number-of-followers"><?php echo $numberOfFollowers; ?> followers</div>&nbsp;
        <div id="number-of-followings"><?php echo $numberOfFollowing; ?> following</div>
      </div>
      <div class="bio">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
          test,
          molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
          numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
        </p>
      </div>
    </div>
  </div>

  <div id="posts">
    <?php
    foreach ($rows as $row) {
      echo "<div class='row'>";
      foreach ($row as $post) {
        echo '<div class="post" onclick="openModal()"><img src="data:image/jped;base64, '.base64_encode($post["Post"]).' "  /></div>';
      }
      echo "</div>";
    }
    ?>
  </div>
</div>
<dialog data-model id="postModal"> 
  <button id="closeModal" data-close-modal>Close</button>
</dialog>
