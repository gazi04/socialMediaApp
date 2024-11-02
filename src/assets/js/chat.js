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
            <span class="username">Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class="username">Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class="username">Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class="username">Test</span>
          </div>
          <div class="user">
            <img src="../../assets/images/sunflower.jpg"/>
            <span class="username">Test</span>
          </div>
        `;

  function fetchRooms(){
    $.post("../../components/chatHandler.php",
      { getRooms: true },
      function(response){ $("#rooms").html(response); }
    );
  }

  function sendMessage(){
    console.log($("#message-input #message").val());
    $("#message-input #message").val("");
  }

  // POPULATE CHAT ROOMS IF PAGE IS LOADED
  fetchRooms();

  $("#searchUser").on("input", function(){
    if($(this).val() === ""){ fetchRooms(); }
    else{
      $.post("../../components/chatHandler.php", 
        {
          searchRooms: true,
          term: $(this).val()
        },
        function(response){ $("#rooms").html(response); }
      );
    }
  });

  $("#rooms").on("click", ".room", function(){
    $.post("../../components/chatHandler.php", 
      { 
        openRoom: true,
        username: $(this).find(".username").text() 
      },
      function(response){ 
        $("#messages").html(response["messages"]);
        $("#message-input #message").attr("data-sendToUserId", response["sentToUserId"]);
      },
      "json"
    );
  });

    $("#message").on("keypress", function(event){
        if (event.which === 13){ sendMessage(); }
    });

    $("#message-input button").on("click", function(){
        sendMessage();
    });
});
