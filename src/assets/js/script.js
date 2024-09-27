console.log('script.js loaded');
function highlightIcon(element, boldIcon) {
  element.querySelector("img").src = boldIcon;
}

function unHighlightIcon(element, originalIcon) {
  element.querySelector("img").src = originalIcon;
}

function dislikePost(postId, userId) {
  const request = new XMLHttpRequest();
  request.open("POST", "../../views/feed/index.php", true);

  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      console.log(request.responseText);
    }
  }

  request.send("likePost=true&postId=" + encodeURIComponent(postId) + "&userId=" + encodeURIComponent(userId))
}

function likePost(postId, userId) {
  const request = new XMLHttpRequest();
  request.open("POST", "../../views/feed/index.php", true);

  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      console.log(request.responseText);
    }
  }

  request.send("dislikePost=true&postId=" + encodeURIComponent(postId) + "&userId=" + encodeURIComponent(userId))
}
