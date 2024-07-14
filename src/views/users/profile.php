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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($user["Username"]) ?></title>
  <style>
    table{
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid black;
    }
    th, td{
        padding: 10px;
        text-align: left;
    }
    img{
        max-width: 100px;
    }
    .comment-box{
        width: 90%;
        border: 1px solid black;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }
    .comment-box p{
        margin: 5px 0;
    }
    .comment-box input{
        width: 100%;
        border: none;
        background-color: #f9f9f9;
        font-size: 14px;
    }
    .comment-section{
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ddd;
      padding: 10px;
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <nav>
    <a href="../feed/index.php">Feed</a>
    <a href="../profile/index.php">Your Profile</a>
    <a href="../users/search.php">Search</a>
    <a href="../auth/logout.php">Logout</a>
  </nav>

  <h2>Username: <?php echo $user["Username"] ?></h2>
  <p>Bio: <?php echo $user["Bio"] ?></p>

  <form method="post" action="profile.php">
    <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
    <?php if ($isFollowing): ?>
        <input type="submit" name="unfollow" value="Unfollow">
    <?php else: ?>
        <input type="submit" name="follow" value="Follow">
    <?php endif; ?>
  </form>

  <h3>Followers:<?php echo $followerCount; ?> | Following:<?php echo $followingCount; ?></h3>

  <br><hr>
  <h2>Posts</h2>
  <?php if (!empty($posts)): ?>
    <table>
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
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image"></td>
            <td><?php echo htmlspecialchars($post["Caption"]); ?></td>

            <td>
              <form method="POST" action="profile.php">
                <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
                <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
                <?php echo $likeController->getLikeCount($post["PostID"]); ?>

                <?php if ($likeController->isLiked($_SESSION["userId"], $post["PostID"])): ?>
                    <input type="submit" name="unlike" value="Unlike">
                <?php else: ?>
                    <input type="submit" name="like" value="Like">
                <?php endif; ?>
              </form> 
            </td>

            <td colspan="5">
            <div class="comment-section">
               <?php if (!empty($postComments)): ?>
                  <?php foreach ($postComments as $comment): ?>
                    <div class="comment-box">
                        <p><strong><?php echo htmlspecialchars($comment["Username"]); ?>:</strong> <?php echo htmlspecialchars($comment["CreateAt"]); ?></p>
                        <input type="text" value="<?php echo htmlspecialchars($comment["Comment"]); ?>" readonly/>
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
                <input type="submit" name="commentPost" value="Comment"/>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
  <?php else: ?>
    <p>No posts available.</p>
  <?php endif; ?>
</body>
</html>
