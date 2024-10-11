$(document).ready(function() {
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

  $(".likeButton").on("click", function(){
    const postId = $(this).data("postid");
    const userId = $(this).data("userid");
    const likeIcon = $(this).children("#likeIcon");
    const likeSpan = $(this).siblings(".like-counts").children("#likes");

    $.post("../../components/likeHandler.php", 
      {
        likeHandler: true,
        postId: postId,
        userId: userId
      }, 
      function(response) {
        if(response.isLiked){
          likeIcon.prop("src", "../../assets/icons/redHeart.png");
        } else { likeIcon.prop("src", "../../assets/icons/heart.png"); }

        likeSpan.empty();
        likeSpan.text(response.likes);
      },
      "json"
    ).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Request failed:", textStatus, errorThrown);
        console.error("Response Text:", jqXHR.responseText);
      });
  });

  function openModal(postElement) {
    const postId = $(postElement).data('post-id');
    const userId = $(postElement).data("user-id");
    const caption = $(postElement).data('caption');
    const username = $(postElement).data('username');
    const imageSrc = $(postElement).data('image');

    $(".likeButton").attr("data-postid", postId);
    $("#postCommentButton").attr("data-postid", postId)

    $("#modalProfileImage").empty();
    $(".profile-image").children("img").clone().appendTo("#modalProfileImage");

    $('#modalImage').prop('src', imageSrc);
    $('#modalCaption').text(caption);
    $('#modalUsername').text(username);

    $.post("../../components/getComments.php",
      {
        getComments: true,
        postId: postId
      },
      function(response) {
        $("#comments").html(response)
      }
    );

    $.post("../../components/likeHandler.php", 
      {
        likeStatus: true,
        postId: postId,
        userId: userId
      }, 
      function(response) {
        if(response.isLiked){
          $("#likeIcon").prop("src", "../../assets/icons/redHeart.png");
        } else { $("#likeIcon").prop("src", "../../assets/icons/heart.png"); }

        $("#likes").empty();
        $("#likes").text(response.likes);
      },
      "json"
    );

    // $('#modalUserProfile').html(`<img src="data:image/jped;base64, ${profilePictureSrc}"/> <b>${username}</b> ${caption}`);

    $('#postModal')[0].showModal();

    // Optional: you can store postId if needed for future actions (e.g., liking the post)
    // $('#likeButton').data('post-id', postId);
  }

  // CLOSE POST MODAL IF CLICKED OUTSIDE THE MODAL
  $(window).on('click', function(e) {
    if ($(e.target).is('#postModal')) {
      $('#postModal')[0].close();
    }
  });

  // STORES THE COMMENT IN THE DATABASE AND REFRESHES THE LISTS OF COMMENTS
  $("#postCommentButton").on("click", function() {
    const comment = $(this).siblings(".input-container").children("#inputField");

    $.post("../../components/postComment.php",
      {
        postComment: true,
        postId: $(this).data("postid"),
        comment: comment.val()
      }
    );

    $.post("../../components/getComments.php",
      {
        getComments: true,
        postId: $(this).data("postid")
      },
      function(response) {
        $("#comments").html(response)
      }
    );

    comment.val("");
  });

  // ENABLE AND DISABLE THE POST BUTTON FOR COMMENTS IN THE POST MODAL ACCORDING IF THERE IS ANY INPUT
  const $inputField = $("#inputField");
  const $postCommentButton = $("#postCommentButton");

  $inputField.on("input", function(){
    if($inputField.val().trim() !== ""){
      $postCommentButton.prop("disabled", false);
      $postCommentButton.addClass("enable");
    } else {
      $postCommentButton.prop("disabled", true);
      $postCommentButton.removeClass("enable");
    }
  });

  // ENABLE AND DISABLE THE SUBMIT BUTTON FOR THE EDIT ACCOUNT PAGE ACCORDING IF THERE IS ANY INPUT
  const $bioTextarea = $("#bioInput");
  const $editProfileSubmit = $("#submitProfile");

  $bioTextarea.on("input", function(){
    if($bioTextarea.val().trim() !== ""){
      $editProfileSubmit.prop("disabled", false);
      $editProfileSubmit.addClass("enable");
    } else {
      $editProfileSubmit.prop("disabled", true);
      $editProfileSubmit.removeClass("enable");
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
      $editProfileSubmit.prop("disabled", false);
      $editProfileSubmit.addClass("enable");
    }
  });

  $("#submitProfile").on("click", function(e) {
    e.preventDefault();

    const bio = $("#bioInput").val();
    const imageFile = $("#imageInput")[0].files[0];

    const formData = new FormData();
    formData.append("editAccount", true);
    formData.append("bio", bio);
    formData.append("image", imageFile);

    $.ajax({
      url: "editAccount.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response)
        window.location.href = "index.php";
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("Error:", textStatus, errorThrown);
      }
    });
  });

  // ASSIGN THE OPENMODAL FUNCTION GLOBALLY TO BE USED IN ONCLICK ATTRIBUTE
  window.openModal = openModal;
});
