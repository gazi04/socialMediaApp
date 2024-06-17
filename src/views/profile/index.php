<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <h1>
    <?php
        include_once "../auth/check.php";

        echo $_SESSION["username"];
    ?>
    </h1>

    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
</body>
</html>