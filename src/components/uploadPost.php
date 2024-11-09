<?php
require "../vendor/autoload.php";
use Controllers\PostController;

if(isset($_POST["createPost"])){
  $postController = new PostController();
  if($_POST["caption"] == null) {
    echo json_encode(["error" => "NO image is uploaded"]);
    exit();
  }

  echo json_encode(["test" => "asdlfjasldfalskd"]);
  exit();
  $result = $postController->createPost($_SESSION["userId"], $_POST["imagefile"], $_POST["caption"]);
  echo $result;
}
?>
