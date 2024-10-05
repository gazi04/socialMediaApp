$(document).ready(function() {
  // Function to open modal and populate with post data
  function openModal() {
    // Get data attributes from the clicked post
    // const postId = $(postElement).data('post-id');
    // const caption = $(postElement).data('caption');
    // const likes = $(postElement).data('likes');
    // const username = $(postElement).data('username');
    // const imageSrc = $(postElement).data('image');

    // Populate the modal with post data
    // $('#modalImage').attr('src', imageSrc);
    // $('#modalCaption').text(caption);
    // $('#modalLikes').text(`Likes: ${likes}`);
    // $('#modalUsername').text(username);

    // Show the modal
    $('#postModal')[0].showModal();
    console.log($('#postModal')[0])

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
      console.log($('#postModal')[0])
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
      console.log("there is something in the post input");
    } else {
      $postButton.prop("disabled", true);
      console.log("nothing in the post input");
      $postButton.removeClass("enable");
    }
  });
});
