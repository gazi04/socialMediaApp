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
        if(response.isLiked){
          likeicon.prop("src", "../../assets/icons/redHeart.png");
        } else { 
          likeicon.prop("src", "../../assets/icons/heart.png");
        }

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

    $(".likebutton").attr("data-postid", postid);
    $("#postcommentbutton").attr("data-postid", postid)

    $("#modalprofileimage").empty();
    $(".profile-image").children("img").clone().appendto("#modalprofileimage");

    $('#modalimage').prop('src', imagesrc);
    $('#modalcaption').text(caption);
    $('#modalusername').text(username);

    $.post("../../components/getcomments.php",
      {
        getcomments: true,
        postid: postid
      },
      function(response) {
        $("#comments").html(response)
      }
    );

    $.post("../../components/likehandler.php", 
      {
        likestatus: true,
        postid: postid,
        userid: userid
      }, 
      function(response) {
        if(response.isliked){
          $("#likeicon").prop("src", "../../assets/icons/redheart.png");
        } else { $("#likeicon").prop("src", "../../assets/icons/heart.png"); }

        $("#likes").empty();
        $("#likes").text(response.likes);
      },
      "json"
    );

    // $('#modaluserprofile').html(`<img src="data:image/jped;base64, ${profilepicturesrc}"/> <b>${username}</b> ${caption}`);

    $('#postmodal')[0].showmodal();

    // optional: you can store postid if needed for future actions (e.g., liking the post)
    // $('#likebutton').data('post-id', postid);
  }

  function setPostsArray(posts){postsArray = posts;}

  // CLOSE POST MODAL IF CLICKED OUTSIDE THE MODAL
  $(window).on('click', function(e) {
    if ($(e.target).is('#postmodal')) {
      $('#postmodal')[0].close();
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

    $.post("../../components/getcomments.php",
      {
        getcomments: true,
        postid: $(this).data("postid")
      },
      function(response) {
        $("#comments").html(response)
      }
    );

    comment.val("");
  });

  // enable and disable the post button for comments in the post modal according if there is any input
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

  // enable and disable the submit button for the edit account page according if there is any input
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

  // everytime the user click the profile image it would actually click the button to change the image
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
  window.openmodal = openmodal;
  window.setPostsArray = setPostsArray;
});
