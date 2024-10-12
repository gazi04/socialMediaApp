<?php global $likeController; ?>

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
      <a class="likeButton" 
        data-postid="<?php echo $post["PostID"]; ?>"
        data-userid="<?php echo $_SESSION["userId"]; ?>"
      >
        <img id="likeIcon" src=<?php echo $likeController->isLiked($_SESSION["userId"], $post["PostID"])? "../../assets/icons/redHeart.png": "../../assets/icons/heart.png";?> />
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
