<?php
require_once "../../core/config.php";
require_once "../../vendor/autoload.php";
include \BASE_PATH . "/views/auth/check.php";
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Feed</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.js"></script>
  </head>
  <body>
    <div id="chat-container">
      <div id="chat-navbar"><?php include(BASE_PATH."/components/navbar.php"); ?></div>

      <div id="chat-rooms" class="usersList">
        <div id="searchBar" style="padding-right: 1em;">
          <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
          <input placeholder="Search" type="search" id="searchingTerm" class="input"/>
        </div>

        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
        <img src="../../assets/images/sunflower.jpg"/>
        <span class='username'>Test</span>
      </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
        <div class="user">
          <img src="../../assets/images/sunflower.jpg"/>
          <span class='username'>Test</span>
        </div>
      </div>

      <div id="chat-room">
        <div id="messages">
          <div class="received">
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
          </div>
          <div class="sended">
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
          </div>
          <div class="received">
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
            <div class="message">hallo</div>
          </div>
        </div>
        <div id="message-input">
          <input type="text" placeholder="Message">
          <button>
            <img src="../../assets/icons/send.png"/>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>


