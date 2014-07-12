<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' />
        <style type="text/css">
            <!--
            .chat_wrapper {
                width: 500px;
                margin-right: auto;
                margin-left: auto;
                background: #CCCCCC;
                border: 1px solid #999999;
                padding: 10px;
                font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
            }
            .chat_wrapper .message_box {
                background: #FFFFFF;
                height: 150px;
                overflow: auto;
                padding: 10px;
                border: 1px solid #999999;
            }
            .chat_wrapper .panel input{
                padding: 2px 2px 2px 5px;
            }
            .system_msg{color: #BDBDBD;font-style: italic;}
            .user_name{font-weight:bold;}
            .user_message{color: #88B6E0;}
            -->
        </style>
    </head>
    <body>	

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                //create a new WebSocket object.
                var wsUri = "ws://127.0.0.1:10086";
                websocket = new WebSocket(wsUri);

                websocket.onopen = function(ev) { // connection is open 
                    $('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
                }

                $('#send-btn').click(function() { //use clicks message send button	
                    var mymessage = $('#message').val(); //get message text

                    if (mymessage == "") { //emtpy message?
                        alert("Enter Some message Please!");
                        return;
                    }

                    //prepare json data
                    var msg = {
                        message: mymessage
                    };
                    //convert and send data to server
                    websocket.send(JSON.stringify(msg));
                });

                //#### Message received from server?
                websocket.onmessage = function(ev) {
                    var msg = JSON.parse(ev.data); //PHP sends Json data

                    console.log(msg);

                    $('#message_box').append("<div><span class=\"user_message\">" + msg + "</span></div>");

                    $('#message').val(''); //reset text
                };

                websocket.onerror = function(ev) {
                    console.log(ev);
                    $('#message_box').append("<div class=\"system_error\">Error Occurred - " + ev.data + "</div>");
                };
                websocket.onclose = function(ev) {
                    console.log(ev);
                    $('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");
                };
            });
        </script>
        <div class="chat_wrapper">
            <div class="message_box" id="message_box"></div>
            <div class="panel">
                <input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
                <button id="send-btn">Send</button>
            </div>
        </div>

    </body>
</html>