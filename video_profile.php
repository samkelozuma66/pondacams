<?php 
include 'config.php';
if(isset($_GET['id'])){
$model = $conn->getRow('users',['id'=>$_GET['id']]);
$rule = $conn->getRow('rule',['rule_type'=>'message']);
$session = $conn->getRow('session',['model'=>$_GET['id']]);
$pic = $conn->getRow('modelpictures',['model_id'=>$_GET['id']]);
$pvideos = $conn->getRow('modelvideo',['mode_id'=>$_GET['id']]);
$modelinfo = $conn->getRow('modelinfo',['model_id'=>$_GET['id']]);
$favorites = $conn->getRow('favorites',['member'=>$_SESSION['id'],"model" => $_GET['id']]);

$preference = $conn->getRow('preference',['model_id'=>$_GET['id']]);

$country = $conn->getRow("country",["code"=>$modelinfo[0]["country_code"]]);
$gift = $conn->getRow("gift",["id" => 1]);
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
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon1.png"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/metisMenu.min.css" rel="stylesheet">	
    <script src="https://use.fontawesome.com/0f43fe6a33.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
	
	
    <script>
        $(function(){
            $("#addClass").click(function () {
                      $('#qnimate').addClass('popup-box-on');
                        });
                      
                        $("#removeClass").click(function () {
                      $('#qnimate').removeClass('popup-box-on');
                        });
              })
        function sendTokenOffline()
        {
            var sessionName ="<?php echo $_SESSION['name'] ?>";
            if(sessionName == "")
            {
                Swal.fire('Login To TIP');
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
                      
                      
                  }
                });
              
            }
        }
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
                        <?php if(isset($_SESSION['name'])){ 
                             $chatusers = $conn -> getRow('chatusers', ['id' => $_SESSION['id']]);
                        
                        ?>
						<li class="icons dn"><a href="javascript:void(0)"><?php echo $chatusers[0]['money']; ?> Tokens</a></li> 
						<li class="icons dn"><a href="javascript:void(0)" class="joinbtn" data-toggle="modal" data-target="#buytokkens">Buy Tokens</a></li>
						<?php } ?>
						
						<?php if(isset($_SESSION['name'])){ ?>
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown" style="position: relative; top: 0px;">
                                <span><i class="fa fa-heart" aria-hidden="true"></i></span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu" style="z-size:1000">
                                <div class="dropdown-content-body" >
                                    <ul>
                                        <?php 
                                        
                                            $fav = $conn -> getRow("favorites",["member" => $_SESSION['id']]);
                                            foreach($fav as $ind => $row)
                                            {
                                                $usr = $conn -> getRow("users",["id" => $row['model']]);
                                                echo '<li>
                                                <div class="story-thumb" data-toggle="tooltip" title="" data-original-title="">
									                <a href="">
									                    <img src="documents/'.$usr[0]['selfie'].'" alt=""/>
									                </a>
									                <a href="./video_profile.php?id='.$row['model'].'">'.$usr[0]['name'].'</a>
									           	</div>
									           	<<br />
									           	<<br />
									           	</li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <?php }?>
						<li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user" onclick="showM()" style="position: relative; top: 0px;">
                                <span>Escape</span>  
                            </a>
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
					    
					    <div id="conDiv" >
					        
    						<div class="videoWrapper" width="600" id="videoWrapperId" style="background-color:black">
    							<!-- Copy & Pasted from YouTube -->
    							
    							<?php //if(isset($session[0]['stream'])){ ?>
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
                                <script>
                                
                                    function stopSpyShow()
                                    {
                                        var stopSpy =document.getElementById("stopSpy");
                                        stopSpy.hidden = true;
                                        datacon.send({name:"stop" , type:"spy",chatuser_id:"<?php echo $_SESSION['id']; ?>",username:"<?php echo $_SESSION['name']; ?>"});
                                        var privateHide = document.getElementById("privateHide");
                                        //privateTab
                                        privateHide.style.display = "block";
                                        var privateShow = document.getElementById("privateShow");
                                        privateShow.hidden = false;
                                    }
                                    function stopPrivateSe()
                                    {
                                        datacon.send({name:"stop" , type:"private",chatuser_id:"<?php echo $_SESSION['id']; ?>",username:"<?php echo $_SESSION['name']; ?>"});
                                        var privateShow = document.getElementById("privateShow");
                                        privateShow.hidden = false;
                                        var stopPrivate = document.getElementById("stopPrivate");
                                        stopPrivate.hidden = true;
                                        var stopSpy =document.getElementById("stopSpy");
                                        stopSpy.hidden = true;
                                    }
                                    function startPrivateShow()
                                    {
                                        //$preference
                                        
                                    <?php 
                                        if(isset($preference[0]) && isset($_SESSION['id']))
                                        {
                                    ?>
                                        
                                        var privateToken = <?php echo $preference[0]['private'] ; ?> ;
                                        Swal.fire(privateToken + ' TOKENS per min to start private show');
                                        // message:"<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens "
                                        datacon.send({name:"request" , type:"private",chatuser_id:"<?php echo $_SESSION['id']; ?>",username:"<?php echo $_SESSION['name']; ?>"});
                                          
                                        //console.log(conn);
                                    <?php
                                        }else {
                                    ?>
                                        Swal.fire('Log in to start private show');
                                    <?php
                                        }
                                    ?>
                                    }
                                    function startSpyShow()
                                    {
                                        //$preference
                                    <?php 
                                        if(isset($preference[0]) && isset($_SESSION['id']))
                                        {
                                    ?>
                                        var privateToken = <?php echo $preference[0]['spy'] ; ?> ;
                                        Swal.fire(privateToken + ' TOKENS per min to spy on a show');
                                        // message:"<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens "
                                        datacon.send({name:"request" , type:"spy",chatuser_id:"<?php echo $_SESSION['id']; ?>",username:"<?php echo $_SESSION['name']; ?>"});
                                          
                                        //console.log(conn);
                                    <?php
                                        }else {
                                    ?>
                                        Swal.fire('Log in to start private show');
                                    <?php
                                        }
                                    ?>
                                    }
                                    function unMute()
                                    {
                                        //<i class="fas fa-volume-up"></i> 
                                        var video = document.querySelector('video');
                                        var volumeId = document.getElementById("volumeId");
                                        if(video.muted != false)
                                        {
                                            volumeId.className = "fas fa-volume-mute ";
                                            video.muted = false;
                                        }
                                        else
                                        {
                                            volumeId.className = "fas fa-volume-up ";
                                            video.muted = true;
                                        }
                                        
                                    }
                                    //#fc0 leaveSurprise
                                    function hoverSurprise(id)
                                    {
                                        //alert("rose");
                                        var item = document.getElementById(id);
                                        
                                        item.style.backgroundImage = "radial-gradient(white, rgba(255, 255, 255, .1))" ;
                                    }
                                    function leaveSurprise(id)
                                    {
                                        //alert("rose");
                                        var item = document.getElementById(id);
                                        
                                        item.style.backgroundImage = "" ;
                                    }
                                </script>
                                
                                <style>
                                    #privateHide {
                                        z-index: 3;
                                        display: none;
                                        position: absolute;
                                        text-align:center;
                                        color:white;
                                        background:black;
                                        opacity: 1;
                                        background-image:url("./documents/<?php if(isset($model)){echo $model[0]['selfie'];}?>");
                                        background-size: 100% 100%;
                                    }
                                    #camVideo {
                                        z-index: 2;
                                        display: block;
                                        position: absolute;
                                        bottom:60px;
                                        right:30%;
                                        text-align:center;
                                        color:white;
                                        width:20%;
                                    }
                                    #gameDiv {
                                        z-index: 3;
                                        display: block;
                                        position: absolute;
                                        text-align:center;
                                        color:white;
                                        opacity: 1;
                                    }
                                    #innerHide {
                                        margin: 25%;
                                        padding-top:1%;
                                      width: 50%;
                                      background-color:rgba(0,0,0,.6);
                                      height:20%;
                                      border-radius:10px;
                                     
                                    }
                                    .msg_card_body{
                            			overflow-y: auto;
                            		}
                            		.flower
                            		{
                            		    background-image: url("images/flower.png");
                            		    background-size: 50px;
                                        width:50px;
                                        height:50px;
                                        margin-bottom:15px;
                            		    
                            		}
                            		.shoes
                            		{
                            		    background-image: url("images/high-heel-shoes.svg");
                            		    background-size: 45px;
                                        background-repeat:no-repeat;
                                        width:50px;
                                        height:50px;
                                        margin-bottom:15px;
                            		    
                            		}
                            		.love
                            		{
                            		    background-image: url("images/ilove_u.png");
                            		    background-size: 50px;
                                        background-repeat:no-repeat;
                                        width:50px;
                                        height:50px;
                                        margin-bottom:15px;
                            		    
                            		}
                            		.cocktail
                            		{
                            		    background-image: url("images/pink_cocktail.png");
                            		    background-size: 50px;
                                        background-repeat:no-repeat;
                                        
                                        width:50px;
                                        height:50px;
                                        margin-bottom:15px;
                            		    
                            		}
                            		.tooltiptext {
                                        visibility: hidden;
                                        width: 120px;
                                        background-color: black;
                                        color: #fff;
                                        text-align: center;
                                        padding: 5px 0;
                                        border-radius: 6px;
                                        line-height:15px;
                                        /* Position the tooltip text - see examples below! */
                                        position: absolute;
                                        top:-50px;
                                        z-index: 1;
                                    }
                                    .favtiptext {
                                        visibility: hidden;
                                        width: 120px;
                                        background-color: black;
                                        color: #fff;
                                        text-align: center;
                                        padding: 5px 0;
                                        border-radius: 6px;
                                        line-height:15px;
                                        /* Position the tooltip text - see examples below! */
                                        position: absolute;
                                        left:60px;
                                        z-index: 1;
                                    }
                                    .favtiptextR {
                                        visibility: hidden;
                                        width: 120px;
                                        background-color: black;
                                        color: #fff;
                                        text-align: center;
                                        padding: 5px 0;
                                        border-radius: 6px;
                                        line-height:15px;
                                        /* Position the tooltip text - see examples below! */
                                        position: absolute;
                                        right:60px;
                                        z-index: 1;
                                    }
                                    #flower:hover .tooltiptext {
                                      visibility: visible;
                                    }
                                    
                                    
                                    #shoes:hover .tooltiptext {
                                      visibility: visible;
                                    }
                                    
                                    #cocktail:hover .tooltiptext {
                                      visibility: visible;
                                    }
                                    
                                    #love:hover .tooltiptext {
                                      visibility: visible;
                                    }
                                    
                                    .fav-thumb {
                                        left: 6px;
                                        position: absolute;
                                        top: 60px;
                                        z-index: 1;
                                    }
                                    .buy-thumb {
                                        left: 1px;
                                        position: absolute;
                                        top: 140px;
                                        z-index: 1;
                                    }
                                    .private-thumb {
                                        left: 6px;
                                        position: absolute;
                                        top: 100px;
                                        z-index: 1;
                                    }
                                    
                                    .game-thumb {
                                        left: 6px;
                                        position: absolute;
                                        bottom: 10px;
                                        z-index: 1;
                                    }
                                    .volume-thumb {
                                        left: 6px;
                                        position: absolute;
                                        bottom: 50px;
                                        z-index: 1;
                                    }
                                    .full-thumb {
                                        left: 6px;
                                        position: absolute;
                                        bottom: 10px;
                                        z-index: 1;
                                    }
                                    .shoes-thumb {
                                        right: 6px;
                                        position: absolute;
                                        bottom: 10px;
                                        z-index: 1;
                                    }
                                    .heart-thumb {
                                        right: 6px;
                                        position: absolute;
                                        bottom: 85px;
                                        z-index: 1;
                                    }
                                    .cocktail-thumb {
                                        right: 6px;
                                        position: absolute;
                                        bottom: 160px;
                                        z-index: 1;
                                    }
                                    .flower-thumb {
                                        right: 6px;
                                        position: absolute;
                                        bottom: 235px;
                                        z-index: 1;
                                    }
                                    .send-thumb {
                                        right: 6px;
                                        position: absolute;
                                        top: 1px;
                                        z-index: 1;
                                    }
                                    
                                    .fav-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    .buy-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    .private-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    .game-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    .volume-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    .full-thumb:hover .favtiptext {
                                      visibility: visible;
                                    }
                                    
                                    .shoes-thumb:hover .favtiptextR {
                                      visibility: visible;
                                    }
                                    .heart-thumb:hover .favtiptextR {
                                      visibility: visible;
                                    }
                                    .cocktail-thumb:hover .favtiptextR {
                                      visibility: visible;
                                    }
                                    .flower-thumb:hover .favtiptextR {
                                      visibility: visible;
                                    }
                                    
                                    
                                </style>
                                <div id="gameDiv"  >
                                    <!--<input type="button" value="spin" style="float:left;" id='spin' />-->
                                    <div class="story-thumb"  data-toggle="tooltip" title="" data-original-title="" 
                                         style="background-color:rgba(0,0,0,.6);
                                                padding-right:15px;
                                                border-radius:20px;"
                                    >
						                <a href="#">
						                    <img src="documents/<?php echo $model[0]['selfie']; ?>" alt=""/>
						                </a>
						                &nbsp;<p style="display:inline-block;" id="statusModel"><?php if(isset($session[0]['stream'])){ echo "LIVE";}else{ echo "OFFLINE";}?></p>
						           	</div>
						           	<div class="fav-thumb"
						           	     style ="background-color:rgba(0,0,0,.6);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('favA')"
                                         onmouseleave = "leave('favA')"
                                                 >
						           	    <a href="#" onclick="addFavorite()" style="color:#D3D3D3;" id="favA"><i id="fav" class=" <?php if(isset($favorites[0])){echo 'fa fa-heart gradient-4-text'; }else{echo 'far fa-heart gradient-4-text'; }?>"></i></a>
						           	    <span class="favtiptext" style="font-size:12px;">add to favorites</span>
						           	</div>
						           	<div class="buy-thumb"
						           	     style ="
                                                 padding-right:15px;
                                                 padding-left :6px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('buyA')"
                                         onmouseleave = "leave('buyA')"
                                                 >
						           	    <!--<a href="#" onclick="sendToken()" style="color:#D3D3D3;" id="buyA"><i class="fas fa-database"></i></a>
						           	    -->
						           	    <a href="javascript:void(0)" class="sendbtn" onclick="sendToken()" id ="flowerA" style="color:white;width:5%;font-size:15px;"><i class="fas fa-database">&nbsp;</i>TIP</a>
						           	    
						           	    <span class="favtiptext" style="font-size:12px;">Send Tokens</span>
						           	</div>
						           	<div class="private-thumb"
						           	     style ="background-color:rgba(0,0,0,.6);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('priA')"
                                         onmouseleave = "leave('priA')"
                                                 >
						           	    <a href="#" onclick="startPrivateShow()" style="color:#D3D3D3;" id="priA"><i class="fas fa-user-secret"></i></a>
						           	    <span class="favtiptext" style="font-size:12px;">Start Private Show</span>
						           	</div>
						           	
						           	<div class="volume-thumb"
						           	     style ="background-color:rgba(0,0,0,.6);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('volumeA')"
                                         onmouseleave = "leave('volumeA')"
                                                 >
						           	    <a href="#" onclick="unMute()" style="color:#D3D3D3;" id="volumeA"><i class="fas fa-volume-up" id="volumeId"></i></a>
                                        <span class="favtiptext" style="font-size:12px;">Volume</span>
						           	</div>
						           	
						           	<div class="full-thumb"
						           	     style ="background-color:rgba(0,0,0,.6);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('fullA')"
                                         onmouseleave = "leave('fullA')"
                                                 >
						           	    <a href="#" onclick="fullscreen()" style="color:#D3D3D3;" id="fullA"><i class="fas fa-expand"></i></a>
                                        <span class="favtiptext" style="font-size:12px;">Full Screen</span>
						           	</div>
						           	
						           	<!--<div class="game-thumb"
						           	     style ="background-color:rgba(0,0,0,.6);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('gameA')"
                                         onmouseleave = "leave('gameA')"
                                                 >
						           	    <a href="#" onclick="spin()" style="color:#D3D3D3;" id="gameA"><i class="fas fa-gamepad"></i></a>
                                        <span class="favtiptext" style="font-size:12px;">Play game</span>
						           	</div>-->
						           	
						           	<div class="shoes-thumb"
						           	     style ="background-color:rgba(0,0,0,.4);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 padding-top :5px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('shoesA')"
                                         onmouseleave = "leave('shoesA')"
                                                 >
						           	    <span class="favtiptextR" style="font-size:12px;">Send a Surprise
						           	        <br />
						           	        <small style="color:gold;">
						           	            <b><?php echo $gift[0]['shoes'];    ?> Tokens
						           	            </b>
						           	        </small>
						           	    </span>
						           	    <a href="#" onclick="sendGift('shoes'   ,<?php echo $gift[0]['shoes'];    ?>)" id ="shoesA"   >
    						           	    <div class="shoes"   >
    						           	    
    						           	    </div>
						           	    </a>
						           	</div>
						           	<div class="heart-thumb"
						           	     style ="background-color:rgba(0,0,0,.4);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 padding-top :5px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('heartA')"
                                         onmouseleave = "leave('heartA')"
                                                 >
						           	    <span class="favtiptextR" style="font-size:12px;">Send a Surprise
						           	        <br />
						           	        <small style="color:gold;">
						           	            <b><?php echo $gift[0]['heart'];    ?> Tokens
						           	            </b>
						           	        </small>
						           	    </span>
						           	    <a href="#" onclick="sendGift('heart'   ,<?php echo $gift[0]['heart'];    ?>)" id ="heartA"   >
    						           	    <div class="love"   >
    						           	    
    						           	    </div>
						           	    </a>
						           	</div>
						           	<div class="cocktail-thumb"
						           	     style ="background-color:rgba(0,0,0,.4);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 padding-top :5px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('cocktailA')"
                                         onmouseleave = "leave('cocktailA')"
                                                 >
						           	    <span class="favtiptextR" style="font-size:12px;">Send a Surprise
						           	        <br />
						           	        <small style="color:gold;">
						           	            <b><?php echo $gift[0]['cocktail'];    ?> Tokens
						           	            </b>
						           	        </small>
						           	    </span>
						           	    <a href="#" onclick="sendGift('cocktail'   ,<?php echo $gift[0]['cocktail'];    ?>)" id ="cocktailA"   >
    						           	    <div class="cocktail"   >
    						           	    
    						           	    </div>
						           	    </a>
						           	</div>
						           	<div class="flower-thumb"
						           	     style ="background-color:rgba(0,0,0,.4);
                                                 padding-right:15px;
                                                 padding-left :15px;
                                                 padding-top :5px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('flowerA')"
                                         onmouseleave = "leave('flowerA')"
                                                 >
						           	    <span class="favtiptextR" style="font-size:12px;">Send a Surprise
						           	        <br />
						           	        <small style="color:gold;">
						           	            <b><?php echo $gift[0]['flower'];    ?> Tokens
						           	            </b>
						           	        </small>
						           	    </span>
						           	    <a href="#" onclick="sendGift('flower'   ,<?php echo $gift[0]['flower'];    ?>)" id ="flowerA"   >
    						           	    <div class="flower"   >
    						           	    
    						           	    </div>
						           	    </a>
						           	</div>
						           	<div class="send-thumb"
						           	     style ="padding-right:15px;
                                                 padding-left :15px;
                                                 padding-top :5px;
                                                 border-radius:10px;
                                                 display:block;
                                                 font-size:25px;" 
                                         onmouseover= "hover('flowerA')"
                                         onmouseleave = "leave('flowerA')"
                                                 >
						           	    <span class="favtiptextR" style="font-size:12px;">TIP
						           	        <br />
						           	        <small style="color:gold;">
						           	            <b><?php echo $gift[0]['flower'];    ?> Tokens
						           	            </b>
						           	        </small>
						           	    </span>
						           	    <a href="javascript:void(0)" class="joinbtn"  onclick="stopPrivateSe()"   id="stopPrivate"  style="color:white;width:5%;font-size:15px;" hidden>STOP PRIVATE SHOW</a>
						           	    <a href="javascript:void(0)" class="joinbtn"  onclick="stopSpyShow()"       id="stopSpy"      style="color:white;width:5%;font-size:15px;" hidden>STOP SPY SHOW</a>
						           	    <a href="javascript:void(0)" class="joinbtn"  onclick="startPrivateShow()"  id="privateShow"  style="color:white;width:5%;font-size:15px;">START PRIVATE SHOW</a>
						           	    <!--<a href="javascript:void(0)" class="sendbtn"  onclick="sendToken()"         id ="flowerA"     style="color:white;width:5%;font-size:15px;"><i class="fas fa-database">&nbsp;</i>TIP</a>
						           	    -->
						           	</div>
						           	
						           	<canvas id="canvas" ></canvas>
                                    
                                </div>
                                <script>
                                    function addGift(type)
                                    {
                                        var gift = "";
                                        var public_ = document.getElementById("msgView");
                                        if(type == "flower")
                                        {
                                            gift = "images/flower.png";
                                        }
                                        else if(type == "love")
                                        {
                                            gift = "images/ilove_u.png";
                                        }
                                        else if(type == "cocktail")
                                        {
                                            gift = "images/pink_cocktail.png";
                                        }
                                        else if(type == "shoes")
                                        {
                                            gift = "images/high-heel-shoes.svg";
                                        }
                                        public_.innerHTML = public_.innerHTML 
                                            + '<div class="' + type + '"   ></div>';
                                    }
                                </script>
                                <script>
                                
                                    //WHEEL \
                                    //var options = ["$100", "$10", "$25", "$250", "$30", "$1000", "$1", "$200", "$45", "$500", "$5", "$20", "Lose", "$1000000", "Lose", "$350", "$5", "$99"];
                                    var options = ["better luck next time" ,"free 5 min Private","better luck next time", "dance","better luck next time","Strip show","better luck next time","Flash my Goodies"];
                                    var startAngle = 0;
                                    var arc = Math.PI / (options.length / 2);
                                    var spinTimeout = null;
                                    
                                    var spinArcStart = 10;
                                    var spinTime = 0;
                                    var spinTimeTotal = 0;
                                    
                                    var ctx;
                                    
                                    //document.getElementById("spin").addEventListener("click", spin);
                                    
                                    function byte2Hex(n) {
                                      var nybHexString = "0123456789ABCDEF";
                                      return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
                                    }
                                    
                                    function RGB2Color(r,g,b) {
                                    	return '#' + byte2Hex(r) + byte2Hex(g) + byte2Hex(b);
                                    }
                                    
                                    function getColor(item, maxitem) {
                                      var phase = 0;
                                      var center = 128;
                                      var width = 127;
                                      var frequency = Math.PI*2/maxitem;
                                      
                                      red   = Math.sin(frequency*item+2+phase) * width + center;
                                      green = Math.sin(frequency*item+0+phase) * width + center;
                                      blue  = Math.sin(frequency*item+4+phase) * width + center;
                                      
                                      return RGB2Color(red,green,blue);
                                    }
                                    
                                    function drawRouletteWheel() {
                                      var canvas = document.getElementById("canvas");
                                      if (canvas.getContext) {
                                          
                                          //alert(canvas.offsetWidth );
                                        var outsideRadius = Math.round(canvas.offsetWidth/4);
                                        var textRadius = Math.round(outsideRadius * .7);
                                        var insideRadius = Math.round(textRadius * .8);
                                    
                                        ctx = canvas.getContext("2d");
                                        ctx.clearRect(0,0,500,500);
                                    
                                        ctx.strokeStyle = "black";
                                        ctx.lineWidth = 2;
                                    
                                        ctx.font = 'bold 12px Helvetica, Arial';
                                    
                                        for(var i = 0; i < options.length; i++) {
                                          var angle = startAngle + i * arc;
                                          //ctx.fillStyle = colors[i];
                                          ctx.fillStyle = getColor(i, options.length);
                                    
                                          ctx.beginPath();
                                          ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
                                          ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
                                          ctx.stroke();
                                          ctx.fill();
                                    
                                          ctx.save();
                                          ctx.shadowOffsetX = -1;
                                          ctx.shadowOffsetY = -1;
                                          ctx.shadowBlur    = 0;
                                          ctx.shadowColor   = "rgb(220,220,220)";
                                          ctx.fillStyle = "black";
                                          ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius, 
                                                        250 + Math.sin(angle + arc / 2) * textRadius);
                                          ctx.rotate(angle + arc / 2 + Math.PI / 2);
                                          var text = options[i];
                                          ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                                          ctx.restore();
                                        } 
                                    
                                        //Arrow
                                        ctx.fillStyle = "black";
                                        ctx.beginPath();
                                        ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
                                        ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
                                        ctx.lineTo(250 + 4, 250 - (outsideRadius - 5));
                                        ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
                                        ctx.lineTo(250 + 0, 250 - (outsideRadius - 13));
                                        ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
                                        ctx.lineTo(250 - 4, 250 - (outsideRadius - 5));
                                        ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
                                        ctx.fill();
                                      }
                                    }
                                    
                                    function spin() {
                                      spinAngleStart = Math.random() * 10 + 10;
                                      spinTime = 0;
                                      spinTimeTotal = Math.random() * 3 + 4 * 1000;
                                      rotateWheel();
                                    }
                                    
                                    function rotateWheel() {
                                      spinTime += 30;
                                      if(spinTime >= spinTimeTotal) {
                                        stopRotateWheel();
                                        return;
                                      }
                                      var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
                                      startAngle += (spinAngle * Math.PI / 180);
                                      drawRouletteWheel();
                                      spinTimeout = setTimeout('rotateWheel()', 30);
                                    }
                                    
                                    function stopRotateWheel() {
                                      clearTimeout(spinTimeout);
                                      var degrees = startAngle * 180 / Math.PI + 90;
                                      var arcd = arc * 180 / Math.PI;
                                      var index = Math.floor((360 - degrees % 360) / arcd);
                                      ctx.save();
                                      ctx.font = 'bold 30px Helvetica, Arial';
                                      var text = options[index]
                                      ctx.fillText(text, 250 - ctx.measureText(text).width / 2, 250 + 10);
                                      ctx.restore();
                                    }
                                    
                                    function easeOut(t, b, c, d) {
                                      var ts = (t/=d)*t;
                                      var tc = ts*t;
                                      return b+c*(tc + -3*ts + 3*t);
                                    }
                                    
                                    drawRouletteWheel();
                                </script>
                                <div id="privateHide">
                                    <div id="innerHide">
                                        <h1 align="center" style="color:white;">I'm in a Private Show</h1>
                                        <a href="javascript:void(0)" class="joinbtn" id="privateShow" onclick="startSpyShow()" style="color:white;">TAKE A SNEAK</a>
                                    </div>
                                </div>
                                
    							<video  id="videoPlayer" 
    							        width="65%" 
    							        poster="./documents/<?php if(isset($model)){echo $model[0]['selfie'];}?>" 
    							        height="auto" 
    							        src="<?php if(isset($model) && $model[0]['model_video'] != ''){ echo 'model_video/'.$model[0]['model_video'];}else{ echo "https://www.youtube.com/embed/5qky3L2Q6G4";} ?>" 
    							        title="Stream" 
    							        frameborder="0" 
    							        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    							        allowfullscreen  
    							        style="max-height : 600;object-fit: fill;" 
    							        autoplay 
    							        loop
    							        muted>
    							    <div> HELLO  VIDEO</div>
    							</video>
    							<div id="camVideo">
                                    <video  id="videoPlayer2" width="100%" src="" title="Stream" style="object-fit: fill;"  > </video>
                                </div>
    							<div id="videoControl" width="35%"  style ="border-style: none; border-radius: 7px;display:none;">
    							    <!--<div style="display:inline-block;font-size:250%;text-align:left;margin-left:15px" id="">
    							        <a href="javascript:void(0)" class="longin" onclick="spin()" style="border-radius:30px;" onmouseover="hoverSurprise('game')"   onmouseleave="leaveSurprise('game')"   id ="game"  ><i class="fas fa-gamepad"></i></a>
    							        <span class="tooltiptext">Play Game<br /><small style="color:gold;"><b>20 Tokens</b></small></span>
    							    </div>-->
    							     <div class="header-right">
        							     <ul class="clearfix" style="width:100%">
        							         <li class="icons dn"><a href="javascript:void(0)" class="longin" style="border-radius:30px;" onmouseover="hoverSurprise('flower')"   onmouseleave="leaveSurprise('flower')"   onclick="sendGift('flower'  ,<?php echo $gift[0]['flower'];   ?>)" id ="flower"  ><div class="flower"  ></div><span class="tooltiptext">Send a Surprise<br /><small style="color:gold;"><b><?php echo $gift[0]['flower'];   ?>  Tokens</b></small></span></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="longin" style="border-radius:30px;" onmouseover="hoverSurprise('cocktail')" onmouseleave="leaveSurprise('cocktail')" onclick="sendGift('cocktail',<?php echo $gift[0]['cocktail']; ?>)" id ="cocktail"><div class="cocktail"></div><span class="tooltiptext">Send a Surprise<br /><small style="color:gold;"><b><?php echo $gift[0]['cocktail']; ?> Tokens</b></small></span></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="longin" style="border-radius:30px;" onmouseover="hoverSurprise('love')"     onmouseleave="leaveSurprise('love')"     onclick="sendGift('heart'   ,<?php echo $gift[0]['heart'];    ?>)" id ="love"    ><div class="love"    ></div><span class="tooltiptext">Send a Surprise<br /><small style="color:gold;"><b><?php echo $gift[0]['heart'];    ?> Tokens</b></small></span></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="longin" style="border-radius:30px;" onmouseover="hoverSurprise('shoes')"    onmouseleave="leaveSurprise('shoes')"    onclick="sendGift('shoes'   ,<?php echo $gift[0]['shoes'];    ?>)" id ="shoes"   ><div class="shoes"   ></div><span class="tooltiptext">Send a Surprise<br /><small style="color:gold;"><b><?php echo $gift[0]['shoes'];    ?> Tokens</b></small></span></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="longin" ><i class="fas fa-gift"></i></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" onclick="unMute()"><i class="fas fa-volume-up" id="volumeId"  style="font-size:25px;"></i></a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="joinbtn" id="privateShow" onclick="startPrivateShow()">START PRIVATE SHOW</a></li>
        							         <li class="icons dn"><a href="javascript:void(0)" class="sendbtn" onclick="sendToken()"><i class="fas fa-database">&nbsp;</i>SEND TIP</a></li>
        							         
        							     </ul>
        							 </div>
    							    
    							    
    							    
    							</div>
    							<div id="chatControl"  width="35%" style="">
    							    <div class="tab" id="tab" style="display:block;background:hsla(0, 100%, 40%, 1);border-style: none;margin-left:-19px;padding-left:10px;">
                                        <button class="tablinks active" onclick="openCity(event, 'public')" id="publicTab" style="display:inline-block;font-size:15px;height:inherit;">PUBLIC&nbsp;<p  style="display:inline-block;"> </p></button>
                                        <button class="tablinks" onclick="openCity(event, 'private')" id="privateTab" style="font-size:15px;">PRIVATE&nbsp;<p style="display:inline-block;"> </p></button>
                                        <button class="tablinks" onclick="openCity(event, 'users')" style="display:inline-block;font-size:15px;">USERS&nbsp;<p id="audience" style="display:inline-block;background-color:white;border-radius:10px;width:20px;color:black;">0</p></button>
                                        
                                    </div>
                                        
                		            <div id="public" class="tabcontent" style="display:block;">
                                        <div class="card-body msg_card_body" id="msgView" style="background-color:black;color:white;">
                                            
                						</div>
                						<div style="color:white;" id="chatFooter">
                						    <div class="" style="background-color:#C0C0C0;color:white;height:50px;border-radius:30px; padding-left:10px;">
                    						    <input type="text" id="messageBox" placeholder="Type..." name="" class="" style="background-color:#C0C0C0;height:50px;width:90%;border:none;border-radius:30px" >&nbsp;<a href="#" style="font-size:20px;" id="sendMessage" onclick="sendMsg()"><i class="fas fa-paper-plane"></i></a>
                    						</div>
                						    
                						</div>
                						
                                    </div>
                                    <script>
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
                                        <div class="card-body msg_card_body" id="privateView" style="background-color:black;color:white;">
                                            
                						</div>
                						<div style="background-color:black;color:white;" id="chatFooterPrivate">
                						    <div class="" style="background-color:#C0C0C0;color:white;height:50px;border-radius:30px; padding-left:10px;">
                    						    <input type="text" id="messageBoxPrivate" placeholder="Type..." name="" class="" style="background-color:#C0C0C0;height:50px;width:90%;border:none;border-radius:30px" >
                    						    <a href="#" style="font-size:20px;" id="sendMessagePrivate" onclick="sendMsgPrivate()" ><i class="fas fa-paper-plane"></i></a>
                    						</div>
                						    
                						</div>
                                    </div>
                                    <script>
                                        var messageBoxPrivate = document.getElementById("messageBoxPrivate");
                                        
                                        messageBoxPrivate.addEventListener("keyup", function(event) 
                                        {
                                          if (event.keyCode === 13) 
                                          {
                                            event.preventDefault();
                                            document.getElementById("sendMessagePrivate").click();
                                          }
                                        });
                                    </script>
                                    <div id="users" class="tabcontent">
                                        <div class="card-body msg_card_body" id="userView"  style="background-color:black;color:white;height:400px">
                                            
                						</div>
                                    </div>
                                    
                		            <script>
                		                var knighId = "";
                		                function banUser(id,userOption)
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
                                                        alert(response);
                                                        /*if(start.hidden)
                                                         {
                                                            start.hidden    = false;
                                                            stop.hidden     = true;
                                                             
                                                         }
                                                         else
                                                         {
                                                            start.hidden    = true;
                                                            stop.hidden     = false;
                                                         }*/
                                                    });
                                            $('#' + userOption).toggle();
                                        }
                                        function knight(id,name,userOption)
                                        {
                                            knighId = id;
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
                
                		                function blockUser(id,userOption)
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
                                                        alert(response);
                                                        /*if(start.hidden)
                                                         {
                                                            start.hidden    = false;
                                                            stop.hidden     = true;
                                                             
                                                         }
                                                         else
                                                         {
                                                            start.hidden    = true;
                                                            stop.hidden     = false;
                                                         }*/
                                                    });
                                                    
                                            $('#' + userOption).toggle();
                                            
                                        }
                                        function addUserTab(name,id)
                                            {
                                                //name.replace(" ", "_");
                                                //alert(name + " JOined");
                                                var msgView1 = document.getElementById("userView");
                                                var msgDiv = 
                                                   '<div style="position:releted;left:1px;text-align:left;" id="userdiv'+id+'">';
                                                if(knightId != id)
                                                {
                								    msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                                }
                                                else
                                                {
                                                    msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                                }
                                                
                                                msgDiv = msgDiv 
                                                +       '<div class="action_menu" id="userOption'+ id +'" style="right:1px;">'
                        						+	        '<ul>'
                        						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
                        						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+  id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
                        						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
                        						+		        '<li><a onclick="banUser('+id+',\'userOption'+  id +'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
                        						+		        '<li><a onclick="blockUser('+id+',\'userOption'+  id +'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
                        						+	        '</ul>'
                        						+       '</div>';
                                                
                        						
                                                msgDiv = msgDiv +   '</div>';
                                                //alert(msgDiv);
                                                msgView1.innerHTML = msgView1.innerHTML + msgDiv;
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
                                        function sendGift(name,amount)
                                        {
                                            var sessionName ="<?php echo $_SESSION['name'] ?>";
                                            if(sessionName == "")
                                            {
                                                Swal.fire('Login to send gifts');
                                            }
                                            else
                                            {
                                                return fetch('//pondacams.com/sendTokkens.php?tokkens='+amount+'&id=<?php echo $_SESSION['id'] ?>&model_id=<?php echo $model[0]["id"] ;?>')
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
                                                       addGift(name);
                                                       addNotification1("You sent a " + name);
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
                                                Swal.fire(
                                                  `Request failed: ${error.message}`
                                                )
                                              });
                                            }
                                        }
                                        function hover(id)
                                        {
                                            var item = document.getElementById(id);
                                            item.style.color = "white";
                                        }
                                        function leave(id)
                                        {
                                            var item = document.getElementById(id);
                                            item.style.color = "#D3D3D3";
                                        }
                                        function fullscreen()
                                        {
                                            var videoPlayer = document.getElementById("videoPlayer");
                                            videoPlayer.requestFullscreen();
                                        }
                                        function addGift(type)
                                        {
                                            var gift = "";
                                            var public_ = document.getElementById("msgView");
                                            if(type == "flower")
                                            {
                                                gift = "images/flower.png";
                                            }
                                            else if(type == "heart")
                                            {
                                                gift = "images/ilove_u.png";
                                                type = "love";
                                            }
                                            else if(type == "cocktail")
                                            {
                                                gift = "images/pink_cocktail.png";
                                            }
                                            else if(type == "shoes")
                                            {
                                                gift = "images/high-heel-shoes.svg";
                                            }
                                            
                                            public_.innerHTML = public_.innerHTML 
                                                + '<div class="' + type + '"   ></div>' ;
                                        }
                    					
                                    </script>
                                    
    							    <!--<div class="tab" id="tab">
                                      <button class="tablinks" onclick="openCity(event, 'public')">PUBLIC</button>
                                      <button class="tablinks" onclick="openCity(event, 'private')" id="privateTab">PRIVATE</button>
                                      <button class="tablinks" onclick="openCity(event, 'users')">USERS</button>
                                    </div>
                                    
                                    <div id="public" class="tabcontent" >
                                        
                                        <div class="" id="qnimatet">
                                            <div class="popup-messages">
                                            	<div class="direct-chat-messages" id="msgView">
                                                        
                                            			
                                                
                                                </div>
                                                <script>
                                                    
                                                </script>
                                        	</div>
                                        	<div class="popup-messages-footer" id="chatFooter">
                                            	<textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
                                            	<div class="btn-footer">
                                            	<button id"sendTokens" onclick="sendToken()" class="bg_none"><i class="glyphicon glyphicon-usd"></i> </button>
                                            	<button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
                                                <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
                                            	<button id"sendMessage" onclick="sendMsg()" class="bg_none pull-right"><i class="glyphicon glyphicon-send"></i> </button>
                                            	</div>
                                        	</div>
                                        </div>
                                      
                                      
                                    </div>
                                    
                                    <div id="private" class="tabcontent">
                                      <h3>PRIVATE</h3>
                                      <div>
                                          <a href="#" >cam to cam </a>
                                      </div>
                                    </div>
                                    
                                    <div id="users" class="tabcontent">
                                      <h3>USERS</h3>
                                      <p>Tokyo is the capital of Japan.</p>
                                    </div>-->
    							</div>
    							<script>
    							
                                    <?php 
                                    if(isset($session[0]))
                                    {
                                        if($session[0]['session_type'] == 'private' && $session[0]['chatuser_id'] != $_SESSION['id'])
                                        {
                                    ?>
                                    var privateHide = document.getElementById("privateHide");
                                    
                                    //privateTab
                                    privateHide.style.display = "block";
                                    <?php
                                    }
                                    else if($session[0]['session_type'] == 'private' && $session[0]['chatuser_id'] == $_SESSION['id'])
                                    {
                                     
                                    ?>
                                    var privateTab = document.getElementById("privateTab");
                                    privateTab.style.display = "block";
                                    <?php } }?>
                                
                                </script>
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
                                      padding: 6px 12px;
                                      border: none;
                                      border-top: none;
                                    }
    							    #privateTab {
    							        display:none;
    							    }
    							    #chatControl {
                                        position: absolute;
                                        right: 0px;
                                        
                                       /* border-style: dotted;*/
                                        cursor: pointer;
                                    }
                                    .action_menu{
                                		z-index: 1;
                                		position: absolute;
                                		padding: 15px 0;
                                		background-color: rgba(0,0,0,0.5);
                                		color: white;
                                		border-radius: 15px;
                                		display: none;
                                	}
                                	.action_menu ul{
                                		list-style: none;
                                		padding: 0;
                                	margin: 0;
                                	}
                                	.action_menu ul li{
                                		width: 100%;
                                		padding: 10px 15px;
                                		margin-bottom: 5px;
                                	}
                                	.action_menu ul li i{
                                		padding-right: 10px;
                                	
                                	}
                                	.action_menu ul li:hover{
                                		cursor: pointer;
                                		background-color: rgba(0,0,0,0.2);
                                	}
    							</style>
    							
    							<script>
    							 
    							    var knightId = "";
        							function openCity(evt, cityName) {
                                          var i, tabcontent, tablinks;
                                          tabcontent = document.getElementsByClassName("tabcontent");
                                          for (i = 0; i < tabcontent.length; i++) {
                                            tabcontent[i].style.display = "none";
                                          }
                                          tablinks = document.getElementsByClassName("tablinks");
                                          for (i = 0; i < tablinks.length; i++) {
                                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                                          }
                                          document.getElementById(cityName).style.display = "block";
                                          evt.currentTarget.className += " active";
                                    }
    							
                                    //alert("data");
                                //new ResizeObserver(outputsize).observe(textbox) videoPlayer
                                    var videoWrapper = document.getElementById("videoWrapperId");
                                    var  width  = 0;
                                    var  height = 0;
                                    var lastHeight = 0;
                                    function outputsize() {
                                        
                                        var chatFooter = document.getElementById("chatFooter");
                                        var chatFooterPrivate = document.getElementById("chatFooterPrivate");
                                        
                                        
                                        var tab = document.getElementById("tab");
                                        var privateHide = document.getElementById("privateHide");
                                        
                                        var videoPlayer = document.getElementById("videoPlayer");
                                        var videoControl = document.getElementById("videoControl");
                                    
                                        var chatControl = document.getElementById("chatControl");
                                        var conDiv = document.getElementById("conDiv");
                                        var canvas = document.getElementById("canvas");
                                    
                                        width  = videoWrapper.offsetWidth;
                                        height = videoWrapper.offsetHeight;
                                        var msgView = document.getElementById("msgView");
                                        var privateView = document.getElementById("privateView");
                                        
                                        var publicT = document.getElementById("public");
                                        var users = document.getElementById("users");
                                        //var users = document.getElementById("users");
                                        //privateView
                                        //alert(width);
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
                                            chatControl.style.height = (height + (height/2) + (height / 4) ) + "px";
                                            chatControl.style.width  = width  + "px";
                                            
                                            videoControl.style.height = videoControlSizeH + "px";
                                            videoControl.style.width  = videoControlSizeW + "px";
                                            
                                            msgView.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 +(height / 4)) + "px";
                                            msgView.style.height    = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 +(height / 4)) + "px";
                                            
                                            privateView.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 +(height / 4)) + "px";
                                            privateView.style.height    = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 +(height / 4)) + "px";
                                            
                                            
                                            //alert ("width "+ videoPlayer.width);
                                            videoPlayer.height = height;
                                            videoPlayer.width  = width ;
                                            //canvas
                                            canvas.height = height ;
                                            canvas.width  = width ;
                                            
                                            privateHide.style.height = height  + "px";
                                            privateHide.style.width  = width + "px";
                                            
                                            conDiv.style.height = (height * 2 +(height / 4)) + "px";
                                        }
                                        else
                                        {
                                            
                                            var videoControlSizeH = Math.round(height * 0.1);
                                            var videoControlSizeW = Math.round(width * 0.64);
                                        
                                            chatControl.style.right   =  "1px";
                                            chatControl.style.top     =  "0px";
                                            
                                            chatControl.style.position = "absolute";
                                            chatControl.style.height = height + "px";
                                            chatControl.style.width  = (width - videoControlSizeW - 20) + "px";
                                            
                                            publicT.style.height = (height - tab.offsetHeight - chatFooter.offsetHeight - 30) + "px";
                                            users.style.height = (height - tab.offsetHeight - chatFooter.offsetHeight - 30) + "px";
                                            
                                            videoControl.style.height = videoControlSizeH + "px";
                                            videoControl.style.width  = videoControlSizeW + "px";
                                            
                                            msgView.style.maxHeight     = (height - tab.offsetHeight - chatFooter.offsetHeight - 20) + "px";
                                            msgView.style.height        = (height - tab.offsetHeight - chatFooter.offsetHeight - 20) + "px";
                                            
                                            privateView.style.maxHeight = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 ) + "px";
                                            privateView.style.height    = (height - tab.offsetHeight - chatFooter.offsetHeight - 30 ) + "px";
                                            
                                            
                                            //alert ("width "+ videoPlayer.width);
                                            videoPlayer.height = height ;
                                            videoPlayer.width  = videoControlSizeW ;
                                            //canvas
                                            canvas.height = height ;
                                            canvas.width  = videoControlSizeW ;
                                            
                                            privateHide.style.height = height + "px";
                                            privateHide.style.width  = videoControlSizeW + "px";
                                            
                                            //alert ("height "+ videoPlayer.height);
                                            conDiv.style.height = height + videoControlSizeH + "px";
                                        }
                                    }
                                    outputsize();
                                    
                                    new ResizeObserver(outputsize).observe(videoWrapper);
                                     
                                </script>
    							<!--
                                    #check:checked~.chat-btn i {
                                        display: block;
                                        pointer-events: auto;
                                        transform: rotate(180deg)
                                    }
                                    
                                    #check:checked~.chat-btn .comment {
                                        display: none
                                    }-->
    							
                                
    							<!-- user chat
    							<div class="card-profile card-rofile text-center"  style="float: right; width: 30%;height : 600px;">
    							    <div class="round hollow text-center">
                                    <a href="#" id="addClass"><span class="glyphicon glyphicon-comment"></span> Open in chat </a>
                                    </div>
    							</div>-->
    							<?php //} else { 
    							?>
    							<!--<iframe width="100%" height="auto" style="object-fit: fill;" src="<?php if(isset($model) && $model[0]['model_video'] != ''){ echo 'model_video/'.$model[0]['model_video'];}else{ echo "https://www.youtube.com/embed/5qky3L2Q6G4";} ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    							-->
    							<?php //}
    							?>
    						</div>
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
												        var sessionName ="<?php echo $_SESSION['name'] ?>";
												        if(sessionName == "")
                                                        {
                                                            Swal.fire('Login To ADD Favorite');
                                                        }
                                                        else
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
                                            				xhttp.send("chatuserid="+"<?php echo $_SESSION['id']; ?>"+"&modelId=" + <?php echo $model[0]["id"] ;?>);
                                                        }    
                                                
                                                }
                                                 
												</script>
												<h3 class="mb-0 whitecolor"><?php if(isset($model)){ echo $model[0]['name'];} ?>&nbsp;&nbsp;<a href="#" onclick="addFavorite()"><i id="fav" class=" <?php if(isset($favorites[0])){echo 'fa fa-heart gradient-4-text'; }else{echo 'far fa-heart gradient-4-text'; }?>"></i></a></h3>
												<p class="mb-0 whitecolor">ONLY AVAILABLE ON PONDACAM</p>
												<p class="mb-0 whitecolor">54 
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star coloryellow"></i>
												<i class="fas fa-star"></i>
												</p>
												
											</div>
										</div>			
										<?php if(isset($session[0]['stream'])){ ?>	
									    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
									    
                						<script type="text/javascript">
                						    
                						    var peer        = null;  // own peer object
                                            var conn        = null;
                                            var callName    = "";
                                            var lastPeerId  = null;
                                            var datacon     = null;
                                            var messageId = 0;
                                            var userCount = 0;
                						    
                                            function connect()
                                            {
                                                var id = "<?php echo $session[0]['stream']; ?>";
                                                
                                                <?php if(isset($_SESSION['name'])){ ?>
                                                
                                                var name = '<?php echo $_SESSION['name']; ?>' ;
                                                var userid = "<?php echo $_SESSION['id']?>";
                                                <?php }else{ ?>
                                                var userid = Math.round(Math.random() * 10000);
                                                var name = "guest" + userid; 
                                                
                                                <?php } ?>
                                                
                                                var option = {
                                                    name : name,
                                                    id: userid
                                                };
                                                
                                                callName = name;
                                                //call = peer.call(id, stream,{metadata:option});
                                                // Close old connection
                                                var datacon = null;
                
                                                // Create connection to destination peer specified in the input field
                                                datacon = peer.connect(id, {
                                                    reliable: true,
                                                    metadata:option
                                                });
                
                                                datacon.on('open', function () {
                                                    if(lastPeerId == null)
                                                    {
                                                        lastPeerId = id ;
                                                    }
                                                    
                                                });
                                                
                                                // Handle incoming data (messages only since this is the signal sender)
                                                datacon.on('data', function(data) 
                                                {
                                                    
                                                    if(data.name != "Notification" && data.name != "goPrivate" && data.name != "goSpy" && data.name != "Knight" && data.name != "Blocked" && data.name != "Banned" && data.name != "roomInfo" && data.name != "stopPrivate")
                                                    {
                                                        if(data.type == "undifined" || data.type == null)
                                                        {
                                                            addRecMessage(data.name,data.message,data.user_id);
                                                        }
                                                        else
                                                        {
                                                            if(data.type == "privateMessage")
                                                            {
                                                                addRecMessagePrivate(data.name,data.message,data.user_id);
                                                            }
                                                        }
                                                        //addRecMessage(data.name,data.message,data.user_id);
                                                        
                                                    }
                                                    else
                                                    {
                                                        
                                                        if(data.name == "stopPrivate")
                                                        {
                                                            var privateHide = document.getElementById("privateHide");
                                                            //privateTab stopPrivate
                                                            privateHide.style.display = "none";
                                                            var privateTab = document.getElementById("privateTab");
                                                            privateTab.style.display = "none";
                                                            var privateShow = document.getElementById("privateShow");
                                                            privateShow.hidden = false;
                                                            var stopPrivate = document.getElementById("stopPrivate");
                                                            stopPrivate.hidden = true;
                                                            var stopSpy =document.getElementById("stopSpy");
                                                            stopSpy.hidden = true;
                                                            var publicTab = document.getElementById("publicTab");
                                                            publicTab.click();
                                                        }
                                                        else if(data.name == "roomInfo")
                                                        {
                                                            alert(info);
                                                            //Swal.fire(data.message);
                                                            //location.href= "index.php";
                                                        }
                                                        else if(data.name == "Banned")
                                                        {
                                                            Swal.fire(data.message);
                                                            location.href= "index.php";
                                                        }
                                                        else if(data.name == "Blocked")
                                                        {
                                                            Swal.fire(data.message);
                                                            location.href= "index.php";
                                                        }
                                                        else if(data.name == "Knight")
                                                        {
                                                            //privateHide
                                                            if(data.chatuser == "<?php echo $_SESSION['id']; ?>")
                                                            {
                                                                //var privateHide = document.getElementById("privateHide");
                                                                //privateHide.style.display = "none";
                                                                Swal.fire("You have been knighted on this Room");
                                                            }
                                                            else
                                                            {
                                                                addNotification(data.message);
                                                            }
                                                            knightId = data.chatuser;
                                                        }
                                                        else if(data.name == "goSpy")
                                                        {
                                                            //privateHide
                                                            
                                                            
                                                            if(data.chatuser_id == "<?php echo $_SESSION['id']; ?>")
                                                            {
                                                                var privateHide = document.getElementById("privateHide");
                                                                privateHide.style.display = "none";
                                                                var privateShow = document.getElementById("privateShow");
                                                                privateShow.hidden = true;
                                                                var stopPrivate = document.getElementById("stopPrivate");
                                                                stopPrivate.hidden = true;
                                                                var stopSpy =document.getElementById("stopSpy");
                                                                stopSpy.hidden = false;
                                                            }
                                                        }
                                                        else if(data.name == "goPrivate")
                                                        {
                                                            //privateHide
                                                            var privateShow = document.getElementById("privateShow");
                                                            privateShow.hidden = true;
                                                            var stopPrivate = document.getElementById("stopPrivate");
                                                            stopPrivate.hidden = false;
                                                            var privateTab = document.getElementById("privateTab");
                                                            privateTab.click();
                                                            if(data.chatuser_id != "<?php echo $_SESSION['id']; ?>")
                                                            {
                                                                var privateHide = document.getElementById("privateHide");
                                                                privateHide.style.display = "block";
                                                            }
                                                            else
                                                            {
                                                                var privateTab = document.getElementById("privateTab");
                                                                privateTab.style.display = "block";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            console.log(data);
                                                            if(data.type == "new_join")
                                                            {
                                                                
                                                                addUserTab(data.user_name,data.user_id);
                                                                userCount = userCount + 1;
                                                                updateCount(userCount);
                                                            }
                                                            if(data.type == "user_left")
                                                            {
                                                                
                                                                var list = document.getElementById("userdiv"+ data.user_id);
                                                                if(list !== "undifened" || list !== null)
                                                                {
                                                                    list.remove();
                                                                }
                                                                
                                                                userCount = userCount - 1;
                                                                updateCount(userCount);
                                                            }
                                                            addNotification(data.message);
                                                            if(data.message =="Private show Declined")
                                                            {
                                                                Swal.fire(data.message);
                                                            }
                                                        }
                                                    }
                                                });
                                                
                                                datacon.on('error', function(err) { console.log(err); });
                                    
                                                datacon.on('close', function () {
                                                    
                                                    var src = "<?php if(isset($model) && $model[0]['model_video'] != ''){ echo 'model_video/'.$model[0]['model_video'];}else{ echo "https://www.youtube.com/embed/5qky3L2Q6G4";} ?>";
                                                    videoPlayer
                                                    var videoPlayer = document.getElementById("videoPlayer");
                                                    videoPlayer.src = src;
                                                    videoPlayer.play();
                                                    var statusModel = document.getElementById("statusModel");
                                                    statusModel.innerHTML = "OFFLINE";
                                                    console.log("Disconnected to: ");
                                                    userCount = userCount - 1;
                                                    updateCount(userCount);
                                                    //addNotification(call.metadata.name + " joined the chat");
                                                });
                                                
                                                datacon.on('disconnected', function () {
                                                    //status.innerHTML = "Connection lost. Please reconnect";
                                                    console.log('Connection lost. Please reconnect');
                            
                                                    // Workaround for peer.reconnect deleting previous id
                                                    datacon.id = lastPeerId;
                                                    datacon._lastServerId = lastPeerId;
                                                    datacon.reconnect();
                                                });
                                                
                                                return datacon;
                                            }
                            function callEm(){
                            var id = "<?php echo $session[0]['stream']; ?>";
                            var tryShare = false;
                            var device = navigator.mediaDevices.getUserMedia({video: true, audio: false});
                            //alert(tryShare);
                           device.then(function(stream) {
                              
                              alert("Connecting to <?php if(isset($model)){ echo $model[0]['name'];} ?>" );
                                var local = document.getElementById("videoPlayer2");
                                local.srcObject = stream; // C
                                local.autoplay = true; // D
                                local.volume = 1;
                                local.play();
                                //alert(local.srcObject);
                                
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
                                //alert(tryShare);
                               navigator.mediaDevices.getDisplayMedia({video: true, audio: false})
                              .then(function(stream) {
                                  
                                  alert("Connectiong to <?php if(isset($model)){ echo $model[0]['name'];} ?>" );
                                    var local = document.getElementById("videoPlayer2");
                                    local.srcObject = stream; // C
                                    local.autoplay = true; // D
                                    local.volume = 1;
                                    local.play();
                                    //alert(local.srcObject);
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
                                        //video.play();
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
                            });
                            
                        }
                                            function initialize() {
                                                // Create own peer object with connection to shared PeerJS server
                                                
                                                peer = new Peer(null, {
                                                    debug: 2
                                                });
                            
                                                peer.on('open', function (id) {
                                                    
                                                    datacon = connect();
                                                    console.log("Peer Connected " + id);
                                                });
                                                peer.on('connection', function (c) {
                                                    
                                                    conn = c;
                                                    //conn.send("data");
                                                    alert("connection created!");
                                                                                conn.on('data', function (data) {
                                                                                    console.log("Data recieved");
                                                             
                                                    if(data.name != "Notification" && data.name != "goPrivate" && data.name != "goSpy")
                                                    {
                                                        addRecMessage(data.name,data.message,data.user_id);
                                                        
                                                    }
                                                    else
                                                    {
                                                        if(data.name == "goSpy")
                                                        {
                                                            //privateHide
                                                            if(data.chatuser_id == "<?php echo $_SESSION['id']; ?>")
                                                            {
                                                                var privateHide = document.getElementById("privateHide");
                                                                privateHide.style.display = "none";
                                                            }
                                                        }
                                                        else if(data.name == "goPrivate")
                                                        {
                                                            //privateHide
                                                            
                                                            if(data.chatuser_id != "<?php echo $_SESSION['id']; ?>")
                                                            {
                                                                var privateHide = document.getElementById("privateHide");
                                                                privateHide.style.display = "block";
                                                            }
                                                            else
                                                            {
                                                                var privateTab = document.getElementById("privateTab");
                                                                privateTab.style.display = "block";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            addNotification(data.message);
                                                            if(data.message =="Private show Declined")
                                                            {
                                                                Swal.fire(data.message);
                                                            }
                                                        }
                                                    }
                                                    //addRecMessage(data);
                                                });
                                                });
                                                peer.on('call', function(call) {
                                                    
                                                  // Answer the call, providing our mediaStream
                                                  
                                                    call.answer();
                                                    call.on('stream', function(stream) { // B
                                                        
                                                        var video = document.querySelector('video');
                                                        video.srcObject = stream; // C
                                                        video.autoplay = true; // D\
                                                        video.play();
                                                        
                                                    });
                                                    console.log(call.metadata.roomUsers);
                                                    var users    =  call.metadata.roomUsers.userid.split(',');
                                                    var username =  call.metadata.roomUsers.username.split(',');
                                                    
                                                    knightId     = call.metadata.roomUsers.knight;
                                                    users.forEach(
                                                        function (val,ind)
                                                        {
                                                            addUserTab(username[ind],val);
                                                            userCount = userCount + 1;
                                                            updateCount(userCount);
                                                            
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
                                
                                audience.innerHTML = c ;
                                
                            }
                            function addNotification(msg)
                            {
                                 msgView.innerHTML = msgView.innerHTML + "<div style='text-align:center;float :right;width: 100%;'>" + msg + "</div>";
                            
                                let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;
                            }
                            //privateView
                            function addSentMessage(name,msg)
                            {
                                
                                msgView.innerHTML = msgView.innerHTML + 
                                                    '<div style="position:releted;left:1px;"><a href="#" style="color:green;font-size:20px;" onclick=""><b><?php echo $_SESSION['name']; ?></b></a> '+ msg +'</div>'; 
                                    
                                let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;    
                                    /*"<div class='d-flex justify-content-start mb-4' style='width:300px'><div class='msg_cotainer' style='max-width: 70%;min-width: 30%;'>" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									*/
									
									
                            }
                            function addSentMessagePrivate(name,msg)
                            {
                                
                                privateView.innerHTML = privateView.innerHTML + 
                                                    '<div style="position:releted;left:1px;"><a href="#" style="color:green;font-size:20px;" onclick=""><b><?php echo $_SESSION['name']; ?></b></a> '+ msg +'</div>'; 
                                    
                                let objDiv = document.getElementById("privateView");
                                objDiv.scrollTop = objDiv.scrollHeight;    
                                    /*"<div class='d-flex justify-content-start mb-4' style='width:300px'><div class='msg_cotainer' style='max-width: 70%;min-width: 30%;'>" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";
									*/
									
									
                            }
                            function addSentMessage1(name,msg)
                            {
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='direct-chat-msg doted-border' style='border: none;'> <div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-left'>" + name + "</span></div>                <div class='direct-chat-text' style='max-width: 100%;'>" + msg + "</div><div class='direct-chat-info clearfix'><span class='direct-chat-timestamp pull-right'>3.36 PM</span></div></div>";
								
								let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;
                            }
                            //privateView
                            function addRecMessagePrivate(name,msg,id)
                            {
                                //name.replace(" ", "_");
                                
                                var msgDiv = 
                                   '<div style="position:releted;left:1px;text-align:left;">';
                                
                                if(knightId != id)
                                {
								msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                }
                                else
                                {
                                msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                }
                                msgDiv = msgDiv + msg ;
                                msgDiv = msgDiv  
                                    +       '<div class="action_menu" id="userOption'+ messageId  + id +'" style="left:1px;">'
            						+	        '<ul>'
            						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
            						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
            						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
            						+		        '<li><a onclick="banUser('+id+',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
            						+		        '<li><a onclick="blockUser('+id+',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
            						+	        '</ul>'
            						+       '</div>';
                                msgDiv = msgDiv +   '</div>';
                                
                                privateView.innerHTML = privateView.innerHTML + msgDiv;
								let objDiv = document.getElementById("privateView");
                                objDiv.scrollTop = objDiv.scrollHeight;	
                                messageId += 1;
								/*"<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";*/
                            }
                            function addRecMessage(name,msg,id)
                            {
                                //name.replace(" ", "_");
                                
                                var msgDiv = 
                                   '<div style="position:releted;left:1px;text-align:left;">';
                                
                                if(knightId != id)
                                {
								msgDiv = msgDiv  + '<a href="#" style="color:red;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'</b></a> '
                                }
                                else
                                {
                                msgDiv = msgDiv + ' <a href="#" style="color:gold;font-size:20px;" onclick="viewOptions(\'userOption'+messageId+ id +'\','+ id +')"><b>'+ name +'&nbsp;<i class="fas fa-chess-knight"></i> </b></a>'
                                }
                                msgDiv = msgDiv + msg ;
                                msgDiv = msgDiv  
                                    +       '<div class="action_menu" id="userOption'+ messageId  + id +'" style="left:1px;">'
            						+	        '<ul>'
            						+		        '<li><i class="fas fa-user-circle"></i> profile summary</li>'
            						+		        '<li><a onclick="knight('+id+',\''+name+'\',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-chess-knight"></i> Knight</a></li>'
            						+		        '<li><i class="fas fa-volume-mute"></i> Mute</li>'
            						+		        '<li><a onclick="banUser('+id+',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-plus"></i> Ban User</a></li>'
            						+		        '<li><a onclick="blockUser('+id+',\'userOption'+ messageId  + id +'\')" ><i class="fas fa-ban" ></i> Block</a></li>'
            						+	        '</ul>'
            						+       '</div>';
                                msgDiv = msgDiv +   '</div>';
                                
                                msgView.innerHTML = msgView.innerHTML + msgDiv;
								let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;	
                                messageId += 1;
								/*"<div class='d-flex justify-content-end mb-4' style='width:300px;float: right;'><div class='msg_cotainer_send' style='max-width: 70%;min-width: 30%;'>" + name + "<hr />" +									msg +
									"<span class='msg_time'>8:40 AM, Today</span></div></div>";*/
                            }
                            function addRecMessage1(name,msg)
                            {
            
                                msgView.innerHTML = msgView.innerHTML +
                                    "<div class='direct-chat-msg doted-border' style='border: none;'> <div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-right'>" + name + "</span></div>                <div class='direct-chat-text' style='max-width: 100%;'>" + msg + "</div><div class='direct-chat-info clearfix'><span class='direct-chat-timestamp pull-right'>3.36 PM</span></div></div>";
								let objDiv = document.getElementById("msgView");
                                objDiv.scrollTop = objDiv.scrollHeight;
                            }
                            function sendToken()
                            {
                                var sessionName ="<?php echo $_SESSION['name'] ?>";
                                if(sessionName == "")
                                {
                                    Swal.fire('Login To TIP');
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
                                          if(conn !== null)
                                          {
                                              conn.send({name:"Notification" , message:"<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens "});
                                              
                                              addNotification("<?php echo $_SESSION['name'] ?> Paid " + result.value.tokkens + " Tokkens ");
                                          }
                                          
                                      }
                                    });
                                  
                                }
                            }
                            //sendMessage
                            function sendMsg()
                            {
                                var sessionName ="<?php echo $_SESSION['name'] ?>";
                                
                                var sessionId ="<?php echo $_SESSION['id'] ?>";
                                //status_message
                                    var messageBox = document.getElementById("messageBox");
                                    var sessionName ="<?php echo $_SESSION['name'] ?>";
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
                                            datacon.send({name:callName , message:messageBox.value,user_id:sessionId});
                                            
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
                            function sendMsgPrivate()
                            {
                                var sessionName ="<?php echo $_SESSION['name'] ?>";
                                
                                var sessionId ="<?php echo $_SESSION['id'] ?>";
                                //status_message
                                    var messageBox = document.getElementById("messageBoxPrivate");
                                    var sessionName ="<?php echo $_SESSION['name'] ?>";
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
                                            datacon.send({name:callName , message:messageBox.value,user_id:sessionId,type:"privateMessage"});
                                            
                                            addSentMessagePrivate("<?php echo $_SESSION['name'] ?>",messageBox.value);
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
                                            
                                            //datacon.send("test")
                                            //console.log(datacon);
                                            //callEm();
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
												<?php $gen = $model[0]["gender"];
												        $size = "Breast size";
												        if($gen == "male")
												        {
												            $size = "Dick size";
												        }
												        
												    
												?>
												<p class="whitecolor"><?php echo $size;?></p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php echo $gen;?></h3>
												<p class="whitecolor">Gender</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<a href="#" onclick="sendTokenOffline()"><h3 class="whitecolor mb-0">OFFLINE TIP</h3></a>
											</div>
											<div class="card-profile card-rofile text-center">
												<?php 
											     
											     if(isset($country[0]))
											     {
											         echo '<img src="'.$country[0]["flag"].'" width="100%" alt="">';
											     }
											     else
											     {
											         echo $model[0]["country"];
											     }
											?>
											</div>
											
										</div>
										<p class="redcolor"><?php if(isset($modelinfo)){echo $modelinfo[0]['bio'];} ?></p>												
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
								            var sessionName ="<?php echo $_SESSION['name'] ?>";
								            if(sessionName == "")
                                            {
                                                Swal.fire('Login To Unlock Photo');
                                            }
                                            else
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
								        }
								        function unlockVideo(imgId,amount)
								        {
								            var sessionName ="<?php echo $_SESSION['name'] ?>";
								            if(sessionName == "")
                                            {
                                                Swal.fire('Login To Unlock Video');
                                            }
                                            else
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
                                                       fetch('//pondacams.com/addVideoAccess.php?chatuser_id=<?php echo $_SESSION['id'] ?>&img_id=' + imgId)
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
								        }
								    </script>
								    <?php 
								    if(isset($pvideos[0]))
								    {
								        foreach($pvideos as $vid)
								        {
								            if($vid['is_locked']=='lock')
								            {
								                $vidAccess = $conn ->getRow("modelvideo_access",["chatuser_id" => $_SESSION["id"],"video_id" => $vid['id']]);
    										    if (isset($vidAccess[0]))
    										    {
    										        $fromdate = $vidAccess[0]["from_date"];
    										        $todate   = $vidAccess[0]["to_date"];
    										        $today    = date("Y-m-d");
    										        if($today >= $fromdate && $today <= $todate)
    										        {
								    ?>
								            <div class="card card-pin">
												<video class="card-img"  src="../model_video/<?php echo $vid['video_name'] ; ?>"  alt="Card Video" controls controlsList="nodownload"> </video>
                                                
											</div>
								    <?php
    										        }
    										    }
    										    else
    										    {
								    ?>
							                <div class="card card-pin">
												<div class="locked">
													<i class="fa fa-lock" style="font-size: 30px;color: #fff; position: absolute;top: 50%;left: 50%;margin-left: -25px;width: 50px;height: 50px; margin-top: -25px;"></i>
												</div>
												<video class="card-img"  src="../model_video/<?php echo $vid['video_name'] ; ?>"  alt="Card Video"> </video>
                                                <div class="overlay">
												    
													<h3 class="card-title title"><?php echo $preference[0]['video_price'] ; ?>  Tokens for 90 days</h3>             
													<div class="more"><a href="#!" onclick="unlockVideo(<?php echo $vid['id'] ; ?>,<?php echo $preference[0]['video_price'] ; ?>)">Unlock my video</a>
													</div>                
												</div>
											</div> 
									<?php       }
								            }
								            else
								            {
									?>
								            <div class="card card-pin">
												<video class="card-img"  src="../model_video/<?php echo $vid['video_name'] ; ?>"  alt="Card Video" controls controlsList="nodownload"> </video>
                                                
											</div>
								    
								    <?php 
								        
								            }    
								        }
								            
								    }
								    ?>
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
													<i class="fa fa-lock" style="font-size: 30px;color: #fff; position: absolute;top: 50%;left: 50%;margin-left: -25px;width: 50px;height: 50px; margin-top: -25px;"></i>
												</div>
												<img class="card-img"  src="model-images/<?php echo $img['image_name'] ; ?>"  alt="Card image">
												<div class="overlay">
												    
													<h3 class="card-title title"><?php echo $preference[0]['picture_price'] ; ?> picture_price Tokens for 90 days</h3> 
													<div class="more" ><a href="#!" onclick="unlockImg(<?php echo $img['id'] ; ?>,<?php echo $preference[0]['picture_price'] ; ?>)" style="width:100%;">Unlock my picture</a>
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
				<li><a href="">Contact Us</a></li>
				<li><a href="">Support</a></li>
				<!--<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
				<li><a href=""><i class="fab fa-twitter"></i></a></li>
				<li><a href=""><i class="fab fa-instagram"></i></a></li>-->
				</ul>
			</div>
		</div>
		<div class="terbox">
			<div class="container">
				<p>The site contains sexually explicit material, Enter ONLY if you are at least 18 years old and agree to our cookie rules.</p>
				
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
        					 <li><a href="mailto: admin@pondacams.com">Help</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Terms &amp; Conditions</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Ownership Statement</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Anti-Spam Policy</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Refund Policy</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Privacy Policy</a></li>
        					 <li><a href="./documents/pondacams_policies.pdf" target="_blank">Cookies Policy</a></li>
					    </ul>
					</div>
				</div>
			</div>
		</div>		
        <!--**********************************
            Footer end
        ***********************************-->


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
                       <a href="./model" class="btn login-form__btn" >MODEL OR STUDIO</a>
    							   
                    </form>				
    				<p class="mt-1 login-form__footer">
    				   <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#forgotpassword">Click here</a> 
    				   If you fogot password?</p>
    				<p class="login-form__footer">Dont have account? <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#joinnow">Join Now</a></p>
    			</div>
    		</div>
    	</div>
    </div>
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
    bottom: 0;
    right: 1px;
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
    overflow-y: scroll;
    max-height: inherit;
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
    	<div class="direct-chat-messages" id="msgView1">
                
    			
        
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
	
	<!-- modal buytokkens -->
<div class="modal  fade"  id="buytokkens" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog model-lg modal-dialog-centered mobiles-search-box">
	    
		<div class="modal-content ">
		    <div class="modal-body joinnowbg">
			     <div class="row">
			         <div class="col-sm-5"></div>
			         <div class="col-sm-7">
    			         <button type="button" class="close" data-dismiss="modal"style="float:right;"><span>back to site</span></button>
			         </div>
			       <iframe src="/payment.php?userid=<?php echo $_SESSION['id']; ?>" width="200%" height="500" style="border:none;" >
                   </iframe> 
				   				
			</div>
		</div>
	</div>
</div>
</div>	
<!-- modal Escape -->
<div class="modal  fade"  id="escape" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
    <div class="col-sm-7">
        <button type="button" class="close" onclick="hipeM()"style="float:right;"><span style="fonth-size:15px;">back to site</span></button>
    </div >
    <div style="width:100%;height:1000px">
        <iframe src="https://www.accuweather.com/" width="100%"  style="border:none;height:inherit" >
        </iframe>
    </div>
	<script>
	    function hipeM()
	    {
	        //alert("hideM");
	        var myM = $('#escape');
	        
	        myM.hide();
	        $('body').removeClass('modal-open'); // For scroll run
	        $('.modal-backdrop').hide();
	        console.log(myM);
	        //document.getElementById("escape").hide();
	        //$('#escape').modal('hide');
	    }
	    function showM()
	    {
	        var myM = $('#escape');
	        myM.attr("aria-hidden","false");
	        myM.addClass('show'); 
	        myM.show();
	        myM.css("padding-right","25.9922px");
	        //myM.style.padding-right = "padding-right: 25.9922px;"
	        $('body').addClass('modal-open'); // For scroll run
	        $('body').css("padding-right","25.9922px");
	        $('.modal-backdrop').show();
	    }
	</script>
</div>	
	
	<div class="modal-backdrop fade show" style="display:none"></div>
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
    <!-- chat-
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    ------ Include the above in your HEAD tag ---------->
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
							location.reload();
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
	<script>
        function viewOptions(userOption,id)
        {
            //alert(userOption);
            if(knightId == "<?php echo $_SESSION['id'];?>")
            {
                $('#' + userOption).toggle();
            }
        }
        	/*$(document).ready(function(){
$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});
	});*/
    </script>
</body>
</html>