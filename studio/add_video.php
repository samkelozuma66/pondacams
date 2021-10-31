<?php
include 'config.php';
if(!isset($_SESSION['name'])){	
	echo "<script>window.location.href='../login.php'</script>";
}else{
	$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
	if($row[0]['user_type']==1 || $row[0]['registration_type']!='company'){
		echo "<script>window.location.href='../login.php'</script>";
	}
	elseif($row[0]['status'] !='approved'){
	  echo "<script>window.location.href='../registerUpdate.php'</script>";
	}
}
$videoErr = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
   // print_r($_FILES);
	 $error = true;
	//print_r($_POST);
	//print_r($_FILES);die;
	$video = $_FILES['modelvideo']['name'];
    $ext  = strtolower(pathinfo($video, PATHINFO_EXTENSION));
   // print_r($ext);die;
    if(empty($video)){
		$error = false;
		$videoErr = "Choose File First!!";
	}elseif(($ext=="mp4") || ($ext =="AVI")||($ext=="MKV")||($ext=="FLV")||($ext=="WMV")||($ext=="MOV")||($ext=="AVCHD")||($ext=="WebM")){
		$video = time().$_FILES['modelvideo']['name'];
		move_uploaded_file($_FILES["modelvideo"]["tmp_name"],'../model_video/'.$video);            
	}else{
		$error = false;
		$videoErr = "UnSupport File Format!!!";
	}
	if($error){
        $data = ['model_video'=>$video];
		$go = $conn->updateData('users',$data,['id'=>$_SESSION['id']]);
		if(isset($go)){
			echo "<script>window.location.href='profile.php'</script>";
		}
	} 
}	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Required meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Pondacam | Profile</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
	<!-- Layout styles -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
	<!-- End layout styles -->
	<link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/metisMenu.min.css" rel="stylesheet">
	<style>
	.content-body {
	margin-left: 0px;
	z-index: 0;
	background: rgba(218,0,0,.8);
	background: linear-gradient(180deg);
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
	.content-wrapper{
		margin-left: 250px;
	}
	#sidebar{
		margin-left: -15px;
	}
    /* Image Upload CSS */
    .files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    /* content: " or drag it here. "; */
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}
</style>
</head>

<body>
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<!-- topbar.php -->
			<?php include 'topbar.php'; ?>
		<!-- TOpbar.php END -->
			<!-- partial -->
		<div class="container-fluid page-body-wrapper">
      		<!-- LeftSidebar -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar" style = "position: fixed;">
                <ul class="nav">
                  <li class="nav-item ">
                    <a class="nav-link" href="models.php">
                      <span class="menu-title">Models</span>
                      <i class="mdi mdi-account-multiple menu-icon "></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <span class="menu-title">Statistic</span>
                      <i class="mdi mdi-chart-line menu-icon "></i>
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="profile.php">
                      <span class="menu-title">Personal Data</span>
                      <i class="mdi mdi-settings menu-icon "></i>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                      <span class="menu-title">Payout</span>
                      <i class="menu-arrow"></i>
                      <i class="mdi mdi-buffer menu-icon"></i>
                    </a>
                    <div class="collapse" id="page-layouts">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="#">Payout card</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#">Withdraw bank</a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span class="menu-title">Member Referral</span>
                      <i class="mdi mdi-bullhorn menu-icon "></i>
                    </a>
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

			<!-- leftsidebar END -->
			<!-- partial -->
			<!-- Page CONTENT -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="content-body">
						<div class="container-fluid">	              
							<!-- <div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-10">
									<div class="videoWrapper"> -->
										<!-- Copy & Pasted from YouTube -->
									<!-- 	<iframe width="560" height="350" src="http://www.youtube.com/embed/n_dZNLr2cME?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
									</div>
								</div>
								<div class="col-sm-1"></div>				  
							</div>		 -->		
							<div class="mfullwidth">
								<div class="story-postbox story-postboxv">
									<div class="">
										<div class="col-sm-12">
											<div class="card bg-imgprofile">
												<div class="card-body row">
													<div class="col-12 col-sm-8 media align-items-center mb-4"  >
														<img class="mr-3 userprofile-pic" src="images/livecam-3.jpg" width="100" height="100" alt="">
														<div class="media-body">
															<h3 class="mb-0 whitecolor"><?php echo $_SESSION['name']?></h3>
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
															<h3 class="whitecolor mb-0">22</h3>
															<p class="whitecolor px-4">Age</p>
														</div>
														<div class="card-profile card-rofile text-center">
															<h3 class="whitecolor mb-0">Normal</h3>
															<p class="whitecolor">Breast size</p>
														</div>
														<div class="card-profile card-rofile text-center">
															<h3 class="whitecolor mb-0">Female</h3>
															<p class="whitecolor">Gender</p>
														</div>
														<!-- <a href="javascript:void(0)" ><div class="card-profile card-rofile text-center mt-2" style="width:91.5%;">
															<h3 class="whitecolor mb-0">Add Images</h3>
														</div></a> -->
													</div>
																									
												</div>
											</div>  
										</div>							
									</div>
								</div>	

                                <!-- Image s UPLOAD -->			
								<div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <form method="post" enctype="multipart/form-data"> 			
                                                                               
											<div class="form-group files">
                                                <label class = "text-white">Upload Video </label>
                                                <input type="file" name = "modelvideo" class="form-control">
                                            </div> 	
											<span class = "text-white">*<?php echo $videoErr ?></span>			  
											<div class = "text-center">
											
											<button class = " button card-profile card-rofile text-center mt-2 whitecolor mb-0" type = "submit">Submit</button>
											</div>                     
                                        </form>                                      
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <form method="post" action="#" id="#">                                                                                                                                                          
                                           <div class="form-group files color">
                                                <label>Upload Your File </label>
                                                <input type="file" class="form-control" multiple="">
                                            </div>                                                                                   
                                        </form>                                                                               
                                    </div> -->
                                    </div>
                               </div>
							</div>
						</div>   <!-- #/ container -->
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<!-- <footer class="footer">
					<div class="d-sm-flex justify-content-center justify-content-sm-between"> <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 
			        <a href="" target="_blank">Pondacam</a>. All rights reserved.</span> </div>
				</footer> -->
				<!-- partial -->
			</div>
            <!-- Page CONTENT END -->
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
	<script>
	// Make your own here: https://eternicode.github.io/bootstrap-datepicker
	
	</script>
	<!-- endinject -->
</body>

</html>