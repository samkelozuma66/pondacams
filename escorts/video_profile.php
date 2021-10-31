<?php 
include '../config.php';
if(isset($_GET['id'])){
$model = $conn->getRow('escort',['id'=>$_GET['id']]);
$pic = $conn->getRow('escort_image',['escort_id'=>$_GET['id']]);
$modelinfo = $conn->getRow('modelinfo',['model_id'=>$_GET['id']]);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Escort</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon1.png"> 
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/animate.min.css" rel="stylesheet">
	<link href="../css/bootstrap-select.min.css" rel="stylesheet">
	<link href="../css/metisMenu.min.css" rel="stylesheet">	
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
<body>

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
						<span class="logo-compact"><img src="../images/logo-compact1.png" alt="" style="width:35%;"></span>
					</a>
				</div>            
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user" onclick="showM()" style="position: relative; top: 0px;">
                                <span>Escape</span>  
                            </a>
                        </li>
                        <!--<li class="icons dn"><a href="javascript:void(0)">Live Cams</a></li>
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
					    </li>		-->					
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
						<div class="videoWrapper">
							<!-- Copy & Pasted from YouTube -->
							<!--<iframe width="648" height="365" src="../documents/<?php echo $model[0]['cover_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						    -->
						    <video  width="70%" height="500" style="object-fit: fill;margin-left:15%;"src="../documents/<?php echo $model[0]['cover_video'] ?>" controls></video>
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
											<img class="mr-3 userprofile-pic" src="../documents/<?php echo $model[0]['selfie'] ?>" width="100" height="100" alt="">
											<div class="media-body">
												<h3 class="mb-0 whitecolor"><?php if(isset($model)){ echo $model[0]['display_name'];} ?></h3>
												<h3 class="mb-0 whitecolor"><?php if(isset($model)){ echo $model[0]['area'];} ?></h3>
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
										<div class="col-12 col-sm-4 mb-3">
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($model)){echo $model[0]['age'];} ?></h3>
												<p class="whitecolor px-4">Age</p>
											</div>
										<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($model)){echo $model[0]['hair_color'];} ?></h3>
												<p class="whitecolor px-4">Hair</p>
											</div>
										<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($model)){echo $model[0]['eye_color'];} ?></h3>
												<p class="whitecolor px-4">Eyes</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($model)){echo $model[0]['breast_size'];} ?></h3>
												<p class="whitecolor">Breast size</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0">Female</h3>
												<p class="whitecolor">Gender</p>
											</div>
											<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0"><?php if(isset($model)){echo $model[0]['available'];} ?></h3>
												<p class="whitecolor">Available</p>
											</div>
											
											<!--<div class="card-profile card-rofile text-center">
												<h3 class="whitecolor mb-0">></h3>
												<p class="whitecolor px-4">Contact</p>
											</div>-->
										</div>
										<p>
										    <h3 style="color:yellow;">Contact : 
										    <?php if(isset($model)){echo $model[0]['phone_number'];} ?> 
										    Travel :<?php if($model[0]['travel']){echo "YES"; }else{echo "NO";} ?>
										    </h3>
										</p>
										
										<p style="color:#ffffff">
										    
										    &nbsp;&nbsp;<?php if(isset($model)){echo $model[0]['bio'];} ?>
										</p>												
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
									<?php   
									foreach($pic as $img){
										?>
										
											<div class="card card-pin">
												<img class="card-img"  src="../documents/<?php echo $img['image_name'] ; ?>" alt="image">
											</div>
											<?php
																							
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
				    <li><a href="">Contact Us</a></li>
				    <li><a href="">Support</a></li>
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
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Terms &amp; Conditions</a></li>
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Ownership Statement</a></li>
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Anti-Spam Policy</a></li>
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Refund Policy</a></li>
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Privacy Policy</a></li>
        					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Cookies Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>		
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
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
    <script src="../js/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
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