$(document).ready(function() {
  let postsArray = [];
  let currentIndex = 0;

  // HIGHLIGHT ICONS IF MOUSE IS OVER THE NAVBAR BUTTONS
  $(".menuoption").hover(
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

  function openmodal(postelement) {
    const postid = $(postelement).data('post-id');
    const userid = $(postelement).data("user-id");
    const caption = $(postelement).data('caption');
    const username = $(postelement).data('username');
    const imagesrc = $(postelement).data('image');

    $(".like").attr("data-postid", postid);
    $(".like").attr("data-userid", userid);
    $("#postcommentbutton").attr("data-postid", postid)

    $("#modalProfileImage").empty();
    $(".profile-image").children("img").clone().appendTo("#modalProfileImage");

    $('#modalImage').prop('src', imagesrc);
    $('#modalCaption').text(caption);
    $('#modalUsername').text(username);

    fetchComments(postid);
    fetchLikes(postid, userid);

    $('#postModal')[0].showModal();
  }

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

  function setPostsArray(posts){postsArray = posts;}

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

  function fetchComments(postId) {
    $.post("../../components/getComments.php",
      {
        getComments: true,
        postId: postId
      },
      function(response) { $("#comments").html(response) }
    );
  }

  // CLOSE POST MODAL IF CLICKED OUTSIDE THE MODAL
  $(window).on('click', function(e) {
    if ($(e.target).is('#postModal')) {
      $('#postModal')[0].close();
    }
  });

  // STORES THE COMMENT IN THE DATABASE AND REFRESHES THE LISTS OF COMMENTS
  $("#postcommentbutton").on("click", function() {
    const comment = $(this).siblings(".input-container").children("#inputfield");

    $.post("../../components/postcomment.php",
      {
        postcomment: true,
        postid: $(this).data("postid"),
        comment: comment.val()
      }
    );

    fetchComments($(this).data("postid"));
    comment.val("");
  });

  // ENABLE AND DISABLE THE POST BUTTON FOR COMMENTS IN THE POST MODAL ACCORDING IF THERE IS ANY INPUT
  const $inputfield = $("#inputfield");
  const $postcommentbutton = $("#postcommentbutton");

  $inputfield.on("input", function(){
    if($inputfield.val().trim() !== ""){
      $postcommentbutton.prop("disabled", false);
      $postcommentbutton.addclass("enable");
    } else {
      $postcommentbutton.prop("disabled", true);
      $postcommentbutton.removeclass("enable");
    }
  });

  // ENABLE AND DISABLE THE SUBMIT BUTTON FOR THE EDIT ACCOUNT PAGE ACCORDING IF THERE IS ANY INPUT
  const $biotextarea = $("#bioinput");
  const $editprofilesubmit = $("#submitprofile");

  $biotextarea.on("input", function(){
    if($biotextarea.val().trim() !== ""){
      $editprofilesubmit.prop("disabled", false);
      $editprofilesubmit.addclass("enable");
    } else {
      $editprofilesubmit.prop("disabled", true);
      $editprofilesubmit.removeclass("enable");
    }
  })

  // EVERYTIME THE USER CLICK THE PROFILE IMAGE IT WOULD ACTUALLY CLICK THE BUTTON TO CHANGE THE IMAGE
  $(".current-user").children("img").on("click", function(){ 
    $("#changephotolink a").click();
  });

  $("#changephotolink").on("click", function(e) {
    e.preventdefault();
    $("#imageinput").click();
  });

  // change profile image to the image that the user uploads
  $("#imageinput").on("change", function() {
    const file = this.files[0];
    if (file) {
      const reader = new filereader();
      reader.onload = function(e) {
        $(".current-user").children("img").attr("src", e.target.result);
      }
      reader.readasdataurl(file);
      $editprofilesubmit.prop("disabled", false);
      $editprofilesubmit.addclass("enable");
    }
  });

  $("#submitprofile").on("click", function(e) {
    e.preventdefault();

    const bio = $("#bioinput").val();
    const imagefile = $("#imageinput")[0].files[0];

    const formdata = new formdata();
    formdata.append("editaccount", true);
    formdata.append("bio", bio);
    formdata.append("image", imagefile);

    $.ajax({
      url: "editaccount.php",
      type: "post",
      data: formdata,
      processdata: false,
      contenttype: false,
      success: function(response) {
        console.log(response)
        window.location.href = "index.php";
      },
      error: function(jqxhr, textstatus, errorthrown) {
        console.error("error:", textstatus, errorthrown);
      }
    });
  });

  // SETTING FUNCTIONS TO BE USED GLOBALLY
  window.openModal = openmodal;
  window.setPostsArray = setPostsArray;
});
