$(document).ready(function() {
  scrollToBottom();
  fetchRooms();

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
    if($("#message-input #message").val() == ""){ return; }

    $.post("../../components/chatHandler.php",
      {
        sendMessage: true,
        message: $("#message-input #message").val(),
        toId: $("#message-input #message").attr("data-sendToUserId")
      },
      function(response){
        const sendedContainer = $("#messages > div").last().attr("class") == "sended";
        if(sendedContainer){
          $("#messages > div").last().append('<div class="message">'+response+'</div>');
        }
        else{
          $("#messages").last().append('<div class="sended"><div class="message">'+response+'</div></div>');
        }
        fetchRooms();
        console.log($("#messages > div").last().attr("class"));
      },
    )

    $("#message-input #message").val("");
  }

  function scrollToBottom() {
    const messagesContainer = $('#messages');
    messagesContainer.scrollTop(messagesContainer.prop("scrollHeight"));
  }


  // SEACHES THROUGH EXISTING CHAT ROOMS AND THROUGH NEW USERS TO CREATE NEW CHAT ROOMS
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

  // OPEN CHAT ROOM BASED ON WHICH ROOM THE USER CLICKED
  $("#rooms").on("click", ".room", function(){
    $.post("../../components/chatHandler.php", 
      { 
        openRoom: true,
        username: $(this).find(".username").text() 
      },
      function(response){ 
        $("#messages").html(response["messages"]);
        $("#message-input #message").attr("data-sendToUserId", response["sentToUserId"]);
        $("#message-input").css("display", "flex");
        $("#unread-message-indicator").hide();
        fetchRooms();
      },
      "json"
    );
  });

  // SEND MESSAGE IF ENTER KEY IS PRESSED
  $("#message").on("keypress", function(event){
    if (event.which === 13){ sendMessage(); }
  });

  // SEND MESSAGE BY CLICKING THE SEND BUTTON
  $("#message-input button").on("click", function(){
    sendMessage();
  });

  // FOCUS MESSAGE INPUT ON PRESSING TAB ON THE KEYBOARD
  $(document).on('keydown', function(e) {
    if (e.key === "Tab" || e.keyCode === 9) {
      e.preventDefault();
      $('#message').focus();
    }
  });
});
