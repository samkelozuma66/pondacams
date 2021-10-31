<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link href="live.css" rel="stylesheet" id="bootstrap1">
		<link href="live.js" rel="stylesheet" id="bootstrap1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		
		<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
		<!--<script src="peerjs/dist/peerjs.min.js"></script>-->
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat</span>
									<div id="status" >1767 Messages</div>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<!--<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>-->
						</div>
						<div class="card-body msg_card_body">
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									Hi, how are you samim?
									<span class="msg_time">8:40 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Hi Khalid i am good tnx how about you?
									<span class="msg_time_send">8:55 AM, Today</span>
								</div>
								<div class="img_cont_msg">
										<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									I am good too, thank you for your chat template
									<span class="msg_time">9:00 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									You are welcome
									<span class="msg_time_send">9:05 AM, Today</span>
								</div>
								<div class="img_cont_msg">
										<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									I am looking for your next templates
									<span class="msg_time">9:07 AM, Today</span>
								</div>
							</div>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Ok, thank you have a good day
									<span class="msg_time_send">9:10 AM, Today</span>
								</div>
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
							</div>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									Bye, see you
									<span class="msg_time">9:12 AM, Today</span>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow" onclick="join()"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						
						
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<video id="videoStream" src="live.mp4" controls>
								
						</video>
						<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
						<script type="text/javascript">
						     //SEnder
						
						    var peer = null;  // own peer object
                            var conn = null;
						    /*conn = peer.connect(18, {
                                    reliable: true
                                });*/
                                
                            function initialize() {
                                // Create own peer object with connection to shared PeerJS server
                                var status = document.getElementById("status");
                                peer = new Peer(17, {
                                    debug: 2
                                });
            
                                peer.on('open', function (id) {
                                    // Workaround for peer.reconnect deleting previous id
                                    /*if (peer.id === null) {
                                        console.log('Received null id from peer open');
                                        peer.id = lastPeerId;
                                    } else {
                                        lastPeerId = peer.id;
                                    }*/
                                    console.log('ID: ' + id);
                                    status.innerHTML = 'ID: ' + id;
                                });
                                peer.on('connection', function (c) {
                                    // Disallow incoming connections
                                    c.on('open', function() {
                                        c.send("Sender does not accept incoming connections");
                                        setTimeout(function() { c.close(); }, 500);
                                    });
                                });
                                peer.on('disconnected', function () {
                                    status.innerHTML = "Connection lost. Please reconnect";
                                    console.log('Connection lost. Please reconnect');
            
                                    // Workaround for peer.reconnect deleting previous id
                                    peer.id = lastPeerId;
                                    peer._lastServerId = lastPeerId;
                                    peer.reconnect();
                                });
                                peer.on('close', function() {
                                    conn = null;
                                    status.innerHTML = "Connection destroyed. Please refresh";
                                    console.log('Connection destroyed');
                                });
                                peer.on('error', function (err) {
                                    console.log(err);
                                    alert('' + err);
                                });
                            };
                            function join() {
                                // Close old connection
                                if (conn) {
                                    conn.close();
                                }
            
                                // Create connection to destination peer specified in the input field
                                conn = peer.connect(20, {
                                    reliable: true
                                });
            
                                conn.on('open', function () {
                                    status.innerHTML = "Connected to: " + conn.peer;
                                    console.log("Connected to: " + conn.peer);
                                    alert();
                                    // Check URL params for comamnds that should be sent immediately
                                    var command = getUrlParam("command");
                                    if (command)
                                        conn.send(command);
                                });
                                // Handle incoming data (messages only since this is the signal sender)
                                conn.on('data', function (data) {
                                    alert(data);
                                    
                                });
                                conn.on('close', function () {
                                    status.innerHTML = "Connection closed";
                                });
                            };
                            
                            initialize();
						    //join();
						</script>
					</div>
				</div>
				<table class="control">
                    <tr>
                        <td class="title">Status:</td>
                        <td class="title">Messages:</td>
                    </tr>
                    <tr>
                        <td>
                            <span style="font-weight: bold">ID: </span>
                            <input type="text" id="receiver-id" title="Input the ID from receive.html">
                            <button id="connect-button">Connect</button>
                        </td>
                        <td>
                            <input type="text" id="sendMessageBox" placeholder="Enter a message..." autofocus="true" />
                            <button type="button" id="callButton">call</button>
                            <button type="button" id="sendButton">Send</button>
                            <button type="button" id="clearMsgsButton">Clear Msgs (Local)</button>
                        </td>
                    </tr>
                    <tr>
                        <td><div id="status" class="status"></div></td>
                        <td><div class="message" id="message"></div></td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="control-button" id="resetButton">Reset</button>
                        </td>
                        <td>
                            <button type="button" class="control-button" id="goButton">Go</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="control-button" id="fadeButton">Fade</button>
                        </td>
                        <td>
                            <button type="button" class="control-button" id="offButton">Off</button>
                        </td>
                    </tr>
                </table>
        
                <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
                <script type="text/javascript">
                    (function () {
        
                        var lastPeerId = null;
                        var peer = null; // own peer object
                        var conn = null;
                        var recvIdInput = document.getElementById("receiver-id");
                        var status = document.getElementById("status");
                        var message = document.getElementById("message");
                        var goButton = document.getElementById("goButton");
                        var resetButton = document.getElementById("resetButton");
                        var fadeButton = document.getElementById("fadeButton");
                        var offButton = document.getElementById("offButton");
                        var sendMessageBox = document.getElementById("sendMessageBox");
                        var sendButton = document.getElementById("sendButton");
                        var callButton = document.getElementById("callButton");
                        var clearMsgsButton = document.getElementById("clearMsgsButton");
                        var connectButton = document.getElementById("connect-button");
                        var cueString = "<span class=\"cueMsg\">Cue: </span>";
        
                        /**callButton
                         * Create the Peer object for our end of the connection.
                         *
                         * Sets up callbacks that handle any events related to our
                         * peer object.
                         */
                        function initialize() {
                            // Create own peer object with connection to shared PeerJS server
                            peer = new Peer(null, {
                                debug: 2
                            });
        
                            peer.on('open', function (id) {
                                // Workaround for peer.reconnect deleting previous id
                                if (peer.id === null) {
                                    console.log('Received null id from peer open');
                                    peer.id = lastPeerId;
                                } else {
                                    lastPeerId = peer.id;
                                }
        
                                console.log('ID: ' + peer.id);
                            });
                            peer.on('connection', function (c) {
                                // Disallow incoming connections
                                c.on('open', function() {
                                    c.send("Sender does not accept incoming connections");
                                    setTimeout(function() { c.close(); }, 500);
                                });
                            });
                            peer.on('disconnected', function () {
                                status.innerHTML = "Connection lost. Please reconnect";
                                console.log('Connection lost. Please reconnect');
        
                                // Workaround for peer.reconnect deleting previous id
                                peer.id = lastPeerId;
                                peer._lastServerId = lastPeerId;
                                peer.reconnect();
                            });
                            peer.on('call', function(call) {
                              // Answer the call, providing our mediaStream
                              
                                alert("in call");
                              //call.answer(mediaStream);
                            });
                            peer.on('close', function() {
                                conn = null;
                                status.innerHTML = "Connection destroyed. Please refresh";
                                console.log('Connection destroyed');
                            });
                            peer.on('error', function (err) {
                                console.log(err);
                                alert('' + err);
                            });
                        };
        
                        function callEm(id){
                            /*var streamlocal;
                            call = peer.call(id, streamlocal);
                            call.on('stream', function(stream) { // B
                              //window.remoteAudio.srcObject = stream; // C
                              //window.remoteAudio.autoplay = true; // D
                              //window.peerStream = stream; //E
                              //showConnectedContent(); //F    });
                            });*/
                          navigator.mediaDevices.getUserMedia({video: true, audio: false})
                          .then(function(stream) {
                                call = peer.call(id, stream);
                                call.on('stream', function(stream) { // B
                                  videoStream = document.getElementById("status");
                                  alert(stream)
                                  videoStream.srcObject = stream; // C
                                  videoStream.autoplay = true; // D
                                  videoStream.play();
                                  //window.peerStream = stream; //E
                                  //showConnectedContent(); //F    });
                                })
                            })
                            .catch(function(err) {
                              console.log("error: " + err);
                            });
                        }
                        /**
                         * Create the connection between the two Peers.
                         *
                         * Sets up callbacks that handle any events related to the
                         * connection and data received on it.
                         */
                        function join() {
                            // Close old connection
                            if (conn) {
                                conn.close();
                            }
        
                            // Create connection to destination peer specified in the input field
                            conn = peer.connect(recvIdInput.value, {
                                reliable: true
                            });
        
                            conn.on('open', function () {
                                status.innerHTML = "Connected to: " + conn.peer;
                                console.log("Connected to: " + conn.peer);
        
                                // Check URL params for comamnds that should be sent immediately
                                var command = getUrlParam("command");
                                if (command)
                                    conn.send(command);
                            });
                            // Handle incoming data (messages only since this is the signal sender)
                            conn.on('data', function (data) {
                                addMessage("<span class=\"peerMsg\">Peer:</span> " + data);
                            });
                            conn.on('close', function () {
                                status.innerHTML = "Connection closed";
                            });
                        };
        
                        /**
                         * Get first "GET style" parameter from href.
                         * This enables delivering an initial command upon page load.
                         *
                         * Would have been easier to use location.hash.
                         */
                        function getUrlParam(name) {
                            name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                            var regexS = "[\\?&]" + name + "=([^&#]*)";
                            var regex = new RegExp(regexS);
                            var results = regex.exec(window.location.href);
                            if (results == null)
                                return null;
                            else
                                return results[1];
                        };
        
                        /**
                         * Send a signal via the peer connection and add it to the log.
                         * This will only occur if the connection is still alive.
                         */
                         function signal(sigName) {
                            if (conn && conn.open) {
                                conn.send(sigName);
                                console.log(sigName + " signal sent");
                                addMessage(cueString + sigName);
                            } else {
                                console.log('Connection is closed');
                            }
                        }
        
                        goButton.addEventListener('click', function () {
                            signal("Go");
                        });
                        resetButton.addEventListener('click', function () {
                            signal("Reset");
                        });
                        fadeButton.addEventListener('click', function () {
                            signal("Fade");
                        });
                        offButton.addEventListener('click', function () {
                            signal("Off");
                        });
        
                        function addMessage(msg) {
                            var now = new Date();
                            var h = now.getHours();
                            var m = addZero(now.getMinutes());
                            var s = addZero(now.getSeconds());
        
                            if (h > 12)
                                h -= 12;
                            else if (h === 0)
                                h = 12;
        
                            function addZero(t) {
                                if (t < 10)
                                    t = "0" + t;
                                return t;
                            };
        
                            message.innerHTML = "<br><span class=\"msg-time\">" + h + ":" + m + ":" + s + "</span>  -  " + msg + message.innerHTML;
                        };
        
                        function clearMessages() {
                            message.innerHTML = "";
                            addMessage("Msgs cleared");
                        };
        
                        // Listen for enter in message box
                        sendMessageBox.addEventListener('keypress', function (e) {
                            var event = e || window.event;
                            var char = event.which || event.keyCode;
                            if (char == '13')
                                sendButton.click();
                        });
                        // Send message
                        sendButton.addEventListener('click', function () {
                            if (conn && conn.open) {
                                var msg = sendMessageBox.value;
                                sendMessageBox.value = "";
                                conn.send(msg);
                                console.log("Sent: " + msg);
                                addMessage("<span class=\"selfMsg\">Self: </span> " + msg);
                            } else {
                                console.log('Connection is closed');
                            }
                        });
                        
                        callButton.addEventListener('click', function () {
                            alert("calling 3d629738-dbdf-4804-bd67-8ca4c260dae1");
                            callEm("3d629738-dbdf-4804-bd67-8ca4c260dae1");
                        });
        
                        // Clear messages box
                        clearMsgsButton.addEventListener('click', clearMessages);
                        // Start peer connection on click
                        connectButton.addEventListener('click', join);
        
                        // Since all our callbacks are setup, start the process of obtaining an ID
                        initialize();
                    })();
                </script>
			</div>
		</div>
	</body>
</html>
