<?php
    include_once "../../config.php";
    include_once BASE_PATH . "/src/controllers/UserController.php";
    include_once BASE_PATH . "/src/views/auth/check.php";

    $userController = new UserController();
    $searchResults = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $searchResults = $userController->searchUsers($username);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Users</title>
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
    <nav>
        <a href="../feed/index.php">Feed</a>
        <a href="../profile/index.php">Your Profile</a>
        <a href="../users/search.php">Search</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
    
    <h1>Search Users</h1>
    <form method="POST" action="search.php">
        <input type="text" name="username" placeholder="Search by username" value="%" required>
        <button type="submit">Search</button>
    </form>
    <br><hr>
    <?php if(!empty($searchResults)): ?>
        <table>
            <thead>
                <tr>
                    <th>Profile Image</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($searchResults as $user): ?>
                <?php if($user["UserID"] != $_SESSION["userId"]): ?>
                    <tr>
                        <td>
                            <?php if($user["ProfileImage"]): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($user["ProfileImage"]); ?>" alt="Profile Image">
                            <?php else: ?>
                                <img src="../default-profile.png" alt="Default Profile Image">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($user["Username"]); ?></td>
                        <form method="post" action="profile.php">
                            <input type="text" name="userId" value="<?php echo $user["UserID"] ?>" hidden/>
                            <td><input type="submit" value="Look at my profile"></input></td>
                        </form>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
