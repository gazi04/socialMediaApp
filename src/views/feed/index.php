<?php 
    include_once "../../config.php";
    include_once "../auth/check.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";

    $postController = new PostController();
    $posts = $postController->getAllPosts();
    $userId = $_SESSION["userId"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
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
    <h1>Feed</h1>
    <h1><?php echo $_SESSION["username"]; ?></h1>

    <br><hr>
    <nav>
        <a href="../profile/index.php">Profile</a>
        <a href="../auth/logout.php">Logout</a>
        <a href="../posts/create.php">Create Post</a>
    </nav>

    <br><hr>
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