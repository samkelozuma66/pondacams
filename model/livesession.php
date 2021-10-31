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
$directChat = $conn->getRow('direct_chat',['model_id'=>$_SESSION['id']]);
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
		<script src="live.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
		
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	
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
						<p class="mb-1" style="display:inline-block;padding-top:50%">
						    
						    <?php 
						        $usr = $conn->getRow('users',["id" => $_SESSION['id'] ]);
						    ?>
						    <i class="fa fa-database" aria-hidden="true" style="display:inline-block;"></i>
							<p id="tkAmount" style="display:inline-block"><?php if(isset($usr)){echo $usr[0]["money"]; }else{echo 0; }?></p> tk
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
                <div class="collapse" id="helpinfo" style="color:white;">
                    Email  <a href = "mailto: admin@pondacams.com" style="color:yellow;"><b style="color:yellow;">admin@pondacams.com</b> </a> for help
                  <!--<ul class="nav flex-column sub-menu">
                    <li class="nav-item" style="color:yellow"> <a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Chat</a></li>
                  </ul>-->
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
            <div class="row" style="border-style: dotted;background-color:#000011">
                <div class="col-md-4 col-xl-5" style="border-style: dotted;">
                    <style>
                        #session_placeholder
                        {
                            color:white;
                            text-align:center;
                            position:absolute;
                            padding-top:30%;
                            z-index:1;
                            width:100%;
                        }
                    </style>
                    <script>
                        var connections = [];
                        var roomUsers   = {"knight":"none","private":"none","username":"","userid":""};
                        //roomUsers[] = ;
                        console.log(roomUsers);
                        function startSessionClick()
                        {
                            //camera
                            var start = document.getElementById("start");
                            
                            start.click();
                            var readyText = document.getElementById("readyText");
                            readyText.style.display = "none";
                        }
                    </script>
                    <div id="session_placeholder">
                        <div id="waitText" ><h1> Waiting for session ID ... </h1></div>
                        <div id="readyText" style="display:none;text-align:center;background-color:black;">
                            <input type="button" name="next" id="startInline" class="next btn btn-primary" value="Start Live Session" />
                        </div>
                    </div>
			         <video id="video"  muted style="object-fit: fill;z-index:-1;"></video>
		        </div>
		        <style>
				    /* Style the tab */
                    .tab {
                      overflow: hidden;
                      border: 1px solid #ccc;
                      background-color: #f1f1f1;
                    }
                    
                    /* Style the buttons inside the tab */
                    .tab button {
                      background-color: inherit;
                      float: left;
                      border: none;
                      outline: none;
                      cursor: pointer;
                      padding: 14px 16px;
                      transition: 0.3s;
                      font-size: 17px;
                      height:50px;
                      border-radius:10px 10px 0px 0px;
                    }
                    
                    /* Change background color of buttons on hover */
                    .tab button:hover {
                      background-color: #ddd;
                    }
                    
                    /* Create an active/current tablink class */
                    .tab button.active {
                      background-color: #000;
                                      color:white;
                    }
                    
                    /* Style the tab content */
                    .tabcontent {
                      display: none;
                      border: none;
                      border-top: none;
                    }
				    #privateTab {
				        display:block;
				    }
				    #chatControl {
                        position: absolute;
                        right: 0px;
                        
                       /* border-style: dotted;*/
                        cursor: pointer;
                    }
				</style>
		        <div class="col-md-8 col-xl-7" style="border-style: none;">
		            
		            <div class="tab" id="tab" style="display:block;background:#fff;border-style: none;margin-top:-10px;margin-bottom:-20px;margin-left:-20px">
                        <button class="tablinks active" onclick="openCity(event, 'public')" style="display:inline-block;font-size:20px;">PUBLIC&nbsp;<p  style="display:inline-block;"> </p></button>
                        <button class="tablinks" onclick="openCity(event, 'private')" id="privateTab" style="display:inline-block;font-size:20px;">PRIVATE&nbsp;<p style="display:inline-block;"> </p></button>
                        <button class="tablinks" onclick="openCity(event, 'users')" style="display:inline-block;font-size:20px;">USERS&nbsp;<p id="audience" style="display:inline-block;background-color:white;border-radius:10px;width:20px;">0</p></button>
                        <button class="tablinks" onclick="openCity(event, 'dm')" style="display:inline-block;font-size:20px;">DM</button>
                        <button class="tablinks" id="action_menu_btn" ><i class="fas fa-ellipsis-v"></i></button>
                        <!--<div class="action_menu">
							<ul>
								<li><i class="fas fa-user-circle"></i> View profile</li>
								<li><i class="fas fa-users"></i> Add to close friends</li>
								<li><i class="fas fa-plus"></i> Add to group</li>
								<li><i class="fas fa-ban"></i> Block</li>
							</ul>
						</div>-->
                    </div>
                    
		            <div id="public" class="tabcontent" style="display:block;">
                        <div class="card-body msg_card_body" id="msgView" style="background-color:black;color:white;height:400px">
                            
						</div>
						<div style="background-color:black;color:white;height:70px">
						    <div class="" style="background-color:#C0C0C0;color:white;height:70px;border-radius:30px; padding-left:10px;">
    						    <input type="text" id="messageBox" placeholder="Type..." name="" class="" style="background-color:#C0C0C0;height:70px;width:90%;border:none;border-radius:30px" >
    						    <a href="#" style="font-size:20px;" id="sendMessage"><i class="fas fa-paper-plane"></i></a>
    						</div>
						    
						</div>
						
                    </div>
                    <script>
                        // Get the input field
                        var messageBox = document.getElementById("messageBox");
                        
                        messageBox.addEventListener("keyup", function(event) 
                        {
                          if (event.keyCode === 13) 
                          {
                            event.preventDefault();
                            document.getElementById("sendMessage").click();
                          }
                        });
                    </script>
                    <div id="private" class="tabcontent">
                        <div class="card-body msg_card_body" id="msgViewPrivate" style="background-color:black;color:white;height:400px">
                            
						</div>
						<div style="background-color:black;color:white;height:70px">
						    <div class="" style="background-color:#C0C0C0;color:white;height:70px;border-radius:30px; padding-left:10px;">
    						    <input type="text" id="privateMessageBox" placeholder="Type..." name="privateMessage" class="" style="background-color:#C0C0C0;height:70px;width:90%;border:none;border-radius:30px" >
    						    <a href="#" style="font-size:20px;" id="sendMessagePrivate"><i class="fas fa-paper-plane"></i></a>
    						</div>
						    
						</div>
                    </div>
                    
                    <div id="users" class="tabcontent">
                        <div class="card-body msg_card_body" id="userView"  style="background-color:black;color:white;height:470px">
                            
						</div>
                    </div>
                    <style>
                        .msgDM {
                            color:white;
                            font-size:15px;
                            width:100%;
                        }
                        .msgDM:hover {
                            background-color:grey;
                        }
                    </style>
                    <div id="dm" class="tabcontent">
                        <div class="card-body msg_card_body" style="color:white;width:30%;display:inline-block;height:470px;background-color:red;margin-top:20px">
                            <?php 
                                //echo isset($directChat[0]);
                                foreach($directChat as $ind => $row2)
                                {
                                  
                            ?>
                            <a class="chatNames" href="#" style="" onclick="openDChat('<?php echo $row2['chatuser_id']; ?>','dc<?php echo $row2['chatuser_id']; ?>')">
                                <div class = "msgDM" style="" id="dc<?php echo $row2['chatuser_id']; ?>">
                                    <?php echo $row2['chatuser_name']; ?>
                                </div>
                            </a>
                            <?php 
                                }
                                  
                            ?>
                        </div>
                        <?php 
                            //echo isset($directChat[0]);
                            foreach($directChat as $ind => $row3)
                            {
                              
                        ?>
                        <div class="card-body msg_card_body test" id="dmView<?php echo $row3['chatuser_id']; ?>"  style="width:65%;background-color:black;color:white;height:470px;display:none;">
                            <?php 
                                $directMessage = $conn->getRow('direct_msg',['dc_id'=>$row3['id']]);
                                foreach($directMessage as $ind1 => $row1)
                                {
                                  
                            ?>
                            <div style="position:releted;left:1px;text-align:left;">
                                <a href="#" style="color:<?php if($row1['from_id'] == $_SESSION['id']){ echo "green"; }else{ echo "red"; }?>;font-size:20px;" onclick=""><b> <?php echo $row1['name']; ?> </b></a> 
                                 <?php echo $row1['msg']; ?>
                            </div>
                            <?php 
                                }
                                  
                            ?>
                            <!--<div style="position:releted;left:1px;text-align:left;height:80px;">
                                
                            </div>-->
                            <div style="background-color:black;color:white;height:70px;position:absolute;bottom:1px;width:inherit;">
    						    <div class="" style="background-color:#C0C0C0;color:white;height:70px;border-radius:30px; padding-left:10px;">
        						    <input type="text" id="messageBoxDM<?php echo $row3['id']; ?>" placeholder="Type..." name="" class="" style="background-color:#C0C0C0;height:70px;width:90%;border:none;border-radius:30px" >
        						    <a href="#" style="font-size:20px;" id="sendMessageDM" onclick="sendDm('<?php echo $row3['id']; ?>','dmView<?php echo $row3['chatuser_id']; ?>')"><i class="fas fa-paper-plane"></i></a>
        						</div>
    						    
    						</div>
						</div>
						
						<?php 
                            }
                              
                        ?>
                    </div>
		            <script>
		                var knighId = "";
		                function addDM(id,msg,name)
		                {
		                    var dmDiv = document.getElementById(id);
		                    dmDiv.innerHTML = dmDiv.innerHTML 
		                                    + '<div style="position:releted;left:1px;text-align:left;">'
                                            +  '<a href="#" style="color:green";font-size:20px;" onclick=""><b> '+name+' </b></a> '
                                            +  msg
                                            + '</div>';
		                }
		                function sendDm(dc_id,divId)
		                {
		                    var msgbox = document.getElementById("messageBoxDM"+dc_id);
		                    $.post('senddm.php', 
                                    {   dc_id:dc_id,
                                        from_id:"<?php echo $_SESSION['id']?>",
                                        msg:msgbox.value,
                                        name:"<?php echo $_SESSION['name']?>"
                                        
                                    }, 
                                    function(response)
                                    {
                                        addDM(divId,msgbox.value,"<?php echo $_SESSION['name']?>");
                                        msgbox.value = "";
                                    });
		                    
		                    
		                }
		                function openDChat(id,divName)
		                {
		                    var y = document.getElementsByClassName("msgDM");
		                    var z;
                            for (z = 0; z < y.length; z++) {
                              y[z].className = "msgDM";
                            }
                            
		                    var divt = document.getElementById(divName);
		                    divt.className = "msgDM active";
		                    
		                    //dmView chatNames
		                    
		                    var x = document.getElementsByClassName("card-body msg_card_body test");
		                    var i;
                            for (i = 0; i < x.length; i++) {
                              x[i].style.display = "none";
                            }
                            
		                    var div2 = document.getElementById("dmView"+id);
		                    div2.style.display = "inline-block";
		                    
		                }
		                function banUser(id,userOption,name)
                        {
                            //alert(id);
                            //console.log(dataConn);
                            //blockUser.php
                            var model_id = "<?php echo $_SESSION['id']?>";
                            $.post('blockUser.php', 
                                    {   chatuser:id,
                                        model_id:model_id,
                                        type:"banish"
                                        
                                    }, 
                                    function(response)
                                    {
                                        connections.forEach(function (con, index)
                                        {
                                            if(con.open && id == con.metadata.id)
                                            {
                                                //con.send({name:"<?php echo $_SESSION['name'] ?>" , message:messageBox.value});
                                                con.send({name:"Banned" , message:"<?php echo $_SESSION['name'] ?> Banned you ",chatuser:id});
                                                
                                            }
                                        });
                                        addNotification1("You blocked " + name);
                                    });
                            $('#' + userOption).toggle();
                        }
                        function knight(id,name,userOption)
                        {
                            knighId = id;
                            roomUsers.knight = knighId;
                            console.log(roomUsers);
                            connections.forEach(function (con, index)
                            {
                                if(con.open)
                                {
                                    //con.send({name:"<?php echo $_SESSION['name'] ?>" , message:messageBox.value});
                                    con.send({name:"Knight" , message:name + " was Knighted ",chatuser:id});
                                    
                                }
                            });
                            addNotification1("You Knighted " + name);
                            $('#' + userOption).toggle();
                            //dataConn.send({name:"Knight" , message:"Private show Declined",chatuser:id});
                        }
                        function addNotification1(msg)
                        {
                            
                            var msgView = document.getElementById("msgView");
                            msgView.innerHTML = msgView.innerHTML + "<div style='text-align:center;float :right;width: 100%;'>" + msg + "</div>";
                        
                            let objDiv = document.getElementById("msgView");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }

		                function blockUser(id,userOption,name)
                        {
                            //alert(id);
                            //console.log(dataConn);
                            //blockUser.php
                            var model_id = "<?php echo $_SESSION['id']?>";
                            $.post('blockUser.php', 
                                    {   chatuser:id,
                                        model_id:model_id,
                                        type:"block"
                                        
                                    }, 
                                    function(response)
                                    {
                                        connections.forEach(function (con, index)
                                        {
                                            if(con.open && id == con.metadata.id)
                                            {
                                                //con.send({name:"<?php echo $_SESSION['name'] ?>" , message:messageBox.value});
                                                con.send({name:"Blocked" , message:"<?php echo $_SESSION['name'] ?> Blocked you ",chatuser:id});
                                                
                                            }
                                        });
                                        addNotification1("You blocked " + name);
                                    });
                                    
                            $('#' + userOption).toggle();
                            
                        }
                        function addUserTab(name,id)
                            {
                                //name.replace(" ", "_");
                                
                                var msgView = document.getElementById("userView");
                                var msgDiv = 
                                   '<div style="position:releted;left:1px;text-align:left;" id="userdiv'+id+'">';
                                if(knighId != id)
                                {
								msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                }
                                else
                                {
                                msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                }
                                msgDiv = msgDiv 
                                +       '<div class="action_menu" id="userOption'+ id +'" style="left:1px;background-color:red">'
        						+	        '<ul>'
        						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
        						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+  id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
        						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
        						+		        '<li><a onclick="banUser('+id+',\'userOption'+  id +'\',\''+name+'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
        						+		        '<li><a onclick="blockUser('+id+',\'userOption'+  id +'\',\''+name+'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
        						+	        '</ul>'
        						+       '</div>'
                                +   '</div>';
                                
                                msgView.innerHTML = msgView.innerHTML + msgDiv;
								let objDiv = document.getElementById("userView");
                                objDiv.scrollTop = objDiv.scrollHeight;	
                                
								/*"<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";*/
                            }
						function openCity(evt, cityName) 
						{
                              var i, tabcontent, tablinks;
                              
                              tabcontent = document.getElementsByClassName("tabcontent");
                              
                              for (i = 0; i < tabcontent.length; i++) 
                              {
                                    tabcontent[i].style.display = "none";
                              }
                              
                              tablinks = document.getElementsByClassName("tablinks");
                              
                              for (i = 0; i < tablinks.length; i++) 
                              {
                                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                              }
                              document.getElementById(cityName).style.display = "block";
                              
                              evt.currentTarget.className += " active";
                        }
    							
                                    //alert("data");
                                //new ResizeObserver(outputsize).observe(textbox) videoPlayer
                                    //var videoWrapper = document.getElementById("videoWrapperId");
                                    //var  width  = 0;
                                    //var  height = 0;
                                    //var lastHeight = 0;
                        function outputsize() {
                            
                            var chatFooter = document.getElementById("chatFooter");
                            var tab = document.getElementById("tab");
                            var privateHide = document.getElementById("privateHide");
                            
                            var videoPlayer = document.getElementById("videoPlayer");
                            var videoControl = document.getElementById("videoControl");
                        
                            var chatControl = document.getElementById("chatControl");
                            var conDiv = document.getElementById("conDiv");
                        
                            width  = videoWrapper.offsetWidth;
                            height = videoWrapper.offsetHeight;
                            var msgView = document.getElementById("msgView");
                            var msgViewPrivate = document.getElementById("msgViewPrivate");
                            //alert(width); msgViewPrivate
                            if(width < 700 )
                            {
                                /*if((height / 2)  != lastHeight)
                                {
                                    videoWrapper.style.height = (height * 2) + "px";
                                    lastHeight =height;
                                }*/
                                var videoControlSizeH = Math.round(height * 0.1);
                                var videoControlSizeW = Math.round(width * 1);
                                
                                chatControl.style.right    =  "1px";
                                chatControl.style.bottom   =  "0px";
                                
                                chatControl.style.position = "relative";
                                chatControl.style.height = (height) + "px";
                                chatControl.style.width  = width  + "px";
                                
                                videoControl.style.height = videoControlSizeH + "px";
                                videoControl.style.width  = videoControlSizeW + "px";
                                
                                msgView.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - tab.offsetHeight) + "px";
                                msgViewPrivate.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - tab.offsetHeight) + "px";
                                
                                //alert ("width "+ videoPlayer.width);
                                videoPlayer.height = height - videoControlSizeH;
                                videoPlayer.width  = width ;
                                
                                privateHide.style.height = height - videoControlSizeH + "px";
                                privateHide.style.width  = width + "px";
                                
                                conDiv.style.height = (height * 2) + "px";
                            }
                            else
                            {
                                
                                var videoControlSizeH = Math.round(height * 0.1);
                                var videoControlSizeW = Math.round(width * 0.7);
                            
                                chatControl.style.right   =  "1px";
                                chatControl.style.top     =  "0px";
                                
                                chatControl.style.position = "absolute";
                                chatControl.style.height = height + "px";
                                chatControl.style.width  = (width - videoControlSizeW - 20) + "px";
                                
                                videoControl.style.height = videoControlSizeH + "px";
                                videoControl.style.width  = videoControlSizeW + "px";
                                
                                msgView.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - tab.offsetHeight) + "px";
                                msgViewPrivate.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - tab.offsetHeight) + "px";
                                //alert ("width "+ videoPlayer.width);
                                videoPlayer.height = height - videoControlSizeH;
                                videoPlayer.width  = videoControlSizeW ;
                                
                                privateHide.style.height = height - videoControlSizeH + "px";
                                privateHide.style.width  = videoControlSizeW + "px";
                                
                                //alert ("height "+ videoPlayer.height);
                                conDiv.style.height = height + videoControlSizeH + "px";
                            }
                        }
                                    //outputsize()
                                    
                                    //new ResizeObserver(outputsize).observe(videoWrapper);
                    </script>
		            
		            <!--<div class="card-header msg_head">
						<div class="d-flex bd-highlight">
							<div class="user_info">
								<span>Chats</span>
								<div id="audience">0 audience</div>
							</div>
						</div>
						<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
						<div class="action_menu">
							<ul>
								<li><i class="fas fa-user-circle"></i> View profile</li>
								<li><i class="fas fa-users"></i> Add to close friends</li>
								<li><i class="fas fa-plus"></i> Add to group</li>
								<li><i class="fas fa-ban"></i> Block</li>
							</ul>
						</div>
					</div>-->
					
		        </div>
		    </div>
            <div class="row" style="display:none;">
                
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
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body" id="msgView">
							
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea id="messageBox1" name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
								    <a href="#" id="sendMessage1">
								        
    									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
									
								    </a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
            </div>
            <p> 
				    <br/>
				    <input type="button" name="next" id="start" class="next btn btn-primary" value="Start Live Session"  style="display:none"/>
				    
				    <input type="button" name="next" id="stop" class="next btn btn-danger" value="Stop Live Session" hidden />
				    <input type="button" name="next" id="stopPrivate" class="next btn btn-danger" value="Stop Private Session" hidden />
				    
				    <input type="text" name="idlocal" id="idlocal" class="next btn btn-primary"   style="display:none"/>
				    <input type="hidden" name="sessionID" id="sessionID" class="next btn btn-primary"  />
				    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
                    <script type="text/javascript">
                        (function () {
            
                            var lastPeerId = null;
                            var peer = null; // Own peer object
                            var peerId = null;
                            var conn = null;
                            var newCall = null;
                            var caller = [];
                            //var connections = [];
                            var userCount = 0;
                            var start = document.getElementById("start");
                            var startInline = document.getElementById("startInline");
                            var stop  = document.getElementById("stop");
                            var sendMessage = document.getElementById("sendMessage");
                            var sendMessagePrivate = document.getElementById("sendMessagePrivate");
                            var messageBox = document.getElementById("messageBox");
                            var privateMessageBox = document.getElementById("privateMessageBox");
                            var msgView = document.getElementById("msgView");
                            var msgViewPrivate = document.getElementById("msgViewPrivate");
                            
                            var audience = document.getElementById("audience");
                            var stopPrivate = document.getElementById("stopPrivate");
                            
                            var messageId = 0;
                            var privateActive = false;
                            var spyActive = false;
                            
                            /*var recvId = document.getElementById("receiver-id");audience msgViewPrivate
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
                                        var readyText = document.getElementById("readyText");
                                        readyText.style.display = "block";
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
                                 var camera = document.getElementById("camera");
                              
                                var constraints = { audio: true, video: { deviceId: camera.value } };
                                
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
                                var id = '<?php echo $row[0]['id']; ?>';
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
                                privateActive = true;
                                //spyActive = true;
                                
                                stopPrivate.hidden = false;
                                roomUsers.private = chatuser_id;
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
                            function stopSpy()
                            {
                                spyActive = false;
                            }
                            function stopPrivateSe()
                            {
                                
                                var sessionID = document.getElementById("sessionID");
                                var sid = sessionID.value;
                                privateActive = false;
                                spyActive = false;
                                roomUsers.private = "none"
                                stopPrivate.hidden = true;
                                
                                $.post('updateSession.php', 
                                    {   id:sid,
                                        type:"public",
                                        chatuser_id:"0"
                                    }, 
                                    function(response)
                                    {
                                        if(connections != null)
                                        {
                                             connections.forEach(function (con, index)
                                            {
                                                if(con.open)
                                                {
                                                    con.send({name:"stopPrivate"});
                                                }
                                            });
                                        }
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
                                        if((privateActive && type == "private") || (spyActive && type == "spy"))
                                        {
                                            return fetch('//www.pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
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
                                                   else
                                                   {
                                                       var tkAmount = document.getElementById("tkAmount");
                                                       tkAmount.innerHTML = parseInt(tkAmount.innerHTML) + parseInt(tknPerMin);
                                                       
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
                                        }
                                        else
                                        {
                                            clearInterval(this);
                                        }
                                 }, 60000);
                             }
                            function join(id) 
                            {
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
                                                fetch('//www.pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
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
                                                                
                                                                spyActive = true;
                                                                var tkAmount = document.getElementById("tkAmount");
                                                                tkAmount.innerHTML = parseInt(tkAmount.innerHTML) + parseInt(tknPerMin);
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
                                                        return fetch('//www.pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
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
                                                               else
                                                               {
                                                                    var tkAmount = document.getElementById("tkAmount");
                                                                    tkAmount.innerHTML = parseInt(tkAmount.innerHTML) + parseInt(tknPerMin);
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
                            function callEm(id)
                            {
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
                            function callUser(id)
                            {
                                var video = document.querySelector('video');
                                var str   = video.srcObject;
                                var name  = '<?php echo $_SESSION['name']; ?>' ;
                                //dataConn.send({name:"roomInfo", info:"roomUsers" });
                                    
                                console.log("roomUsers");
                                console.log(roomUsers);
                                var option = {
                                    name : name,
                                    roomUsers:roomUsers
                                };
                                console.log(option);
                                newCall = peer.call(id, str,{metadata:option});
                                newCall.on('stream', function(stream) { // B
                                
                                    alert("Done");
                                    /*var video = document.querySelector('video');
                                    video.srcObject = stream; // C
                                    video.autoplay = true; // D
                                    video.volume = 1;
                                    video.play();
                                    console.log(peer.connections);*/
                                  /*videoStream = document.getElementById("status");
                                  alert(stream)
                                  videoStream.srcObject = stream; // C
                                  videoStream.autoplay = true; // D
                                  videoStream.play();*/
                                  //window.peerStream = stream; //E
                                  //showConnectedContent(); //F    });
                                });
                                caller.push(newCall);
                            }
                            function initialize() 
                            {
                                // Create own peer object with connection to shared PeerJS server
                                peer = new Peer(null, {
                                    debug: 2
                                });
            
                                peer.on('open', function (id) {
                                    var idlocal = document.getElementById("idlocal");
                                    if(lastPeerId == null)
                                    {
                                        //<select multiple class=" js-example-basic-multiple form-control form-control-lg"  id = "appearance" style = "width: 529px;">
                                        var options ="";
                                        var devices = navigator.mediaDevices.enumerateDevices();
                                        devices.then(
                                            function(result)
                                            {
                                                result.forEach(
                                                    function(item)
                                                    {
                                                        if(item.kind == "videoinput")
                                                        {
                                                            //'<option value="'+ item.deviceId +'" >'+item.label+'</option>'
                                                            var label = "";
                                                            if(item.label == "")
                                                            {
                                                                label = "Camera";
                                                            }
                                                            else
                                                            {
                                                                label = item.label;
                                                            }
                                                            options += '<option value="'+ item.deviceId +'" >'+label+'</option>';
                                                            console.log(item);
                                                            console.log(item.deviceId);
                                                        }
                                                    }
                                                );
                                                //'<select multiple class=" js-example-basic-multiple form-control form-control-lg"  id = "appearance" style = "width: 529px;">'+options+'</select>'
                                                console.log("dd "+ options);
                                                var waitText = document.getElementById("waitText");
                                                var readyText = document.getElementById("readyText");
                                                readyText.innerHTML = '<h1>Session Ready to start </h1><h5>Session ID</h5><p> '+peer.id+' </p><div><select class=" form-control form-control-lg"  id = "camera" style = "width: 90%;border-radius:10px;color:white;font-weight: bold;background-color:red;">'+options+'</select><input type="button" name="next" id="startInline" class="next btn btn-primary" onclick="startSessionClick()" value="Start Live Session" /></div>';
                                                waitText.style.display = "none";
                                                readyText.style.display = "block";
                                                lastPeerId =peer.id ;
                                            }
                                        );  
                                       
                                        
                                        
                                        
                                    }
                                    console.log('ID1: ' + peer.id);
                                    idlocal.value = peer.id;
                                });
                                peer.on('connection', function (c) {
                                    
                                    dataConn = c;
                                    if(roomUsers.username == "" && roomUsers.userid == "")
                                    {
                                        roomUsers.username = dataConn.metadata.name;
                                        roomUsers.userid   = "" + dataConn.metadata.id;
                                    }
                                    else
                                    {
                                        roomUsers.username = roomUsers.username + "," + dataConn.metadata.name;
                                        roomUsers.userid   = roomUsers.userid   + "," + dataConn.metadata.id;
                                    }
                                    
                                    callUser(dataConn.peer);
                                    console.log("Connected to: " + dataConn.peer);
                                    console.log(dataConn);
                                    
                                    addNotification(dataConn.metadata.name + " joined the chat");
                                    addUserTab(dataConn.metadata.name,dataConn.metadata.id);
                                    
                                    
                                    if(connections != null)
                                    {
                                         connections.forEach(function (con, index)
                                        {
                                            if(con.open )
                                            {
                                                var msg = dataConn.metadata.name + " joined the chat";
                                                con.send({ name:"Notification", message:msg , type:"new_join", user_name:dataConn.metadata.name , user_id:dataConn.metadata.id});
                                                //con.send({ name:"Notification", message:msg , type:"new_join", user_name:dataConn.metadata.name , user_id:dataConn.metadata.id});
                                                
                                            }
                                        });
                                    }
                               
                                
                                
                                
                                      userCount = userCount+ 1;
                                      updateCount(userCount);
                                    //call.on('close', function() { 
                                      //console.log("Call Ended");
                                      
                                  //});
                                    dataConn.on('data', function(data) {
                                        
                                        console.log(data);
                                        if(data.name != "Notification" && data.name != "request" && data.name != "stop")
                                        {
                                            if(data.type == "undifined" || data.type == null)
                                            {
                                                addRecMessage(data.name,data.message,data.user_id);
                                                if(connections != null)
                                                {
                                                     connections.forEach(function (con, index)
                                                    {
                                                        
                                                        if(con.open && data.user_id != con.metadata.id)
                                                        {
                                                            con.send(data);
                                                        }
                                                    });
                                                }
                                            }
                                            else
                                            {
                                                if(data.type == "privateMessage")
                                                {
                                                    addRecMessagePrivate(data.name,data.message,data.user_id);
                                                }
                                            }
                                            /*addRecMessage(data.name,data.message,data.user_id);
                                            if(connections != null)
                                            {
                                                 connections.forEach(function (con, index)
                                                {
                                                    
                                                    if(con.open && data.user_id != con.metadata.id)
                                                    {
                                                        con.send(data);
                                                    }
                                                });
                                            }*/
                                        }   
                                        else if(data.name == "request")
                                        {
                                            
                                            if(data.type =="spy")
                                            {
                                                var tknPerMin = "<?php if(isset($preference[0])) { echo $preference[0]['spy']; }else{ echo '50';} ?>";
                                                fetch('//www.pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
                                                .then(response => {
                                                    if (!response.ok) {
                                                      throw new Error(response.statusText)
                                                    }
                                                    var res = response.json();
                                                    var compl= true;
                                                    
                                                    res.then(data => {
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
                                                        return fetch('//www.pondacams.com/sendTokkens.php?tokkens='+tknPerMin+'&id='+data.chatuser_id+'&model_id=<?php echo $_SESSION['id'] ;?>')
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
                                                    })
                                                .then((result) => {
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
                                                        dataConn.send({name:"Notification" , message:"Private show Declined"});
                                                   }
                                                });
                                            }
                                        }
                                        else if(data.name == "stop")
                                        {
                                            
                                            if(data.type =="private")
                                            {
                                                stopPrivateSe();
                                            }
                                            else
                                            {
                                                stopSpy();
                                            }
                                        }
                                        else
                                        {
                                            addNotification(data.message);
                                        }
                                    });
                                    dataConn.on('close', function() {
                                        //conn = null; userdiv
                                        console.log("dataConn close");
                                        console.log(dataConn);
                                        var temp =[];
                                        if(connections != null)
                                        {
                                            
                                            temp = connections.filter(filters);
                                            function filters(connection)
                                            {
                                                
                                                if (connection.open != false)
                                                {
                                                    return connection;
                                                }
                                                else
                                                {
                                                    //indexOf
                                                    console.log(roomUsers);
                                                    console.log("connection.metadata Before");
                                                    var userT = "";
                                                    var nameT = "";
                                                    var useridTemp = "";
                                                    console.log(typeof(roomUsers.userid) == "object");
                                                    if(typeof(roomUsers.userid) == "object")
                                                    {
                                                        useridTemp = roomUsers.userid.filter(
                                                            function(userid){
                                                                if(userid != connection.metadata.id)
                                                                {
                                                                    return userid;
                                                                }
                                                                else
                                                                {
                                                                    userT = userid;
                                                                }
                                                                
                                                            });
                                                    }
                                                    else
                                                    {
                                                        useridTemp = roomUsers.userid.split(",").filter(
                                                            function(userid){
                                                                if(userid != connection.metadata.id)
                                                                {
                                                                    return userid;
                                                                }
                                                                else
                                                                {
                                                                    userT = userid;
                                                                }
                                                                
                                                            });
                                                    }
                                                    var usernameTemp = "";
                                                    if(typeof(roomUsers.username) == "object")
                                                    {
                                                        usernameTemp = roomUsers.username.filter(
                                                            function(username){
                                                                if(username != connection.metadata.name)
                                                                {
                                                                    return username;
                                                                }
                                                                else
                                                                {
                                                                    nameT = username;
                                                                }
                                                                
                                                            });
                                                    }
                                                    else
                                                    {
                                                        usernameTemp = roomUsers.username.split(",").filter(
                                                            function(username){
                                                                if(username != connection.metadata.name)
                                                                {
                                                                    return username;
                                                                }
                                                                else
                                                                {
                                                                    nameT = username;
                                                                }
                                                                
                                                            });
                                                    }
                                                        
                                                    roomUsers.userid   = useridTemp;
                                                    roomUsers.username = usernameTemp;
                                                    
                                                    var list = document.getElementById("userdiv"+ connection.metadata.id);
                                                    if(list !== "undifened" || list !== null)
                                                    {
                                                        list.remove();
                                                    }
                                                    connections.forEach(function (con, index)
                                                    {
                                                        if(con.open)
                                                        {
                                                            con.send({ name:"Notification", message:nameT + " Left" , type:"user_left", user_name:nameT , user_id:userT});
                                                
                                                        }
                                                    });
                                                }
                                            }
                                            /*connections.forEach(function (con, index)
                                            {
                                                if(!con.open)
                                                {
                                                    //alert(con.metadata.id);
                                                    temp = connections.filter(filters);
                                                    function filters(connection)
                                                    {
                                                        
                                                        if (connection.open != false)
                                                        {
                                                            return connection;
                                                        }
                                                        else
                                                        {
                                                            //indexOf
                                                            var indx = roomUsers.userid.split(",").indexOf("" + connection.metadata.id);
                                                            roomUsers.userid = roomUsers.userid.split(",").splice(indx,1);
                                                            roomUsers.username = roomUsers.username.split(",").splice(indx,1);
                                                            //console.log("connection.metadata");
                                                            //console.log("indexOf " + indx);
                                                        }
                                                    }
                                                    
                                                    
                                                    var list = document.getElementById("userdiv"+ con.metadata.id);
                                                    if(list !== "undifened" || list !== null)
                                                    {
                                                        list.remove();
                                                    }
                                                }
                                            });*/
                                        }
                                        connections = temp;
                                        userCount = userCount - 1;
                                        updateCount(userCount);
                                        console.log('Connection destroyed');
                                    });
                                    
                                    conn = dataConn;
                                    
                                    connections.push(dataConn);
                                    console.log(dataConn);
                                    
                                    console.log("connections");
                                    console.log(connections);
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
                                    //conn = null;
                                    //alert("conn closed");
                                    userCount = userCount - 1;
                                    updateCount(userCount);
                                    console.log('Connection destroyed');
                                });
                                peer.on('error', function (err) {
                                    console.log(err);
                                    //alert('' + err);
                                });
                            };
                            function updateCount(c)
                            {
                                
                                audience.innerHTML = c ;
                                
                            }
                            function addNotification(msg)
                            {
                                 msgView.innerHTML = msgView.innerHTML + "<div style='text-align:center;float :right;width: 100%;'>" + msg + "</div>";
                            
                                let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;
                            }
                            function addSentMessage(msg)
                            {
                                
                                msgView.innerHTML = msgView.innerHTML + 
                                                    '<div style="position:releted;left:1px;"><a href="#" style="color:green;font-size:20px;" onclick=""><b><?php echo $_SESSION['name']; ?></b></a> '+ msg +'</div>'; 
                                    
                                let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;    
                                    /*"<div class='d-flex justify-content-start mb-4' style='width:300px'><div class='msg_cotainer' style='max-width: 70%;min-width: 30%;'>" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									*/
									
									
                            }
                            function addSentMessagePrivate(msg)
                            {
                                
                                msgViewPrivate.innerHTML = msgViewPrivate.innerHTML + 
                                                    '<div style="position:releted;left:1px;"><a href="#" style="color:green;font-size:20px;" onclick=""><b><?php echo $_SESSION['name']; ?></b></a> '+ msg +'</div>'; 
                                    
                                let objDiv = document.getElementById("msgViewPrivate");
                                objDiv.scrollTop = objDiv.scrollHeight;    
                                    /*"<div class='d-flex justify-content-start mb-4' style='width:300px'><div class='msg_cotainer' style='max-width: 70%;min-width: 30%;'>" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									*/
									
									
                            }
                            function addRecMessage(name,msg,id)
                            {
                                name.replace(" ", "_");
                                
                                
                                var msgDiv = 
                                   '<div style="position:releted;left:1px;text-align:left;">';
                                if(knighId != id)
                                {
								msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                }
                                else
                                {
                                msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                }
                                msgDiv = msgDiv + msg 
                                +       '<div class="action_menu" id="userOption'+ messageId  + id +'" style="left:1px;background-color:red">'
        						+	        '<ul>'
        						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
        						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
        						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
        						+		        '<li><a onclick="banUser('+id+',\'userOption'+ messageId  + id +'\',\''+name+'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
        						+		        '<li><a onclick="blockUser('+id+',\'userOption'+ messageId  + id +'\',\''+name+'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
        						+	        '</ul>'
        						+       '</div>'
                                +   '</div>';
                                
                                msgView.innerHTML = msgView.innerHTML + msgDiv;
								let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;	
                                messageId += 1;
								/*"<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";*/
                            }
                            function addRecMessagePrivate(name,msg,id)
                            {
                                name.replace(" ", "_");
                                
                                
                                var msgDiv = 
                                   '<div style="position:releted;left:1px;text-align:left;">';
                                if(knighId != id)
                                {
								msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                }
                                else
                                {
                                msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                }
                                msgDiv = msgDiv + msg 
                                +       '<div class="action_menu" id="userOption'+ messageId  + id +'" style="left:1px;background-color:red">'
        						+	        '<ul>'
        						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
        						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
        						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
        						+		        '<li><a onclick="banUser('+id+',\'userOption'+ messageId  + id +'\',\''+name+'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
        						+		        '<li><a onclick="blockUser('+id+',\'userOption'+ messageId  + id +'\',\''+name+'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
        						+	        '</ul>'
        						+       '</div>'
                                +   '</div>';
                                
                                msgViewPrivate.innerHTML = msgViewPrivate.innerHTML + msgDiv;
								let objDiv = document.getElementById("msgViewPrivate");
                                objDiv.scrollTop = objDiv.scrollHeight;	
                                messageId += 1;
								/*"<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";*/
                            }
                            stop.addEventListener('click', function (e) {
                                closeSession();
                            });
                            start.addEventListener('click', function (e) {
                                startSession();
                            });
                            stopPrivate.addEventListener('click', function (e) {
                                stopPrivateSe();
                            });
                            sendMessagePrivate.addEventListener('click', function (e) {
                                //conn.send(messageBox.value);
                                //alert(roomUsers.private);
                                connections.forEach(function (con, index)
                                {
                                    if(con.open && con.metadata.id == roomUsers.private)
                                    {
                                        con.send({name:"<?php echo $_SESSION['name'] ?>" , message:privateMessageBox.value,type:"privateMessage"});
                                    }
                                });
                                addSentMessagePrivate(privateMessageBox.value);
                                privateMessageBox.value = "";
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
                            
                            initialize();
                        })();
                    </script>
				
				</p>
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
    <script>
        function viewOptions(userOption,id)
        {
            //alert(userOption);
            $('#' + userOption).toggle();
        }
        	/*$(document).ready(function(){
$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});
	});*/
    </script>
</body>
</html>