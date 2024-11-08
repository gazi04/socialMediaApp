$(document).ready(function() {
  function redirectToProfile(userid){
    const data = {"userid": userid};
    window.location.href = "../profile/index.php?"+$.param(data);
  }

  function openModalForCreatingPosts(){ 
    $("#createPost")[0].showModal();
  }

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

  $("#uploadImage").on("click", function(e) {
    e.preventDefault();
    $("#imageInput").click();
  });

  $("#imageInput").on("change", function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        $("#preview-image").attr("src", e.target.result);
      }
      reader.readAsDataURL(file);
      $(".upload-icon").css("display", "none");
      $("#submit-button").addClass("enable");
    }
  });

  // CLOSE MODAL IF USER CLICKS OUTSIDE THE MODAL
  $(window).on("click", function(e){
    if ($(e.target).is("#createPost")){
      $("#createPost")[0].close();
      $("#preview-image").attr("src", "");
      $("#caption").val("");
      $(".upload-icon").css("display", "block");
    }
  });

  // SETTING FUNCTIONS TO BE USED GLOBALLY
  window.redirectToProfile = redirectToProfile;
  window.openModalForCreatingPosts = openModalForCreatingPosts;
});
