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

  // NAVBAR OPTION FOR THE LOGGED USER TO LOOK AT HIS PROFILE
  $("#userProfile").on("click", function(){
    const data = {"loggedUser": true};
    window.location.href = "../profile/index.php?"+$.param(data);
  });

  // ADDS ANIMATION TO THE SEARCH BAR IF OPEN IT
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

  $("#searchingTerm").on("input", function(){
    $.post("../../components/getUsers.php",
      {
        searchUser: true,
        term: $(this).val()
      },
      function(response){ $("#users-list").html(response); }
    );
  });
});
