<?php
require_once "../../config.php";
require_once BASE_PATH . "/src/controllers/UserController.php";
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
    <h1>Search Users</h1>
    <form method="POST" action="search.php">
        <input type="text" name="username" placeholder="Search by username" required>
        <button type="submit">Search</button>
    </form>
    <br><hr>
    <?php if(!empty($searchResults)): ?>
        <table>
            <thead>
                <tr>
                    <th>Profile Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Bio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($searchResults as $user): ?>
                    <tr>
                        <td>
                            <?php if($user["ProfileImage"]): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($user["ProfileImage"]); ?>" alt="Profile Image">
                            <?php else: ?>
                                <img src="../default-profile.png" alt="Default Profile Image">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($user["Username"]); ?></td>
                        <td><?php echo htmlspecialchars($user["Email"]); ?></td>
                        <td><?php echo htmlspecialchars($user["Bio"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
