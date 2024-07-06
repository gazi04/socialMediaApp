<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";
    include_once BASE_PATH . "/src/controllers/FollowController.php"
    include_once BASE_PATH . "/src/views/auth/check.php";

    $userController = new UserController();
    $postController = new PostController();
    $followController = new FollowController();
    $profileUserId;
    $isFOllowing;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $profileUserId = $_POST["userId"];
        $user = $userController->getProfileData($profileUserId);
        $posts = $postController->getPostsByUserId($profileUserId);
        $isFollowing = $followContreller->isFollowing($_SESSION["userId"]);
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

    <?php if ($isFollowing): ?>
      <form method="post" action="follow.php">
        <input type="input" name="profileUserId" value="<?php echo $profileUserId; ?>" />
        <input type="submit" name="follow" value="Follow">
      </form>
    <?php else: ?>
      <form method="post" action="unfollow.php">
        <input type="input" name="profileUserId" value="<?php echo $profileUserId; ?>" />
        <input type="submit" name="unfollow" value="Unfollow">
      </form>
    <?php endif; ?>

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
