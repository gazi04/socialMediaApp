$(document).ready(function() {
  const data = `
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <div>
              <span class="username">Test</span><br>
              <span style="font-size:small; color:gray;">helasdfjasl;dfjsalo</span>
            </div>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class='username'>Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class='username'>Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class='username'>Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class='username'>Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class='username'>Test</span>
          </div>
        `;

  // POPULATE CHAT ROOMS IF PAGE IS LOADED
  $.post("../../components/chatHandler.php",
    { getRooms: true },
    function(response){
      $("#rooms").html(response);
    }
  );

  $("#searchUser").on("input", function(){
    console.log($(this).val());
  });
});
