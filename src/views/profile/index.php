<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";
    include_once "../auth/check.php";

    $userController = new UserController();
    $userProfileData = $userController->getProfileData($_SESSION["userId"]);

    $postController = new PostController();
    $posts = $postController->getAllPosts();
    $userId = $_SESSION["userId"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <h1>Profile</h1>
    <h2>Username: <?php echo $userProfileData["Username"] ?></h2>
    <h2>Bio: <?php echo $userProfileData["Bio"] ?></h2>

    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="profileManagement.php">Edit Profile</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>

    <br><hr>
    <h2>Posts</h2>
    <?php if (!empty($posts)): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?php echo base64_encode($post["Post"]); ?>" alt="Post Image"></td>
                        <td><?php echo htmlspecialchars($post["Caption"]); ?></td>
                        <td>
                            <?php if ($post["UserID"] == $userId): ?>
                                <a href="../posts/edit.php?postId=<?php echo $post['PostID']; ?>">Edit</a>
                                <a href="../posts/delete.php?postId=<?php echo $post['PostID']; ?>">Delete</a>
                            <?php endif; ?>
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