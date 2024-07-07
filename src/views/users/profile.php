<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";
    include_once BASE_PATH . "/src/controllers/FollowController.php";
    include_once BASE_PATH . "/src/views/auth/check.php";

    $userController = new UserController();
    $postController = new PostController();
    $followController = new FollowController();
    $profileUserId;
    $isFollowing;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $profileUserId = $_POST["userId"];
        $user = $userController->getProfileData($profileUserId);
        $posts = $postController->getPostsByUserId($profileUserId);

        if (isset($_POST['follow'])) {
          $followController->followUser($_SESSION["userId"], $profileUserId);
        } elseif (isset($_POST['unfollow'])) {
          $followController->unfollowUser($_SESSION["userId"], $profileUserId);
        }

        $isFollowing = $followController->isFollowing($_SESSION["userId"], $profileUserId);
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

    <br><hr>
    <h2>Posts</h2>
    <?php if (!empty($posts)): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image"></td>
                        <td><?php echo htmlspecialchars($post["Caption"]); ?></td>
                        <td><?php //TODO:need to give to users the choice to like the posts from other users  ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
</body>
</html>
