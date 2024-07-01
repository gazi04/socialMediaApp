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
</head>
<body>
    <h1>Feed</h1>
    <h1><?php echo $_SESSION["username"]; ?></h1>

    <br><hr>
    <nav>
        <a href="../profile/index.php">Profile</a>
        <a href="../users/search.php">Search</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>

</body>
</html>