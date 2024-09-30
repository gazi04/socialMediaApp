function highlightIcon(element, boldIcon) {
  element.querySelector("img").src = boldIcon;
}

function unHighlightIcon(element, originalIcon) {
  element.querySelector("img").src = originalIcon;
}

function likeOrDislikePost(postId, userId) {
  const request = new XMLHttpRequest();
  request.open("POST", "../../components/likeHandler.php", true);

  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      console.log(request.responseText);
      const response = JSON.parse(request.responseText);

      if(response.isLiked) {
        document.getElementById("likeIcon"+postId).src =  "../../assets/icons/redHeart.png";
      }
      else {
        document.getElementById("likeIcon"+postId).src =  "../../assets/icons/heart.png";
      }

      document.getElementById("likes"+postId).innerHTML = response.likes;
    }
  }
  request.send("likeHandler=true&postId=" + encodeURIComponent(postId) + "&userId=" + encodeURIComponent(userId))
  // request.send("likeOrDislikePost=true&postId=" + encodeURIComponent(postId) + "&userId=" + encodeURIComponent(userId))
}
