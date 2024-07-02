<?php
    include_once "../../config.php";
    include_once "../auth/check.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";

    $postController = new PostController();
    $postId = $_GET["postId"];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $postId = $_GET["postId"];
        if ($postController->deletePost($postId)){
            header("Location: ../profile/index.php");
        } else {
            echo "Post deletion failed.";
        }
    }
?>

<form action="delete.php?postId=<?php echo $postId; ?>" method="POST">
    <p>Are you sure you want to delete this post?</p>
    <button type="submit">Delete Post</button>
</form>
