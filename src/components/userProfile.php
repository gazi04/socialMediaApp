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
        $caption = htmlspecialchars($post["Caption"], ENT_QUOTES, "UTF-8");
        $username = htmlspecialchars($userController->getUsernameByPostId($post["PostID"]));
        $likes = htmlspecialchars($likeController->getLikeCount($post["PostID"]));
        $postImage = base64_encode($post["Post"]);

        echo '<div class="post" onclick="openModal(this)" 
        data-post-id='.$post["PostID"].'
        data-username="'.$username.'"
        data-caption="'.$caption.'"
        data-likes="'.$likes.'"
        data-image="data:image/jped;base64, '.$postImage.'"
        ><img src="data:image/jped;base64, '.$postImage.'"/></div>';
      }
      echo "</div>";
    }
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

      <div class="comments">
        <div class="comment">
          <div class="user-image"><img src="../../assets/images/sunflower.jpg"/></div>
          <div class="text">
            <span class="username"></span>
            <span class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
          </div>
        </div>
        <div class="comment">
          <div class="user-image"><img src="../../assets/images/sunflower.jpg"/></div>
          <div class="text">
            <span class="username" id="modalUsername"></span>
            <span class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
          </div>
        </div>
      </div>

      <div class="interactions">
        <div class="icons">
          <div class="icon"><img src="../../assets/icons/heart.png" /></div>
          <div class="icon"><img src="../../assets/icons/heart.png" /></div>
          <div class="icon"><img src="../../assets/icons/heart.png" /></div>
        </div>
        <div class="text">
          <span class="likes" id="modalLikes"></span>
        </div>
      </div>

      <div class="add-comment">
        <div class="input-container">
          <input placeholder="Enter text" id="inputField" class="input-field" type="text">
        </div>
        <button id="postButton" disabled>Post</button>
      </div>
      <!-- <button id="closeModal" data-close-modal>Close</button> -->
    </div>
  </div>
</dialog>
