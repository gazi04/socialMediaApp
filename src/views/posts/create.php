<?php
    require_once "../../config.php";
    require BASE_PATH . "/src/controllers/PostController.php";
    require_once "../auth/check.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $postController = new PostController();
        $userId = $_SESSION["userId"];
        $image = $_FILES["image"];
        $caption = $_POST["caption"];
        if($postController->createPost($userId, $image, $caption)){
            header("Location: ../profile/index.php");
        } else{
            echo "Post creation failed.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <form method="post" action="create.php" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <textarea name="caption" placeholder="Add a caption..." required></textarea>
        <button type="submit">Post Image</button>
    </form>
</body>
</html>