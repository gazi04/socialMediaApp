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

    // Get comments for each post
    $comments = [];
    if (!empty($posts)) {
        foreach ($posts as $post) {
            $comments[$post['PostID']] = $commentController->getCommentByPostId($post['PostID']);
        }
    }

    $commentIndexes = array_fill_keys(array_keys($comments), 0);
    echo var_dump($commentIndexes);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($posts as $post) {
            $postId = $post['PostID'];
            if (isset($_POST["next_$postId"])) {
                $commentIndexes[$postId] = min($commentIndexes[$postId] + 1, count($comments[$postId]) - 1);
            } elseif (isset($_POST["prev_$postId"])) {
                $commentIndexes[$postId] = max($commentIndexes[$postId] - 1, 0);
            }
        }
      echo var_dump($commentIndexes);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($user["Username"]) ?></title>
  <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    img {
        max-width: 100px;
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
            $currentIndex = $commentIndexes[$postId];
            echo "commentdIndexes[postId] = ".$commentIndexes[$postId];
            echo "<br>";
            echo "currentIndex = ".$currentIndex; 
            echo "<br>";
            echo "commentIndexes = ".var_dump($commentIndexes);
            $currentComment = $comments[$postId][$currentIndex] ?? null;
          ?>
          <tr>
            <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image"></td>
            <td><?php echo htmlspecialchars($post["Caption"]); ?></td>

            <td>
              <form method="POST" action="profile.php">
                <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
                <?php echo $likeController->getLikeCount($post["PostID"]); ?>

                <?php if ($likeController->isLiked($_SESSION["userId"], $post["PostID"])): ?>
                    <input type="submit" name="unlike" value="Unlike">
                <?php else: ?>
                    <input type="submit" name="like" value="Like">
                <?php endif; ?>
              </form> 
            </td>

            <td colspan="4">
              <form method="POST" action="profile.php">
                <?php if ($currentComment): ?>
                  <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
                  <input type="hidden" name="postId" value="<?php echo $postId; ?>"/>
                  <input type="text" value="<?php echo htmlspecialchars($currentComment["Comment"]); ?>" readonly/>
                  <p>By: <?php echo htmlspecialchars($currentComment["Username"]); ?> at <?php echo htmlspecialchars($currentComment["CreateAt"]); ?></p>
                  <button type="submit" name="prev_<?php echo $postId; ?>">Prev</button>
                  <button type="submit" name="next_<?php echo $postId; ?>">Next</button>
                <?php else: ?>
                  <p>No comments available.</p>
                <?php endif; ?>
              </form>
            </td>

            <td>
              <form method="POST" action="profile.php">
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
