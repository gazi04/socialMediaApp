<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
</head>
<body>
    <h1>Feed</h1>
    <h1>
    <?php
        include_once "../auth/check.php";

        echo $_SESSION["username"];
    ?>
    </h1>

    <nav>
        <a href="../profile/index.php">Profile</a>
        <a href="../auth/logout.php">Logout</a>
        <a href="../posts/create.php">Create Post</a>
    </nav>
</body>
</html>