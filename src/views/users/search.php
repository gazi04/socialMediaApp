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

<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title>Search</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
  <header id="header">
    <a href="#" class="title">Search Users</a>
    <?php include(BASE_PATH."/src/components/navbar.php"); ?>
  </header>

  <div id="wrapper">
    <form method="POST" action="search.php">
        <input type="text" name="username" placeholder="Search by username" value="%" required>
        <button type="submit">Search</button>
    </form>

    <div class="table-wrapper">
      <?php if(!empty($searchResults)): ?>
          <table style="margin:1%;">
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
                                  <img src="data:image/jpeg;base64,<?php echo base64_encode($user["ProfileImage"]); ?>" alt="Profile Image" style="max-width: 100px;">
                              <?php else: ?>
                                  <img src="../default-profile.png" alt="Default Profile Image">
                              <?php endif; ?>
                          </td>
                          <td><?php echo htmlspecialchars($user["Username"]); ?></td>
                          <td>
                            <form method="post" action="profile.php">
                                <input type="hidden" name="userId" value="<?php echo $user["UserID"] ?>" hidden readonly/>
                                <input type="submit" value="Look at my profile"></input>
                            </form>
                          </td>
                      </tr>
                  <?php endif; ?>
                  <?php endforeach; ?>
              </tbody>
          </table>
      <?php else: ?>
          <p>No users found.</p>
      <?php endif; ?>
    </div>
  </div>

  <?php include(BASE_PATH."/src/components/footer.php"); ?>
  <?php include(BASE_PATH."/src/components/scripts.php"); ?></body>
</html>
