<?php
$feedPath = "../feed/index.php";
$myProfilePath = "../profile/index.php";
$logoutPath = "../auth/logout.php";
?>
<nav>
  <ul class="menu">
    <div id="banner">
      <a href="#">Welcome, test</a>
    </div>

    <li>
      <a href="<?php echo $feedPath ?>" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/whiteHome.png" data-original-icon="../../assets/icons/whiteHome.png" data-highlighted-icon="../../assets/icons/blackHome.png"/></div>
        <div class="page"><span>Feed</span></div>
      </a>
    </li>
    <li>
      <a href="#" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/search.png" data-original-icon="../../assets/icons/search.png" data-highlighted-icon="../../assets/icons/highlightedSearch.png" /></div>
        <div class="page"><span>Search</span></div>
      </a>
    </li>
    <li>
      <a href="#" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/clapperboard.png" data-original-icon="../../assets/icons/clapperboard.png" data-highlighted-icon="../../assets/icons/highlightedClapperboard.png" /></div>
        <div class="page"><span>Reels</span></div>
      </a>
    </li>
    <li>
      <a href="#" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/send.png" data-original-icon="../../assets/icons/send.png" data-highlighted-icon="../../assets/icons/sendBlack.png"/></div>
        <div class="page"><span>Messages</span></div>
      </a>
    </li>
    <li>
      <a href="#" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/heart.png" data-original-icon="../../assets/icons/heart.png" data-highlighted-icon="../../assets/icons/highlightedHeart.png" /></div>
        <div class="page"><span>Notifications</span></div>
      </a>
    </li>
    <li>
      <a href="#" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/create.png" data-original-icon="../../assets/icons/create.png" data-highlighted-icon="../../assets/icons/highlightedCreate.png" /></div>
        <div class="page"><span>Create</span></div>
      </a>
    </li>
    <li>
      <a href="<?php echo $myProfilePath; ?>" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/home.png" data-original-icon="../../assets/icons/home.png" data-highlighted-icon="../../assets/icons/blackHome.png" /></div>
        <div class="page"><span>Profile</span></div>
      </a>
    </li>
    <li class="last-item" id="menuOption">
      <a href="<?php echo $logoutPath; ?>" class="menuOption">
        <div class="icon"><img id="menuIcon" src="../../assets/icons/home.png" data-original-icon="../../assets/icons/home.png" data-highlighted-icon="../../assets/icons/blackHome.png" /></div>
        <div class="page"><span>Logout</span></div>
      </a>
    </li>
  </ul>

  <div class="vertical-line"></div>
</nav>
