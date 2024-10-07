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
    const profilePictureSrc = $(postElement).data('profile-picture')

    $("#modalProfileImage").empty();
    $(".profile-image").children("img").clone().appendTo("#modalProfileImage");

    $('#modalImage').prop('src', imageSrc);
    $('#modalCaption').text(caption);
    $('#modalUsername').text(username);

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
    )

    // $('#modalUserProfile').html(`<img src="data:image/jped;base64, ${profilePictureSrc}"/> <b>${username}</b> ${caption}`);

    $('#postModal')[0].showModal();

    // Optional: you can store postId if needed for future actions (e.g., liking the post)
    // $('#likeButton').data('post-id', postId);
  }

  $(window).on('click', function(e) {
    if ($(e.target).is('#postModal')) {
      $('#postModal')[0].close();
    }
  });

  // ENABLE AND DISABLE THE POST BUTTON FOR COMMENTS IN THE POST MODAL
  const $inputField = $("#inputField");
  const $postButton = $("#postButton");

  $inputField.on("input", function(){
    if($inputField.val().trim() !== ""){
      $postButton.prop("disabled", false);
      $postButton.addClass("enable");
    } else {
      $postButton.prop("disabled", true);
      $postButton.removeClass("enable");
    }
  });

  // assign the openmodal function globally to be used in onclick attribute
  window.openModal = openModal;
});
