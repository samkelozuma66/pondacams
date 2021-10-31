<?php
include 'config.php';
if(!isset($_SESSION['name'])){	
	echo "<script>window.location.href='../login.php'</script>";
}else{
	$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
	if($row[0]['user_type']==1 || $row[0]['registration_type']!='individual'){
		echo "<script>window.location.href='../login.php'</script>";
	}
	elseif($row[0]['status'] !='approved'){
	  echo "<script>window.location.href='../registerUpdate.php'</script>";
	}
}


$preference = $conn->getRow('preference',['model_id'=>$_SESSION['id']]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon1.png">
    <title>Pondacam | Home</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
        <link href="live.css" rel="stylesheet" id="bootstrap1">
		<link href="live.js" rel="stylesheet" id="bootstrap1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
		
	
	<script src="https://use.fontawesome.com/0f43fe6a33.js"></script>
  </head>
  <style>
  .grid-margin {
    margin-bottom: 15px;
  }.card .card-body {
    padding: 2.5rem 1.5rem;
}
.padr200 {padding-right: 206px;}
.bg-gradient-danger {
    background: linear-gradient(to right, #d1b700, #fac400) !important;
    background: linear-gradient(to right, #d1b700, #fac400) !important;
}
.card.card-img-holder .card-img-absolute {
    position: absolute;
    top: 106px;
    right: 0;
    height: 70%;
    bottom: 0px;
}
.card.card-img-holder .card-img-absolute1 {
    position: absolute;
    top: 65px;
    right: 0;
    height: 75%;
    bottom: 0px;
}
.bg-gradient-danger1 {
    background: linear-gradient(to right, #fb0101, #d20000) !important;
    background: linear-gradient(to right, #fb0101, #d20000) !important;
}
.table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
    border-top: none;
}
</style>

<body >
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="logo-compact1.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="favicon1.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile" >
				        
		        <a class="nav-link " id="profileDropdown" href="tipHistory.php" data-toggle="dropdown" aria-expanded="false">
					<div class="nav-profile-text">
						<p class="mb-1">
						    
						    <?php 
						        $usr = $conn->getRow('users',["id" => $_SESSION['id'] ]);
						    ?>
						    <i class="fa fa-database" aria-hidden="true"></i>
							 <?php if(isset($usr)){echo $usr[0]["money"]; }else{echo 0; }?> tk
						</p>
					</div>
				</a>
		    </li>
		    <li class="nav-item nav-profile dropdown" >
		        
		        <a class="nav-link " id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<div class="nav-profile-text">
						<p class="mb-1">
						    
						    <?php 
						        $favorites = $conn->getRow('favorites',["model" => $_SESSION['id'] ]);
						        $usr = $conn->getRow('users',["id" => $_SESSION['id'] ]);
						    ?>
						    <i class="fa fa-heart" aria-hidden="true"></i>
							 <?php if(isset($favorites)){echo count($favorites); }else{echo 0; }?>
						</p>
					</div>
				</a>
		    </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-text">
                  <p class="mb-1"><?php echo $_SESSION['name'] ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php">
                  <i class="mdi mdi-logout mr-2"></i> Signout </a>
              </div>
            </li>
         </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
             <li class="nav-item">
                <a class="nav-link" href="home.php">
                  <span class="menu-title">Home</span>
                  <i class="mdi mdi-home menu-icon"></i>
                </a>
             </li>
             <li class="nav-item active">
                <a class="nav-link" href="livesession.php">
                  <span class="menu-title">Live Session</span>
                  <i class="mdi mdi-chart-line menu-icon "></i>
                </a>
             </li>
			        <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span class="menu-title">Statistic</span>
                  <i class="mdi mdi-chart-line menu-icon "></i>
                </a>
              </li>
			      <li class="nav-item">
              <a class="nav-link" href="profile.php">
                <span class="menu-title">Personal Data</span>
                <i class="mdi mdi-settings menu-icon "></i>
              </a>
            </li>			
            <li class="nav-item">
              <a class="nav-link" href="tipHistory.php" > <span class="menu-title">Earnings</span>  <i class="mdi mdi-buffer menu-icon"></i> </a>
						
            </li>
            <li class="nav-item">
              	<a class="nav-link" href="security.php"> <span class="menu-title">Security & Privacy</span> <i class="mdi mdi-bullhorn menu-icon "></i> </a>
					
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#helpinfo" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Help & Info </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-information-outline menu-icon"></i>
              </a>
              <div class="collapse" id="helpinfo">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Contact</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Chat</a></li>
                </ul>
              </div>
            </li>          
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="page-header">
                <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Live </h3>
              </div>		
            <div class="row">
                <div class="col-md-4 col-xl-5 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<!--<video src="live.mp4" controls>
							
						</video>-->
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body" width="0%">
						<video id="video"  muted></video>
                        
					</div>
					<div class="card-footer"></div>
				</div></div>
				
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chats</span>
									<div id="audience">0 audience</div>
								</div>
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<!--<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>-->
						</div>
						<div class="card-body msg_card_body" id="msgView">
							
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea id="messageBox" name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
								    <a href="#" id="sendMessage">
								        
    									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
									
								    </a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p> 
				    <br/>
				    <input type="button" name="next" id="start" class="next btn btn-primary" value="Start Live Session" />
				    
				    <input type="button" name="next" id="stop" class="next btn btn-danger" value="Stop Live Session" hidden />
				    
				    <input type="text" name="idlocal" id="idlocal" class="next btn btn-primary"  />
				    <input type="hidden" name="sessionID" id="sessionID" class="next btn btn-primary"  />
				    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
                    <script type="text/javascript">
                        (function () {
            
                            var lastPeerId = null;
                            var peer = null; // Own peer object
                            var peerId = null;
                            var conn = null;
                            var caller = [];
                            var connections = [];
                            var userCount = 0;
                            var start = document.getElementById("start");
                            var stop  = document.getElementById("stop");
                            var sendMessage = document.getElementById("sendMessage");
                            var messageBox = document.getElementById("messageBox");
                            var msgView = document.getElementById("msgView");
                            
                            var audience = document.getElementById("audience");
                            
                            /*var recvId = document.getElementById("receiver-id");audience
                            var status = document.getElementById("stat");
                            var message = document.getElementById("message");
                            var standbyBox = document.getElementById("standby");
                            var goBox = document.getElementById("go");
                            var fadeBox = document.getElementById("fade");
                            var offBox = document.getElementById("off");
                            var sendMessageBox = document.getElementById("sendMessageBox");
                            var sendButton = document.getElementById("sendButton");
                            var clearMsgsButton = document.getElementById("clearMsgsButton");
                            var player = document.getElementById('player');*/
                            /**
                             * Create the Peer object for our end of the connection.
                             *
                             * Sets up callbacks that handle any events related to our
                             * peer object.
                             */
                            function closeSession()
                            {
                                
                                caller.forEach(function (cal, index)
                                {
                                    cal.close();
                                });
                                
                                connections.forEach(function (c, index)
                                {
                                    c.close();
                                });
                                connections = [];
                                conn        = null;
                                idlocal
                                var idlocal = document.getElementById("idlocal").value;
                                var sessionID = document.getElementById("sessionID");
                                var sid = sessionID.value;
                                
                                $.post('stopSession.php', 
                                    {   id:sid,
                                        session:idlocal
                                    }, 
                                    function(response)
                                    {
                                        if(start.hidden)
                                         {
                                            start.hidden    = false;
                                            stop.hidden     = true;
                                             
                                         }
                                         else
                                         {
                                            start.hidden    = true;
                                            stop.hidden     = false;
                                         }
                                    });
                            
                            }
                             function startSession()
                             {
                                 // Prefer camera resolution nearest to 1280x720.
                                var constraints = { audio: true, video: true };
                                
                                navigator.mediaDevices.getUserMedia(constraints)
                                .then(function(mediaStream) {
                                  var video = document.querySelector('video');
                                  video.srcObject = mediaStream;
                                  video.onloadedmetadata = function(e) {
                                    video.play();
                                  };
                                })
                                .catch(function(err) { console.log(err.name + ": " + err.message); }); // always check for errors at the end.
                                var idlocal = document.getElementById("idlocal").value;
                                var id = <?php echo $row[0]['id']; ?>;
                                 $.post('createSession.php', {model:id, stream:idlocal}, function(response){ 
                                     var sessionID = document.getElementById("sessionID");
                                     
                                     sessionID.value = response; 
                                     
                                     if(start.hidden)
                                     {
                                        start.hidden    = false;
                                        stop.hidden     = true;
                                         
                                     }
                                     else
                                     {
                                        start.hidden    = true;
                                        stop.hidden     = false;
                                     }
                                     
                                     //stop
                                     //changeBtn();
                                    });
                                 

                             }
                             function startPrivate(chatuser_id)
                             {
                                
                                var sessionID = document.getElementById("sessionID");
                                
                                /*connections.forEach(function (c, index)
                                {
                                    c.close();
                                });
                                connections = [];
                                conn        = null;*/
                                //var sessionID = document.getElementById("sessionID");
                                var sid = sessionID.value;
                                
                                $.post('updateSession.php', 
                                    {   id:sid,
                                        type:"private",
                                        chatuser_id:chatuser_id
                                    }, 
                                    function(response)
                                    {
                                    });
                             }
                             function stopPrivate()
                             {
                                
                                var sessionID = document.getElementById("sessionID");
                                var sid = sessionID.value;
                                
                                $.post('updateSession.php', 
                                    {   id:sid,
                                        type:"public",
                                        chatuser_id:"0"
                                    }, 
                                    function(response)
                                    {
                                    });
                             }
                             function startCount(chatuser_id,type)
                             {
                                 setInterval(function(){ 
                                        var tknPerMin = 0;
                                        if(type == "private")
                                        {
                                            tknPerMin = "<?php if(isset($preference[0])) { echo $preference[0]['private']; }else{ echo '50';} ?>";
                                        }
                                        else if(type == "spy")
                                        {
                                            tknPerMin = "<?php if(isset($preference[0])) { echo $preference[0]['spy']; }else{ echo '50';} ?>";
                                        }
                                        
                                        return fetch('//pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
                                          .then(response => {
                                            if (!response.ok) {
                                              throw new Error(response.statusText)
                                            }
                                            var res = response.json();
                                            var compl= true;
                                            
                                            res.then(data => {
                                              // do something with your data
                                               if(data.status == "failed")
                                               {
                                                    compl = false;
                                                    Swal.fire(data.message);
                                                    clearInterval(this);
                                               }
                                               
                                            });
                                            if(!compl)
                                            {
                                                throw new Error()
                                            }
                                            else
                                            {
                                                return res;
                                            }
                                           
                                          })
                                          .catch(error => {
                                            Swal.Fire(
                                              `Request failed: ${error.message}`
                                            );
                                            clearInterval(this);
                                          });
                                 }, 60000);
                             }
                function join(id) {
                    // Close old connection
                    var datacon = null;

                    // Create connection to destination peer specified in the input field
                    datacon = peer.connect(id, {
                        reliable: true
                    });

                    datacon.on('open', function () {
                        console.log("Connected to: " + datacon.peer);

                        
                    });
                    // Handle incoming data (messages only since this is the signal sender)
                    datacon.on('data', function(data) {
                        console.log(data);
                        if(data.name != "Notification" && data.name != "request")
                            {
                                addRecMessage(data.name,data.message);
                                if(connections != null)
                                {
                                     connections.forEach(function (con, index)
                                    {
                                        if(con.open && datacon.peer != con.peer)
                                        {
                                            con.send(data);
                                        }
                                    });
                                }
                            }else if(data.name == "request")
                            {
                                //Swal.fire(data.username);
                                
                                if(data.type =="spy")
                                {
                                    var tknPerMin = "<?php if(isset($preference[0])) { echo $preference[0]['spy']; }else{ echo '50';} ?>";
                                    fetch('//pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
                                          .then(response => {
                                            if (!response.ok) {
                                              throw new Error(response.statusText)
                                            }
                                            var res = response.json();
                                            var compl= true;
                                            
                                            res.then(data => {
                                              // do something with your data
                                               if(data.status == "failed")
                                               {
                                                    compl = false;
                                                    Swal.fire(data.message);
                                               }
                                               else
                                               {
                                                   console.log(data);
                                                    startCount(data.message.CHATUSER_ID, "spy");
                                                    //startPrivate(data.chatuser_id);
                                                    if(connections != null)
                                                    {
                                                         connections.forEach(function (con, index)
                                                        {
                                                            if(con.open )
                                                            {
                                                                con.send({name:"goSpy" , chatuser_id:data.message.CHATUSER_ID});
                                                            }
                                                            
                                                        });
                                                    }
                                               }
                                               
                                            });
                                            if(!compl)
                                            {
                                                throw new Error()
                                            }
                                            else
                                            {
                                                return res;
                                            }
                                           
                                          })
                                          .catch(error => {
                                            Swal.showValidationMessage(
                                              `Request failed: ${error.message}`
                                            )
                                          });
                                }
                                else if(data.type =="private")
                                {
                                    Swal.fire({
                                          title: 'Private Show Request by '+ data.username,
                                          showCancelButton: true,
                                          cancelButtonText: 'Cancel Show',
                                          confirmButtonText: 'Start Show',
                                          showLoaderOnConfirm: true,
                                          preConfirm: () => {
                                              //Swal.showValidationMessage("test ");
                                              var tknPerMin = "<?php if(isset($preference[0])) { echo $preference[0]['private']; }else{ echo '50';} ?>";
                                            return fetch('//pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
                                              .then(response => {
                                                if (!response.ok) {
                                                  throw new Error(response.statusText)
                                                }
                                                var res = response.json();
                                                var compl= true;
                                                
                                                res.then(data => {
                                                  // do something with your data
                                                   if(data.status == "failed")
                                                   {
                                                        compl = false;
                                                        Swal.showValidationMessage(data.message);
                                                   }
                                                   
                                                });
                                                if(!compl)
                                                {
                                                    throw new Error()
                                                }
                                                else
                                                {
                                                    return res;
                                                }
                                               
                                              })
                                              .catch(error => {
                                                Swal.showValidationMessage(
                                                  `Request failed: ${error.message}`
                                                )
                                              })
                                          },
                                          allowOutsideClick: () => !Swal.isLoading()
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                              //conn.send({name:"Notification" , message:"<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens "});
                                              
                                              //addNotification("<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens ");
                                                startCount(data.chatuser_id, "private");
                                                startPrivate(data.chatuser_id);
                                                if(connections != null)
                                                {
                                                     connections.forEach(function (con, index)
                                                    {
                                                        if(con.open )
                                                        {
                                                            con.send({name:"goPrivate" , chatuser_id:data.chatuser_id});
                                                        }
                                                        
                                                    });
                                                }
                                          }
                                          else
                                          {
                                              datacon.send({name:"Notification" , message:"Private show Declined"});
                                          }
                                        });
                                }
                            }
                            else
                            {
                                
                                
                                addNotification(data.message);
                            }
                    });
                    datacon.on('error', function(err) { console.log(err); });
                    
                    datacon.on('close', function () {
                        console.log("Disconnected to: ");
                        userCount = userCount - 1;
                        updateCount(userCount);
                        //addNotification(call.metadata.name + " joined the chat");
                    });
                    return datacon;
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
                                              //window.remoteAudio.srcObject = stream; // C
                                              //window.remoteAudio.autoplay = true; // D
                                              //window.peerStream = stream; //E
                                              //showConnectedContent(); //F    });
                                            })
                                        })
                                        .catch(function(err) {
                                          console.log("error: " + err);
                                        });
                                    }
                             function initialize() {
                                // Create own peer object with connection to shared PeerJS server
                                peer = new Peer(null, {
                                    debug: 2
                                });
            
                                peer.on('open', function (id) {
                                    var idlocal = document.getElementById("idlocal");
                                    // Workaround for peer.reconnect deleting previous id
                                    /*if (peer.id === null) {
                                        console.log('Received null id from peer open');
                                        peer.id = lastPeerId;
                                    } else {
                                        lastPeerId = peer.id;
                                    }*/
            
                                    console.log('ID: ' + peer.id);
                                    idlocal.value = peer.id;
                                    //recvId.innerHTML = "ID: " + peer.id;
                                    //status.innerHTML = "Awaiting connection...";
                                });
                                peer.on('connection', function (c) {
                                    
                                    // Allow only a single connection
                                    /*if (conn && conn.open) {
                                        c.on('open', function() {
                                            c.send("Already connected to another client");
                                            setTimeout(function() { c.close(); }, 500);
                                        });
                                        return;
                                    }*/
            
                                    conn = c;
                                    //callEm(conn.peer);
                                    console.log("Connected to: " + conn.peer);
                                    //status.innerHTML = "Connected";
                                    //ready();
                                });
                                peer.on('call', function(call) {
                                  // Answer the call, providing our mediaStream
                                  //alert("call");
                                  caller.push(call);
                                  var video = document.querySelector('video');
                                  var str = video.srcObject;
                                  var dataConn = join(call.peer);
                                  
                                  addNotification(call.metadata.name + " joined the chat");
                                if(connections != null)
                                {
                                     connections.forEach(function (con, index)
                                    {
                                        if(con.open)
                                        {
                                            var msg = call.metadata.name + " joined the chat";
                                            con.send({ name:"Notification", message:msg });
                                        }
                                    });
                                }
                               
                                
                                
                                
                                  userCount = userCount+ 1;
                                  updateCount(userCount);
                                  call.on('close', function() { 
                                      console.log("Call Ended");
                                      
                                  });
                                  conn = dataConn;
                                  connections.push(dataConn);
                                  call.answer(str);
                                  console.log(connections);
                                });
                                peer.on('disconnected', function () {
                                    //status.innerHTML = "Connection lost. Please reconnect";
                                    console.log('Connection lost. Please reconnect');
            
                                    // Workaround for peer.reconnect deleting previous id
                                    peer.id = lastPeerId;
                                    peer._lastServerId = lastPeerId;
                                    peer.reconnect();
                                });
                                peer.on('close', function() {
                                    conn = null;
                                    //status.innerHTML = "Connection destroyed. Please refresh";
                                    console.log('Connection destroyed');
                                });
                                peer.on('error', function (err) {
                                    console.log(err);
                                    alert('' + err);
                                });
                            };
                            function updateCount(c)
                            {
                                
                                audience.innerHTML = c + " audience";
                                
                            }
                            function addNotification(msg)
                            {
                                 msgView.innerHTML = msgView.innerHTML + "<div style='text-align:center;float :right;width: 100%;'>" + msg + "</div>";
                            }
                            function addSentMessage(msg)
                            {
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='d-flex justify-content-start mb-4' style='width:300px'><div class='msg_cotainer' style='max-width: 70%;min-width: 30%;'>" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									
                            }
                            function addRecMessage(name,msg)
                            {
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									
                            }
                            //closeSession()
                            stop.addEventListener('click', function (e) {
                                closeSession();
                            });
                            start.addEventListener('click', function (e) {
                                startSession();
                            });
                            sendMessage.addEventListener('click', function (e) {
                                //conn.send(messageBox.value);
                                connections.forEach(function (con, index)
                                {
                                    if(con.open)
                                    {
                                        con.send({name:"<?php echo $_SESSION['name'] ?>" , message:messageBox.value});
                                    }
                                });
                                addSentMessage(messageBox.value);
                                messageBox.value = "";
                            });
                            /**
                             * Triggered once a connection has been achieved.
                             * Defines callbacks to handle incoming data and connection events.
                             */
                            
            
                            // Listen for enter in message box
                           /* sendMessageBox.addEventListener('keypress', function (e) {
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
                                    conn.send(vid);
                                    console.log("Sent: " + msg)
                                    addMessage("<span class=\"selfMsg\">Self: </span>" + msg);
                                } else {
                                    console.log('Connection is closed');
                                }
                            });
            
                            // Clear messages box
                            clearMsgsButton.addEventListener('click', clearMessages);
                            */
                            initialize();
                        })();
                    </script>
				
				</p>
				
            </div>
          </div>
        </div>           
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 
          <a href="" target="_blank">Pondacam</a>. All rights reserved.</span>  
        </div>
      </footer>
          <!-- partial -->
    </div>
        <!-- main-panel ends -->
  </div>
      <!-- page-body-wrapper ends -->
  </div>
    <!-- container-scroller -->
<script src="assets/js/vendor.bundle.base.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/pondacam-main.js"></script>
    <!-- endinject -->
</body>
</html>