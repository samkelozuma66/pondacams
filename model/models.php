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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Required meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Pondacam | Models</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
	<!-- Layout styles -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
	<!-- End layout styles -->
</head>

<body>
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<?php include 'topbar.php'; ?>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- leftsidebar -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item active">
						<a class="nav-link" href="#"> <span class="menu-title">Models</span> <i class="mdi mdi-account-multiple menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php"> <span class="menu-title">Statistic</span> <i class="mdi mdi-chart-line menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php"> <span class="menu-title">Personal Data</span> <i class="mdi mdi-settings menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts"> <span class="menu-title">Payout</span> <i class="menu-arrow"></i> <i class="mdi mdi-buffer menu-icon"></i> </a>
						<div class="collapse" id="page-layouts">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="#">Payout card</a></li>
								<li class="nav-item"> <a class="nav-link" href="#">Withdraw bank</a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"> <span class="menu-title">Member Referral</span> <i class="mdi mdi-bullhorn menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#helpinfo" aria-expanded="false" aria-controls="page-layouts"> <span class="menu-title">Help & Info </span> <i class="menu-arrow"></i> <i class="mdi mdi-information-outline menu-icon"></i> </a>
						<div class="collapse" id="helpinfo">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="#">Contact</a></li>
								<li class="nav-item"> <a class="nav-link" href="#">Chat</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</nav>
			<!-- /////end leftsidebar -->
			<!-- partial -->
			<!-- Middle Content -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<?php $row = $conn->getRow('users',['id'=>$_SESSION['id']]);
						   foreach($row as $model){							   
						?>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="../documents/<?php echo $model['selfie']?>" alt="">
									<h5 class="girlname"><?php echo $model['name'] ?><small>(24 Year)</small>)</h5>
									<span>Chat Now</span> 
							    </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="<?php echo $model['name']?>"> 
									<img src="../documents/<?php echo $model['selfie']?>" alt=""> 
									<span class="status f-online"></span> 
							    </div>
							</div>
						</div>
                       <?php
						   }
						?>
						
						<!-- <div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/livecam-6.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/livecam-6.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo11.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo11.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo15.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo15.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo16.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo16.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo17.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo17.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo1.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo1.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/livecam-6.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/livecam-6.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo11.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo11.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo15.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo15.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo16.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo16.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div>
						<div class="col-md-3 stretch-card paddlr">
							<div class="story-box attra-box">
								<figure> <img src="assets/images/photo17.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5> <span>Chat Now</span> </figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden"> <img src="assets/images/photo17.jpg" alt=""> <span class="status f-online"></span> </div>
							</div>
						</div> -->
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
					<div class="d-sm-flex justify-content-center justify-content-sm-between"> <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 
			        <a href="" target="_blank">Pondacam</a>. All rights reserved.</span> </div>
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