<?php
include_once "../../config.php";
include_once BASE_PATH . "/src/controllers/FollowController.php";
include_once "../auth/check.php";

$followerController = new FollowController();
$followers = $followerController->getFollowers($_SESSION["userId"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
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
    </style>
</head>
<body>
    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="../profile/index.php">Your Profile</a>
        <a href="../users/search.php">Search</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>

    <h2>Followers</h2>
    <?php if (!empty($followers)): ?>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($followers as $follower): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($follower["Username"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no followers.</p>
    <?php endif; ?>
</body>
</html>
