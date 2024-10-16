$(document).ready(function() {
  let postsArray = [];
  let currentIndex = 0;

  function openmodal(postelement) {
    const postid = $(postelement).data('post-id');
    const post = getPostFromArray(postid);

    $(".like").attr("data-postid", post["postId"]);
    $(".like").attr("data-userid", post["userId"]);

    $("#postCommentButton").attr("data-postid", postid);

    $("#modalProfileImage").empty();
    // DISPLAYS THE USER PROFILE IMAGE WHO'S MADE THIS POST, IT NEEDS ANOTHER SOLUTION
    // BECAUSE IT ISN'T DYNAMIC AS YOU CAN SEE IT CLONE ONLY THE PROFILE IMAGE FROM THE USER PROFILE PAGE
    $(".profile-image").children("img").clone().appendTo("#modalProfileImage");

    fetchDataIntoPostModal(post);
    $("#postModal")[0].showModal();
  }

  // TAKES THE POSTS FROM THE HTML PAGE 
  function setPostsArray(posts){ postsArray = posts; }

  function getPostFromArray(postId){
    for (let index = 0; index < postsArray.length; index++) {
      if (postsArray[index]["postId"] === postId){
        currentIndex = index;
        return postsArray[index];
      }
    }
  }

  function fetchDataIntoPostModal(post){
    fetchImageUsernameAndCaption(post["username"], post["caption"], post["imageSrc"]);
    fetchComments(post["postId"]);
    fetchLikes(post["postId"], post["userId"]);
    $(".like").attr("data-postid", post["postId"]);
    $(".like").attr("data-userid", post["userId"]);

    $("#postCommentButton").attr("data-postid", post["postId"]);
  }

  function fetchImageUsernameAndCaption(username, caption, image){
    $("#modalUsername").text(username);
    $("#modalCaption").text(caption);
    $("#modalImage").prop("src", image);
  }

  function fetchLikes(postId, userId){
    $.post("../../components/likeHandler.php", 
      {
        likeStatus: true,
        postId: postId,
        userId: userId
      }, 
      function(response) {
        if(response.isLiked){ $("#likeIcon").prop("src", "../../assets/icons/redHeart.png"); }
        else { $("#likeIcon").prop("src", "../../assets/icons/heart.png"); }

        $("#likes").empty();
        $("#likes").text(response.likes);
      },
      "json"
    );
  }

  function fetchComments(postId){
    $.post("../../components/commentHandler.php",
      {
        getComments: true,
        postId: postId
      },
      function(response){ $("#comments").html(response) }
    );
  }

  function fetchUsersThatIFollow($myUserId){
    $.post("../../components/getUsers.php",
      {
        getUsersThatIFollow: true,
        userId: $myUserId
      },
      function(response){ $("#users-list").html(response); }
    );
  }
  
  function fetchUsersThatFollowMe($myUserId){
    $.post("../../components/getUsers.php",
      {
        getUsersThatFollowMe: true,
        userId: $myUserId
      },
      function(response){ $("#users-list").html(response); }
    );
  }

  function openFollowListModal(element, userId, option){
    if (option === "followers"){
      fetchUsersThatIFollow(userId);
    }
    else if (option === "followings"){
      fetchUsersThatFollowMe(userId);
    }
    $("#userListModal")[0].showModal();
  }

  // HIGHLIGHT ICONS IF MOUSE IS OVER THE NAVBAR BUTTONS
  $(".menuOption").hover(
    function(){
      const icon = $(this).children(".icon").children("img");
      $(icon).prop("src", icon.data("highlighted-icon"));
    },
    function(){
      const icon = $(this).children(".icon").children("img");
      $(icon).prop("src", icon.data("original-icon"));
    }
  );

  // HANDLES LIKES IN THE FEED VIEW
  $(".likeButton").on("click", function(){
    const postid = $(this).data("postid");
    const userid = $(this).data("userid");
    const likeicon = $(this).children("#likeIcon");
    const likespan = $(this).siblings(".like-counts").children("#likes");

    $.post("../../components/likeHandler.php", 
      {
        likeHandler: true,
        postId: postid,
        userId: userid
      }, 
      function(response) {
        if(response.isLiked){ likeicon.prop("src", "../../assets/icons/redHeart.png"); } 
        else { likeicon.prop("src", "../../assets/icons/heart.png"); }

        likespan.empty();
        likespan.text(response.likes);
      },
      "json"
    ).fail(function(jqxhr, textstatus, errorthrown) {
        console.error("request failed:", textstatus, errorthrown);
        console.error("response text:", jqxhr.responsetext);
      });
  });


  // HANDLES THE LIKES IN THE POSTS THAT ARE DISPLAYED IN THE MODAL POP UP
  $(".like").on("click", function() {
    const likespan = $(this).siblings(".like-counts").children("#likes");
    const likeicon = $(this).children("#likeIcon");
    const postid = $(this).attr("data-postid");
    const userid = $(this).attr("data-userid");

    $.post("../../components/likeHandler.php", 
      {
        likeHandler: true,
        postId: postid,
        userId: userid
      }, 
      function(response) {
        if(response.isLiked){ likeicon.prop("src", "../../assets/icons/redHeart.png"); }
        else { likeicon.prop("src", "../../assets/icons/heart.png"); }

        likespan.empty();
        likespan.text(response.likes);
      },
      "json"
    ).fail(function(jqxhr, textstatus, errorthrown) {
        console.error("request failed:", textstatus, errorthrown);
        console.error("response text:", jqxhr.responsetext);
      });
  });

  // STORES THE COMMENT IN THE DATABASE AND REFRESHES THE LISTS OF COMMENTS
  $("#postCommentButton").on("click", function() {
    const comment = $(this).siblings(".input-container").children("#inputField");
    // console.log($(this));
    console.log($(this).attr("data-postid"));

    $.post("../../components/commentHandler.php",
      {
        postComment: true,
        postId: $(this).attr("data-postid"),
        comment: comment.val()
      },
      function(response){
        console.log(response);
      }
    );

    fetchComments($(this).data("postid"));
    comment.val("");
    $postcommentbutton.removeClass("enable");
  });

  // CLOSE POST MODAL OR USER LIST MODAL IF CLICKED OUTSIDE THE MODAL
  $(window).on("click", function(e){
    if ($(e.target).is("#postModal")){
      $("#inputField").val("");
      $("#postModal")[0].close();
    }
    else if ($(e.target).is("#userListModal")){
      $("#userListModal")[0].close();
    }
  });

  // ENABLE AND DISABLE THE POST BUTTON FOR COMMENTS IN THE POST MODAL ACCORDING IF THERE IS ANY INPUT
  const $inputfield = $("#inputField");
  const $postcommentbutton = $("#postCommentButton");

  $inputfield.on("input", function(){
    if($inputfield.val().trim() !== ""){
      $postcommentbutton.prop("disabled", false);
      $postcommentbutton.addClass("enable");
    } else {
      $postcommentbutton.prop("disabled", true);
      $postcommentbutton.removeClass("enable");
    }
  });

  // ENABLE AND DISABLE THE SUBMIT BUTTON FOR THE EDIT ACCOUNT PAGE ACCORDING IF THERE IS ANY INPUT
  const $biotextarea = $("#bioInput");
  const $editprofilesubmit = $("#submitProfile");

  $biotextarea.on("input", function(){
    if($biotextarea.val().trim() !== ""){
      $editprofilesubmit.prop("disabled", false);
      $editprofilesubmit.addClass("enable");
    } else {
      $editprofilesubmit.prop("disabled", true);
      $editprofilesubmit.removeClass("enable");
    }
  })

  // EVERYTIME THE USER CLICK THE PROFILE IMAGE IT WOULD ACTUALLY CLICK THE BUTTON TO CHANGE THE IMAGE
  $(".current-user").children("img").on("click", function(){ 
    $("#changePhotoLink a").click();
  });

  $("#changePhotoLink").on("click", function(e) {
    e.preventDefault();
    $("#imageInput").click();
  });

  // CHANGE PROFILE IMAGE TO THE IMAGE THAT THE USER UPLOADS
  $("#imageInput").on("change", function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        $(".current-user").children("img").attr("src", e.target.result);
      }
      reader.readAsDataURL(file);
      $editprofilesubmit.prop("disabled", false);
      $editprofilesubmit.addClass("enable");
    }
  });

  $("#submitProfile").on("click", function(e) {
    e.preventDefault();

    const bio = $("#bioInput").val();
    const imagefile = $("#imageInput")[0].files[0];

    const formdata = new FormData();
    formdata.append("editAccount", true);
    formdata.append("bio", bio);
    formdata.append("image", imagefile);

    $.ajax({
      url: "editAccount.php",
      type: "post",
      data: formdata,
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response)
        window.location.href = "index.php";
      },
      error: function(jqxhr, textstatus, errorthrown) {
        console.error("error:", textstatus, errorthrown);
      }
    });
  });

  $("#prevPost").on("click", function(){
    if (currentIndex == 0) { currentIndex = postsArray.length - 1; }
    else { currentIndex -= 1;}

    const post = postsArray[currentIndex];
    fetchDataIntoPostModal(post);
  });

  $("#nextPost").on("click", function(){
    if (currentIndex == (postsArray.length - 1)) { currentIndex = 0; }
    else { currentIndex += 1;}

    const post = postsArray[currentIndex];
    fetchDataIntoPostModal(post);
  });

  $("#searchOption").on("click", function(e){
    e.preventDefault();
    $("#searchContainer").show().removeClass("fadeOutLeft");
    $("#searchContainer").show().addClass("fadeInLeft");
  });

  $("#closeSearch").on("click", function(e){
    e.preventDefault();
    $("#searchContainer").show().removeClass("fadeInLeft");
    $("#searchContainer").show().addClass("fadeOutLeft");
  });

  // SETTING FUNCTIONS TO BE USED GLOBALLY
  window.openModal = openmodal;
  window.openFollowListModal = openFollowListModal;
  window.setPostsArray = setPostsArray;
});
