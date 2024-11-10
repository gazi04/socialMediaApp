<?php
require "../vendor/autoload.php";
use Controllers\PostController;

header('Content-Type: application/json');

if(isset($_POST["createPost"])){
  $postController = new PostController();
  if($_POST["caption"] == null) {
    echo json_encode(["error" => "NO image is uploaded"]);
    exit();
  }

  /* echo json_encode(["test" => "asdlfjasldfalskd"]); */
  session_start();
  $result = $postController->createPost($_SESSION["userId"], $_FILES["imagefile"], $_POST["caption"]);
  echo json_encode(["result" => $result]);
}
?>
