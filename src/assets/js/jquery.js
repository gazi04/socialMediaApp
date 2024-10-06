$(document).ready(function() {
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

  function openModal(postElement) {
    // Get data attributes from the clicked post
    const postId = $(postElement).data('post-id');
    const caption = $(postElement).data('caption');
    const likes = $(postElement).data('likes');
    const username = $(postElement).data('username');
    const imageSrc = $(postElement).data('image');
    const profilePictureSrc = $(postElement).data('profile-picture')

    $("#modalProfileImage").empty();
    $(".profile-image").children("img").clone().appendTo("#modalProfileImage");

    // Populate the modal with post data
    $('#modalImage').prop('src', imageSrc);
    $('#modalCaption').text(caption);
    $('#modalLikes').text(`Likes: ${likes}`);
    $('#modalUsername').text(username);


    // $('#modalUserProfile').html(`<img src="data:image/jped;base64, ${profilePictureSrc}"/> <b>${username}</b> ${caption}`);

    // Show the modal
    $('#postModal')[0].showModal();

    // Optional: you can store postId if needed for future actions (e.g., liking the post)
    // $('#likeButton').data('post-id', postId);
  }

  // Click handler for closing the modal
  $('#closeModal').on('click', function() {
    $('#postModal')[0].close();
  });

  // Close modal when clicking outside modal-content
  $(window).on('click', function(e) {
    if ($(e.target).is('#postModal')) {
      $('#postModal')[0].close();
    }
  });

  // Assign the openModal function globally to be used in onclick attribute
  window.openModal = openModal;

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
});
