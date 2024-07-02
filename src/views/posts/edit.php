<?php
    include_once "../../config.php";
    include_once "../auth/check.php";
    include_once BASE_PATH . "/src/controllers/PostController.php";

    $postController = new PostController();
    $postId = $_GET["postId"];
    $post = $postController->getPostById($postId);
    

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $caption = $_POST["caption"];
        $postId = $_GET["postId"];
        if ($postController->updatePost($postId, $caption)){
            header("Location: ../profile/index.php");
        } else{
            echo "Post update failed.";
        }
    }
?>

<form action="edit.php?postId=<?php echo $postId; ?>" method="POST">
    <textarea name="caption" required><?php echo htmlspecialchars($post["Caption"]); ?></textarea>
    <button type="submit">Update Post</button>
</form>