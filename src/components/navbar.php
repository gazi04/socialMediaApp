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
      <a id="searchOption" href="#" class="menuOption">
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
      <a id="userProfile" class="menuOption">
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

  <div id="searchContainer">
    <div id="closeContainer"><img id="closeSearch" src="../../assets/icons/close.png"/></div> 
    <div id="searchBar">
      <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
      <input placeholder="Search" type="search" id="searchingTerm" class="input"/>
    </div>
    <div id="users-list" style="height: 90vh;"></div>
  </div>
  
  <div class="vertical-line"></div>
</nav>
