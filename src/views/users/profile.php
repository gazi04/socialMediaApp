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
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <form method="POST" action="profile.php">
                          <input type="hidden" name="userId" value="<?php echo $profileUserId; ?>"/>
                          <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image"></td>
                          <td><?php echo htmlspecialchars($post["Caption"]); ?></td>
                          
                          <td>
                            <input type="hidden" name="postId" value="<?php echo $post["PostID"]; ?>"/>
                            <?php echo $likeController->getLikeCount($post["PostID"]); ?>

                            <?php if ($likeController->isLiked($_SESSION["userId"], $post["PostID"])): ?>
                                <input type="submit" name="unlike" value="Unlike">
                            <?php else: ?>
                                <input type="submit" name="like" value="Like">
                            <?php endif; ?>
                          </td>

                          <td>
                            <input type="text" name="comment"/> 
                            <input type="submit" name="commentPost" value="Comment"/>
                          </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
</body>
</html>
