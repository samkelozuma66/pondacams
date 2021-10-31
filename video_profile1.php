<?php 
include 'config.php';
if(isset($_GET['id'])){
$model = $conn->getRow('users',['id'=>$_GET['id']]);
$rule = $conn->getRow('rule',['rule_type'=>'message']);
$session = $conn->getRow('session',['model'=>$_GET['id']]);
$pic = $conn->getRow('modelpictures',['model_id'=>$_GET['id']]);
$modelinfo = $conn->getRow('modelinfo',['model_id'=>$_GET['id']]);
$favorites = $conn->getRow('favorites',['member'=>$_SESSION['id'],"model" => $_GET['id']]);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Live cam show</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> 
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/metisMenu.min.css" rel="stylesheet">	
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
	
	<!-- chat-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script>
          $(function(){
            $("#addClass").click(function () {
                      $('#qnimate').addClass('popup-box-on');
                        });
                      
                        $("#removeClass").click(function () {
                      $('#qnimate').removeClass('popup-box-on');
                        });
              })
    </script>
	
</head>
<style>
	.content-body {
	margin-left: 0px;
	z-index: 0;
	background: rgba(218,0,0,.8);
	background: linear-gradient(180deg,#da0000,#a60000);
	}
	.header {
	margin-left: 0px;
	}
	[data-sidebar-style="full"] .header, [data-sidebar-style="overlay"] .header {
	width: calc(100% - 0rem);
	}
	@media only screen and (max-width: 767px){
	[data-sidebar-style="full"] .header, [data-sidebar-style="overlay"] .header {
	width: calc(100% - 0rem);
	margin-left: 0rem;
	}
}
</style>
<body oncontextmenu="return false;">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->        
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">               
                <div class="brand-logo" style="width:50%">
					<a href="index.php">
						<span class="logo-compact"><img src="./images/logo-compact2.png" alt="" style="width:35%;"></span>
					</a>
				</div>          
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dn"><a href="javascript:void(0)">Live Cams</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Mobile Live</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Promotions
						  <span class="badge badge-pill gradient-1">2</span></a>
						</li>
						<li class="icons dn"><a href="javascript:void(0)">Story</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Award</a></li>						
						<li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
							<i class="fa fa-envelope gradient-4-text"></i>
							<span class="badge badge-pill gradient-1">3</span></a>
                        </li>
                        <li class="icons dropdown dn"><a href="javascript:void(0)" data-toggle="dropdown">
							<i class="fa fa-heart gradient-3-text"></i>
							<span class="badge badge-pill gradient-2">3</span></a>
                        </li>
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown" style="position: relative; top: 0px;">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>						
						<?php if(isset($_SESSION['name'])){ ?>
							<li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown" style="position: relative; top: 0px;">
                                <span><?= $_SESSION['name']; ?></span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="chatlogout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
						<?php }else{ ?>
						<li class="icons dn"><a href="javascript:void(0)" data-toggle="modal" data-target="#login">
						  <b>Login<b></a></li>
						<li class="icons dn"><a href="javascript:void(0)" class="joinbtn" data-toggle="modal" data-target="#joinnow">joinnow</a></li>
						<?php
						}
						
						?>
						<li class="icons ds-m-dnd">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#searchmobile">
							<b><i class="fas fa-search"></i><b></a>
					    </li>						
						<!-- after lgin profile img div for developer -->
                        <!--<li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/avatar-media.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
										<li>
										  <a href=""><i class="icon-settings"></i> <span>Setting</span></a>
										</li>  
                                        <hr class="my-2">
									   
                                        <li><a href="#"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">	              
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
					    
						<div class="videoWrapper" width="600">
							<!-- Copy & Pasted from YouTube -->
							
							<?php if(isset($session[0]['stream'])){ ?>
							<!--<video
                                id="my-video"
                                class="video-js"
                                width="100%" 
                                height="600" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                preload="auto"
                                width="300%"
                                height="600"
                                poster="MY_VIDEO_POSTER.jpg"
                                data-setup="{}"
                              >
                                <p class="vjs-no-js">
                                  To view this video please enable JavaScript, and consider upgrading to a
                                  web browser that
                                  <a href="https://videojs.com/html5-video-support/" target="_blank"
                                    >supports HTML5 video</a
                                  >
                                </p>
                            </video>

                            <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>-->
							<video width="100%" height="auto" src="https://www.youtube.com/embed/Edk0TfK94pA" title="Stream" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen controls style="max-height : 600;">
							    <div> HELLO  VIDEO</div>
							</video>
							<!--
                                #check:checked~.chat-btn i {
                                    display: block;
                                    pointer-events: auto;
                                    transform: rotate(180deg)
                                }
                                
                                #check:checked~.chat-btn .comment {
                                    display: none
                                }-->
							<style>
							    .chat-btn {
                                    position: absolute;
                                    right: 14px;
                                    bottom: 30px;
                                    cursor: pointer
                                }
                                
                                .chat-btn .close {
                                    display: none
                                }
                                
                                .chat-btn i {
                                    transition: all 0.9s ease
                                }
                                
                                .chat-btn i {
                                    font-size: 22px;
                                    color: #fff !important
                                }
                                
                                .chat-btn {
                                    width: 50px;
                                    height: 50px;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    border-radius: 50px;
                                    background-color: RED;
                                    color: #fff;
                                    font-size: 22px;
                                    border: none
                                }

							</style>
							<input type="checkbox" id="check" hidden> 
                            <label class="chat-btn" for="check" id="addClass"> 
                                <i class="fa fa-commenting-o comment"></i> 
                                <i class="fa fa-close close"></i> 
                            </label>
                            
							<!-- user chat
							<div class="card-profile card-rofile text-center"  style="float: right; width: 30%;height : 600px;">
							    <div class="round hollow text-center">
                                <a href="#" id="addClass"><span class="glyphicon glyphicon-comment"></span> Open in chat </a>
                                </div>
							</div>-->
							<?php } else { ?>
							<iframe width="100%" height="auto" src="<?php if(isset($model) && $model[0]['model_video'] != ''){ echo 'model_video/'.$model[0]['model_video'];}else{ echo "https://www.youtube.com/embed/5qky3L2Q6G4";} ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php }?>
						</div>
					</div>
					<div class="col-sm-1"></div>				  
				</div>				
				<div class="mfullwidth">
					<div class="story-postbox story-postboxv">
						<div class="row">
							<div class="col-sm-1"></div>							
							<div class="col-sm-10">
								<div class="card bg-imgprofile">
									<div class="card-body row">
										<div class="col-12 col-sm-8 media align-items-center mb-4">
											<img class="mr-3 userprofile-pic" src="./documents/<?php if(isset($model)){echo $model[0]['selfie'];}?>" width="100" height="100" alt="">
											<div class="media-body">
											    <script type="text/javascript">
												    function addFavorite()
												    {
												        var fav = document.getElementById("fav");
												        console.log(fav.className);
												        fav.className = ("fa fa-heart gradient-4-text");
												        var xhttp = new XMLHttpRequest();
                                        				xhttp.onreadystatechange = function ()
                                        				{
                                        					if (this.readyState == 4 && this.status == 200)
                                        					{
                                        						
                                        						//alert(response);
                                        						//console.log(response);
                                        						//var row = JSON.parse(response);
                                        					   // console.log(row[0]);
                                        					   // console.log(row[0]);
                                        					}
                                        				};
                                        				xhttp.open("POST", "addFavorites.php", true);
                                        				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                        				xhttp.send("chatuserid="+<?php echo $_SESSION['id']; ?>+"&modelId=" + <?php echo $model[0]["id"] ;?>);
												    }
												</script>
												<h3 class="mb-0 whitecolor"><?php if(isset($model)){ echo $model[0]['name'];} ?>&nbsp;&nbsp;<a href="#" onclick="addFavorite()"><i id="fav" class=" <?php if(isset($favorites[0])){echo 'fa fa-heart gradient-4-text'; }else{echo 'far fa-heart gradient-4-text'; }?>"></i></a></h3>
												<p class="mb-0 whitecolor">ONLY AVAILABLE ON PONDACAM</p>
												<p><?php echo $session[0]['stream']; ?></p>
												<p class="mb-0 whitecolor">54 
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star"></i>
												</p>
												
											</div>
										</div>										<?php if(isset($session[0]['stream'])){ ?>	
									    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
									    
                						<script type="text/javascript">
                						     //SEnder
                						
                						    var peer = null;  // own peer object
                                            var conn = null;
                                            var callName = "";
                						    /*conn = peer.connect(18, { sendMessage
                                                    reliable: true
                                                });*/
                                                
                            function callEm(){
                            var id = "<?php echo $session[0]['stream']; ?>";
                            
                           navigator.mediaDevices.getUserMedia({video: true, audio: false})
                          .then(function(stream) {
                              
                              alert("Connectiong to <?php if(isset($model)){ echo $model[0]['name'];} ?>" );
                              
                              <?php if(isset($_SESSION['name'])){ ?>
                              var name = '<?php echo $_SESSION['name']; ?>' ;
                              <?php }else{ ?>
                              var name = "guest" + Math.round(Math.random() * 10000); 
                              <?php } ?>
                                var option = {
                                    name : name
                                };
                                callName = name;
                                call = peer.call(id, stream,{metadata:option});
                                call.on('stream', function(stream) { // B
                                
                                    var video = document.querySelector('video');
                                    video.srcObject = stream; // C
                                    video.autoplay = true; // D
                                    video.volume = 1;
                                    video.play();
                                    console.log(peer.connections);
                                  /*videoStream = document.getElementById("status");
                                  alert(stream)
                                  videoStream.srcObject = stream; // C
                                  videoStream.autoplay = true; // D
                                  videoStream.play();*/
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
                                                //var status = document.getElementById("status");
                                                peer = new Peer(null, {
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
                                                    
                                                    conn = c;
                                                    conn.send("data");
                                                    alert("connection created!");
                                                                                conn.on('data', function (data) {
                                                                                    console.log("Data recieved");
                                                             
                            if(data.name != "Notification")
                            {
                                addRecMessage(data.name,data.message);
                                
                            }
                            else
                            {
                                addNotification(data.message);
                            }
                                                    //addRecMessage(data);
                                                });
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

                            function updateCount(c)
                            {
                                
                                //audience.innerHTML = c + " audience";
                                
                            }
                            function addNotification(msg)
                            {
                                
                                 msgView.innerHTML = msgView.innerHTML + "<div class='chat-box-single-line'><abbr class='timestamp'>" + msg + "</abbr></div>";
                            }
                            function addSentMessage(name,msg)
                            {
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='direct-chat-msg doted-border' style='border: none;'> <div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-left'>" + name + "</span></div>                <div class='direct-chat-text' style='max-width: 100%;'>" + msg + "</div><div class='direct-chat-info clearfix'><span class='direct-chat-timestamp pull-right'>3.36 PM</span></div></div>";
									
                            }
                            function addRecMessage(name,msg)
                            {
            
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='direct-chat-msg doted-border' style='border: none;'> <div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-right'>" + name + "</span></div>                <div class='direct-chat-text' style='max-width: 100%;'>" + msg + "</div><div class='direct-chat-info clearfix'><span class='direct-chat-timestamp pull-right'>3.36 PM</span></div></div>";
									
                            }
                            function sendToken()
                            {
                                var sessionName ="<?php echo $_SESSION['name'] ?>";
                                if(sessionName == "")
                                {
                                    Swal.fire('Login To send TKKENS');
                                }
                                else
                                {
                                  
                                    //Swal.fire('Any fool can use a computer')
                                    Swal.fire({
                                      title: 'Send How may &#36; TOKENS ',
                                      input: 'text',
                                      inputAttributes: {
                                        autocapitalize: 'off'
                                      },
                                      showCancelButton: true,
                                      confirmButtonText: 'Send',
                                      showLoaderOnConfirm: true,
                                      preConfirm: (login) => {
                                        return fetch(`//pondacams.com/sendTokkens.php?tokkens=${login}&id=<?php echo $_SESSION['id'] ?>&model_id=<?php echo $model[0]["id"] ;?>`)
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
                                          conn.send({name:"Notification" , message:"<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens "});
                                          
                                          addNotification("<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens ");
                                          
                                      }
                                    });
                                  
                                }
                            }
                            //sendMessage
                            function sendMsg()
                            {
                                var sessionName ="<?php echo $_SESSION['name'] ?>";
                                //status_message
                                    var messageBox = document.getElementById("status_message");
                                if(sessionName == "")
                                {
                                    Swal.fire('Login to send message');
                                }
                                else
                                {
                                    
                                    if(messageBox.value.includes("FACEBOOK") || messageBox.value.includes("facebook"))
                                    {
                                        Swal.fire('Social media Reference block');
                                    }
                                    else
                                    {
                                         
                                        var rule = "<?php if(isset($rule)){echo $rule[0]["rule"]; }?>";
                                        var msg = messageBox.value;
                                        var proceed = true;
                                        
                                        if(rule != "")
                                        {
                                            var split = rule.split(',');
                                            split.forEach(function(item)
                                            {
                                                //||msg.indexOf(item)
                                                if(msg.toUpperCase().includes(item))
                                                {
                                                    proceed = false;
                                                }
                                                
                                            });
                                            
                                        }
                                        
                                        if(proceed)
                                        {
                                            //"<?php echo $_SESSION['name'] ?>"
                                            conn.send({name:callName , message:messageBox.value});
                                            
                                            addSentMessage("<?php echo $_SESSION['name'] ?>",messageBox.value);
                                        }
                                        else
                                        {
                                            Swal.fire('Contact Reference block');
                                        }
                                    }
                                    
                                }
                                
                                messageBox.value = "";
                            }

                                            initialize();
                                            callEm();
                						    //join();
                						</script>
                						<?php } ?>
										<div class="col-12 col-sm-4 mb-3">
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($modelinfo)){echo $modelinfo[0]['age'];} ?></h3>
												<p class="whitecolor px-4">Age</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($modelinfo)){echo $modelinfo[0]['bSize'];} ?></h3>
												<p class="whitecolor">Breast size</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0">Female</h3>
												<p class="whitecolor">Gender</p>
											</div>
											<div class="card-profile card-rofile text-center">
											    <a href="./live1/liveChatUser.php" target="_blank">
												<h3 class="whitecolor mb-0">Join Chat</h3>
												<p class="whitecolor">Live session</p>
												</a>
											</div>
										</div>
										<p class="redcolor">To give the main points, I am a talking, positive, childish and sociable person and I am looking through to find person exactly like me with positive vibe who know how it is to give and to be given, after all I am a giver!</p>												
									</div>
								</div>  
							</div>							
							<div class="col-sm-1"></div>
						</div>
					</div>				
					<div class="row">
						<div class="col-sm-1"></div>				
							<div class="col-sm-10">	
								<div class="card-columns">	
								    <script>
								        function unlockImg(imgId,amount)
								        {
								            fetch('//pondacams.com/sendTokkens.php?tokkens='+ amount +'&id=<?php echo $_SESSION['id'] ?>&model_id=<?php echo $model[0]["id"] ;?>')
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
                                                   //addImgAccess.php
                                                   /*
                                                    "chatuser_id"
                                                    "img_id"
                                                    "from_date"
                                                    "to_date"
                                                   */
                                                   fetch('//pondacams.com/addImgAccess.php?chatuser_id=<?php echo $_SESSION['id'] ?>&img_id=' + imgId)
                                                   .then(response =>{
                                                       if (!response.ok) {
                                                          throw new Error(response.statusText)
                                                        }
                                                        var resp = response.json();
                                                        resp.then(data => {
                                                            console.log(data);
                                                            
                                                            if(data.status == "done")
                                                            {
                                                                Swal.fire(data.msg).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        location.reload();
                                                                    }
                                                                });
                                                                
                                                            }
                                                        });
                                               
                                                   })
                                                   .catch(error => {
                                                       
                                                   });
                                               }
                                               
                                            });
                                            
                                            if(!compl)
                                            {
                                                throw new Error()
                                            }
                                            else
                                            {
                                                //return res;
                                            }
                                           
                                          })
                                          .catch(error => {
                                            Swal.fire(
                                              `Request failed: ${error.message}`
                                            )
                                          });
								        }
								    </script>
									<?php   
									
									foreach($pic as $img){
										if($img['is_locked']=='lock'){
										    $imgAccess = $conn ->getRow("modelpicture_access",["chatuser_id" => $_SESSION["id"],"img_id" => $img['id']]);
										    
										    if (isset($imgAccess[0]))
										    {
										        $fromdate = $imgAccess[0]["from_date"];
										        $todate   = $imgAccess[0]["to_date"];
										        $today    = date("Y-m-d");
										        if($today >= $fromdate && $today <= $todate)
										        {
										    
										?>
										    <div class="card card-pin">
												<img class="card-img"  src="model-images/<?php echo $img['image_name'] ; ?>" alt="Card image">
											</div>
										    <?php }
										}else{
											?>
											<div class="card card-pin">
												<div class="locked">
													<i class="fa fa-lock" style="font-size: 50px;color: #fff; position: absolute;top: 50%;left: 50%;margin-left: -25px;width: 50px;height: 50px; margin-top: -25px;"></i>
												</div>
												<img class="card-img"  src="model-images/<?php echo $img['image_name'] ; ?>"  alt="Card image">
												<div class="overlay">
												    
													<h3 class="card-title title">5 Tokens for 90 days</h3>             
													<div class="more"><a href="#!" onclick="unlockImg(<?php echo $img['id'] ; ?>,5)">Unlock my album</a>
													</div>                
												</div>
											</div> 
											<?php }
										}else{
											?>
											<div class="card card-pin">
												<img class="card-img"  src="model-images/<?php echo $img['image_name'] ; ?>" alt="Card image">
											</div>
											<?php
										}													
									}												
									?>
																			 
									<!-- <div class="card card-pin">
										<img class="card-img"  src="images/livecam-5.jpg" alt="Card image">
									</div> 
										-->
									<!-- <div class="card card-pin">
										<img class="card-img"  src="images/livecam-3.jpg" alt="Card image">
									</div> 
									<div class="card card-pin">
										<img class="card-img"  src="images/livecam-4.jpg" alt="Card image">
									</div> 
									<div class="card card-pin">
										<img class="card-img"  src="images/photo8.jpg" alt="Card image">
									</div>
									<div class="card card-pin">
										<div class="locked">
											<i class="fa fa-lock" style="font-size: 50px;color: #fff; position: absolute;top: 50%;left: 50%;margin-left: -25px;width: 50px;height: 50px; margin-top: -25px;"></i>
										</div>
										<img class="card-img"  src="images/photo11.jpg" alt="Card image">
										<div class="overlay">
											<h3 class="card-title title">5 Credit for 90 days</h3>             
											<div class="more"><a href="#!">Unlock my album</a>
											</div>                
										</div>
									</div> 
									<div class="card card-pin">
										<img class="card-img"  src="images/livecam-7.jpg" alt="Card image">
									</div>
									<div class="card card-pin">
										<img class="card-img"  src="images/livecam-8.jpg" alt="Card image">
									</div> -->					  
								</div> 
							<div class="col-sm-1"></div>		
						</div>   
					</div>
				</div>
			</div>   <!-- #/ container -->
		</div>
		<!--**********************************
			Content body end
		***********************************-->
		


		<!--**********************************
			Footer start
		***********************************-->
		<div class="footer">
			<div class="copyright">
				<ul class="footer-menu">
				<li><a href="login.php">Model login</a></li>
				<li><a href="">Adult Affiliate Program</a></li>
				<li><a href="">Model Wanted</a></li>
				<li><a href="">Events and Media</a></li>
				<li><a href="">Contact Us</a></li>
				<li><a href="">FAQ</a></li>
				<li><a href="">DMCA Complaint</a></li>
				<li><a href="">Support</a></li>
				<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
				<li><a href=""><i class="fab fa-twitter"></i></a></li>
				<li><a href=""><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="terbox">
			<div class="container">
				<p>The site contains sexually explicit material, Enter ONLY if you are at least 18 years old and agree to our cookie rules.</p>
				<p>18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement</p>
				<p>This site is owned and operated by Pondacam</p>
			</div>
		</div>		
		<div class="copyrightbox">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-4 col-sm-12">
						<p>Copyright &copy; All Right Recevied pondacam 2020</p>
					</div>
					<div class="col-12 col-md-8 col-sm-12">
						<ul class="footer-menu">
							<li><a href="">Help</a></li>
							<li><a href="">Terms &amp; Conditions</a></li>
							<li><a href="">Ownership Statement</a></li>
							<li><a href="">Anti-Spam Policy</a></li>
							<li><a href="">Refund Policy</a></li>
							<li><a href="">Privacy Policy</a></li>
							<li><a href="">Cookies Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>		
        <!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
	CHAT START
***********************************-->
<style>
@import url(https://fonts.googleapis.com/css?family=Oswald:400,300);
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
body
{
    font-family: 'Open Sans', sans-serif;
    }
.popup-box {
   background-color: #ffffff;
    border: 1px solid #b0b0b0;
    bottom: 0;
    display: none;
    height: 500px;
    position: fixed;
    right: 70px;
    width: 30%;
    font-family: 'Open Sans', sans-serif;
}
.round.hollow {
    margin: 40px 0 0;
}
.round.hollow a {
    border: 2px solid #ff6701;
    border-radius: 35px;
    color: red;
    color: #ff6701;
    font-size: 23px;
    padding: 10px 21px;
    text-decoration: none;
    font-family: 'Open Sans', sans-serif;
}
.round.hollow a:hover {
    border: 2px solid #000;
    border-radius: 35px;
    color: red;
    color: #000;
    font-size: 23px;
    padding: 10px 21px;
    text-decoration: none;
}
.popup-box-on {
    display: block !important;
}
.popup-box .popup-head {
    background-color: #fff;
    clear: both;
    color: #7b7b7b;
    display: inline-table;
    font-size: 21px;
    padding: 7px 10px;
    width: 100%;
     font-family: Oswald;
}
.bg_none i {
    border: 1px solid #ff6701;
    border-radius: 25px;
    color: #ff6701;
    font-size: 17px;
    height: 33px;
    line-height: 30px;
    width: 33px;
}
.bg_none:hover i {
    border: 1px solid #000;
    border-radius: 25px;
    color: #000;
    font-size: 17px;
    height: 33px;
    line-height: 30px;
    width: 33px;
}
.bg_none {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
}
.popup-box .popup-head .popup-head-right {
    margin: 11px 7px 0;
}
.popup-box .popup-messages {
}
.popup-head-left img {
    border: 1px solid #7b7b7b;
    border-radius: 50%;
    width: 44px;
}
.popup-messages-footer > textarea {
    border-bottom: 1px solid #b2b2b2 !important;
    height: 34px !important;
    margin: 7px;
    padding: 5px !important;
     border: medium none;
    width: 95% !important;
}
.popup-messages-footer {
    background: #fff none repeat scroll 0 0;
    bottom: 10;
    position: absolute;
    width: 100%;
}
.popup-messages-footer .btn-footer {
    overflow: hidden;
    padding: 2px 5px 10px 6px;
    width: 100%;
}
.simple_round {
    background: #d1d1d1 none repeat scroll 0 0;
    border-radius: 50%;
    color: #4b4b4b !important;
    height: 21px;
    padding: 0 0 0 1px;
    width: 21px;
}





.popup-box .popup-messages {
    background: #3f9684 none repeat scroll 0 0;
    height: 275px;
    overflow: auto;
}
.direct-chat-messages {
    overflow: auto;
    padding: 10px;
    transform: translate(0px, 0px);
    
}
.popup-messages .chat-box-single-line {
    border-bottom: 1px solid #a4c6b5;
    height: 12px;
    margin: 7px 0 20px;
    position: relative;
    text-align: center;
}
.popup-messages abbr.timestamp {
    background: #3f9684 none repeat scroll 0 0;
    color: #fff;
    padding: 0 11px;
}

.popup-head-right .btn-group {
    display: inline-flex;
	margin: 0 8px 0 0;
	vertical-align: top !important;
}
.chat-header-button {
    background: transparent none repeat scroll 0 0;
    border: 1px solid #636364;
    border-radius: 50%;
    font-size: 14px;
    height: 30px;
    width: 30px;
}
.popup-head-right .btn-group .dropdown-menu {
    border: medium none;
    min-width: 122px;
	padding: 0;
}
.popup-head-right .btn-group .dropdown-menu li a {
    font-size: 12px;
    padding: 3px 10px;
	color: #303030;
}

.popup-messages abbr.timestamp {
    background: #3f9684  none repeat scroll 0 0;
    color: #fff;
    padding: 0 11px;
}
.popup-messages .chat-box-single-line {
    border-bottom: 1px solid #a4c6b5;
    height: 12px;
    margin: 7px 0 20px;
    position: relative;
    text-align: center;
}
.popup-messages .direct-chat-messages {
    height: inher;
}
.popup-messages .direct-chat-text {
    background: #dfece7 none repeat scroll 0 0;
    border: 1px solid #dfece7;
    border-radius: 2px;
    color: #1f2121;
}

.popup-messages .direct-chat-timestamp {
    color: #fff;
    opacity: 0.6;
}

.popup-messages .direct-chat-name {
	font-size: 15px;
	font-weight: 600;
	margin: 0 0 0 49px !important;
	color: #fff;
	opacity: 0.9;
}
.popup-messages .direct-chat-info {
    display: block;
    font-size: 12px;
    margin-bottom: 0;
}
.popup-messages  .big-round {
    margin: -9px 0 0 !important;
}
.popup-messages  .direct-chat-img {
    border: 1px solid #fff;
	background: #3f9684  none repeat scroll 0 0;
    border-radius: 50%;
    float: left;
    height: 40px;
    margin: -21px 0 0;
    width: 40px;
}
.direct-chat-reply-name {
    color: #fff;
    font-size: 15px;
    margin: 0 0 0 10px;
    opacity: 0.9;
}

.direct-chat-img-reply-small
{
    border: 1px solid #fff;
    border-radius: 50%;
    float: left;
    height: 20px;
    margin: 0 8px;
    width: 20px;
	background:#3f9684;
}

.popup-messages .direct-chat-msg {
    margin-bottom: 10px;
    position: relative;
}

.popup-messages .doted-border::after {
	background: transparent none repeat scroll 0 0 !important;
    border-right: 2px dotted #fff !important;
	bottom: 0;
    content: "";
    left: 17px;
    margin: 0;
    position: absolute;
    top: 0;
    width: 2px;
	 display: inline;
	  z-index: -2;
}

.popup-messages .direct-chat-msg::after {
    background: #fff none repeat scroll 0 0;
    border-right: medium none;
    bottom: 0;
    content: "";
    left: 17px;
    margin: 0;
    position: absolute;
    top: 0;
    width: 2px;
	 display: inline;
	  z-index: -2;
}
.direct-chat-text::after, .direct-chat-text::before {
   
    border-color: transparent #dfece7 transparent transparent;
    
}
.direct-chat-text::after, .direct-chat-text::before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: transparent #d2d6de transparent transparent;
    border-image: none;
    border-style: solid;
    border-width: medium;
    content: " ";
    height: 0;
    pointer-events: none;
    position: absolute;
    right: 100%;
    top: 15px;
    width: 0;
}
.direct-chat-text::after {
    border-width: 5px;
    margin-top: -5px;
}
.popup-messages .direct-chat-text {
    background: #dfece7 none repeat scroll 0 0;
    border: 1px solid #dfece7;
    border-radius: 2px;
    color: #1f2121;
}
.direct-chat-text {
    background: #d2d6de none repeat scroll 0 0;
    border: 1px solid #d2d6de;
    border-radius: 5px;
    color: #444;
    margin: 5px 0 0 50px;
    padding: 5px 10px;
    position: relative;
}

		</style>
<div class="popup-box chat-popup" id="qnimate">
	<div class="popup-head">
		<div class="popup-head-left pull-left"><img src="./documents/<?php if(isset($model)){echo $model[0]['selfie'];}?>" alt="iamgurdeeposahan"> <?php if(isset($model)){ echo $model[0]['name'];} ?></div>
			  <div class="popup-head-right pull-right">
				<div class="btn-group">
							  <button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
							   <i class="glyphicon glyphicon-cog"></i> </button>
							  <ul role="menu" class="dropdown-menu pull-right">
								<li><a href="#">Media</a></li>
								<li><a href="#">Block</a></li>
								<li><a href="#">Clear Chat</a></li>
								<li><a href="#">Email Chat</a></li>
							  </ul>
				</div>
				
				<button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
              </div>
	  </div>
	<div class="popup-messages">
    	<div class="direct-chat-messages" id="msgView">
                
    			
        
        </div>
	</div>
	<div class="popup-messages-footer">
    	<textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
    	<div class="btn-footer">
    	<button id"sendTokens" onclick="sendToken()" class="bg_none"><i class="glyphicon glyphicon-usd"></i> </button>
    	<button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
        <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
    	<button id"sendMessage" onclick="sendMsg()" class="bg_none pull-right"><i class="glyphicon glyphicon-send"></i> </button>
    	</div>
	</div>
</div>
<!--**********************************
	CHAT END
***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	<!-- modal (quickViewModal) -->
	<div class="modal  fade"  id="searchmobile" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg mobiles-search-box">
			<div class="modal-content ">

				<div class="modal-body">
					<div class="input-group topsearchbar">
						<input type="text" class="form-control" placeholder="Search for models or categories">
							<div class="input-group-append">
							<button class="btn btn-secondary" type="button">
								<i class="fa fa-search"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- modal login -->
	<div class="modal  fade"  id="login" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mobiles-search-box">
		<div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Login <i class="fas fa-lock"></i></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
			<div class="modal-body loginbox-bg">
				 <h5 class="headig-logon">Welcome to Pondacam </h5>
				<form class="mt-3 mb-3 login-input" method ="post">
                    <div class="form-group">
                        <label>Email</label>
						<input type="email" id = "chatemail" name = "email" class="form-control" placeholder="Username">
						<span id = "chatemailErr" >*</span>
                    </div>
                    <div class="form-group">
					    <label>Password</label>
						<input type="password" id = "chatpass" name = "password" class="form-control" placeholder="Password">
						<span id = "chatpassErr">*</span>
                    </div>
                   <button type = "button" id = "chatlogin" class="btn login-form__btn submit">Log In</button>
                </form>				
				<p class="mt-1 login-form__footer">
				   <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#forgotpassword">Click here</a> 
				   If you fogot password?</p>
				<p class="login-form__footer">Dont have account? <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#joinnow">Join Now</a></p>
			</div>
		</div>
	</div>
</div>	
	
	
	<!-- modal Forgot -->
	<div class="modal  fade"  id="forgotpassword" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered mobiles-search-box">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title">Forgot Password <i class="fas fa-lock"></i></h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body loginbox-bg">
					<h6 class="headig-logon">To reset your password, enter your username and email address</h6>
					<form class="mt-3 mb-3 login-input">
						<div class="form-group">
							<label>User Name</label>
							<input type="email" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" placeholder="Email">
						</div>
					<button class="btn login-form__btn submit">Send</button>
					<button class="btn login-form__btnback submit" data-toggle="modal" data-dismiss="modal">Back</button>
					</form>
				</div>
			</div>
		</div>
	</div>		
    <!-- modal Join now -->
	<div class="modal  fade"  id="joinnow" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog model-lg modal-dialog-centered mobiles-search-box">
		<div class="modal-content ">
		    <div class="modal-body joinnowbg">
			     <div class="row">
				   <div class="col-sm-5 image-holderbgjoin"></div>
				   <div class="col-sm-7">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<form method="post" class="paddform">
						   <h2 class="headig-logon mb-3">Join Now And Enjoy</h2>
							 <form class="mt-3 mb-3 login-input">
								<div class="form-group">
									<label>Name</label>
									<input type="text" id = "chatName" name = "name" class="form-control" placeholder="Username">
									<span id = "nameErr">*</span>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" id = "chatEmail" name = "email" class="form-control" placeholder="Email">
									<span id = "emailErr">*</span>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" id = "chatPass" name = "password" class="form-control" placeholder="Password">
									<span id = "passErr">*</span>
								</div>
								
							   <button id ="join" type ="button" class="btn login-form__btn submit">Join Now</button>
							   <a href="#" class="join-loginbt" data-dismiss="modal" data-toggle="modal" data-target="#login">Login</a>
							 
								<p class="mt-3 login-form__footer">
								   Your activity could reflect your sexual interests. By enjoying our  
									<a href="#" class="text-primary">services. </a> and by clicking on "Join Now" 
									,You agree to some 
									<a href="#" class="text-primary">sensitive data being processed.</a>
								</p> 
							
						</form>
					</div>
				
			</div>
		</div>
	</div>
</div>			
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="js/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
	<script>
		$("button").click(function(){ 			    
			var currentid=$(this).attr('id');
			if(currentid=='chatlogin'){
				document.getElementById('chatpassErr').innerHTML="*";
				document.getElementById('chatemailErr').innerHTML="*";
				var email = document.getElementById('chatemail').value;
				//alert(email);
				var password = document.getElementById('chatpass').value;
				if (email == "")
				{
					document.getElementById('chatemailErr').innerHTML = "Input field required";
					return false;
				}else if(/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(email)){
                    
                }else{
					document.getElementById('chatemailErr').innerHTML = "Input Valid Email!!";
					return false;
				}
				if (password == "")
				{
					document.getElementById('chatpassErr').innerHTML = "Input field required";
					return false;
				}
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function ()
				{
					if (this.readyState == 4 && this.status == 200)
					{
						var response = this.responseText;
						//alert(response);
					    //console.log(response);
						var row = JSON.parse(response);
						if(row['mailErr']=='ERROR!!'){
							document.getElementById('chatemailErr').innerHTML = "Sorry You are not Registered";
					        return false;

						}else if(row['passErr']=='ERROR!!'){
							document.getElementById('chatpassErr').innerHTML = "Invalid Password";
					        return false;
						}else{
							window.location.href='index.php';
						}
						//console.log(row['mailErr']);
						//console.log(row['passErr']);
					   // console.log(row[0]);
					}
				};
				xhttp.open("POST", "chatlogin.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("email=" + email + "&password=" + password);
			}else if(currentid=='join'){				
				document.getElementById('passErr').innerHTML ="*";
				document.getElementById('emailErr').innerHTML="*";
				document.getElementById('nameErr').innerHTML ="*";
				var name = document.getElementById('chatName').value;
				var email = document.getElementById('chatEmail').value;
				var password = document.getElementById('chatPass').value;
				if (name == "")
				{
					document.getElementById('nameErr').innerHTML = "Input field required";
					return false;
				}else if(/^([a-zA-Z ])+$/.test(name)){
			
				}else{
					document.getElementById('nameErr').innerHTML = "Only Letters and space are allowed";
					return false;
				}
				if (email == "")
				{
					document.getElementById('emailErr').innerHTML = "Input field required";
					return false;
				}else if(/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(email)){
                    
                }else{
					document.getElementById('emailErr').innerHTML = "Input Valid Email!!";
					return false;
				}
				if (password == "")
				{
					document.getElementById('passErr').innerHTML = "Input field required";
					return false;
				}
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function ()
				{
					if (this.readyState == 4 && this.status == 200)
					{
						var response = this.responseText;
						if(response == 'Email Already Exist!!'){
							document.getElementById('emailErr').innerHTML = response;
					        return false;
						}else{
							window.location.href='index.php';
						}
						//alert(response);
						//console.log(response);
						//var row = JSON.parse(response);
					   // console.log(row[0]);
					   // console.log(row[0]);
					}
				};
				xhttp.open("POST", "chatregister.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("name="+name+"&email=" + email + "&password=" + password);
			}			
		});
	</script>
</body>
</html>