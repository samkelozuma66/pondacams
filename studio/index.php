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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Required meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon1.png">
	<title>Pondacam | Dashboard</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
	<!-- Layout styles -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
	<!-- End layout styles -->
	<script src="https://use.fontawesome.com/0f43fe6a33.js"></script>
</head>

<body>
	<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <!-- topbar.php -->
	<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<a class="navbar-brand brand-logo" href="index.php"><img src="../images/logo-compact1.png" alt="logo" /></a>
				<a class="navbar-brand brand-logo-mini" href="#"><img src="../images/favicon1.png" alt="logo" /></a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="mdi mdi-menu"></span> </button>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-profile dropdown">
						<a class="nav-link" id="profileDropdown" href="#" >
							<div class="nav-profile-text">
								<p class="mb-1">
								    <i class="fa fa-database" aria-hidden="true"></i>
									<?php 
									    $companyModels =  $conn -> getRow('users',['parent_id' => $_SESSION['id']]);
									    $sum     = 0;
									    $hours   = 0;
                			            $min     = 0;
                			            $sec     = 0;
                			            $avarage = 0;
									    foreach($companyModels as $compInd => $comprow)
                                        {
                                             $sum += $comprow['money'];
                                             $workTime = $conn ->getRow("session_time",["model_id" => $comprow['id']]);
                        					if(isset($workTime[0]))
                    					    {
                    					        foreach($workTime as $ind => $row)
                    					        {
                    					            $start = $row["start_time"];
                    					            $end   = $row["end_time"];
                    					            
                    					            $statArray = explode(":",$start);
                    					            $endArray = explode(":",$end);
                    					            
                    					            if($endArray[0] < $statArray[0])
                    					            {
                    					                $baseH  = 24 - $statArray[0];
                    					                $hours += $baseH + $endArray[0];
                    					            }
                    					            else
                    					            {
                    					                $hours += $endArray[0] - $statArray[0];
                    					            }
                    					            
                    					            if($endArray[1] < $statArray[1])
                    					            {
                    					                $baseM  = 60 - $statArray[1];
                    					                $min   += $baseM + $endArray[1] ;
                    					            }
                    					            else
                    					            {
                    					                $min   += $endArray[1] - $statArray[1];
                    					            }
                    					            
                    					            if($endArray[2] < $statArray[2])
                    					            {
                    					                $baseS  = 60 - $statArray[2];
                    					                $sec   += $baseS + $endArray[2];
                    					            }
                    					            else
                    					            {
                    					                $sec   += $endArray[2] - $statArray[2];
                    					            }
                    					            
                    					            
                    					            
                    					           
                    					        }
                    					        $modeS = floor($sec / 60);
                    					        
                    					        if($modeS > 0)
                    					        {
                    					            $min += $modeS;
                    					            $sec   = $sec % 60;
                    					        }
                    					        
                    					        $modeM = floor($min / 60);
                    					        
                    					        if($modeM > 0)
                    					        {
                    					            $hours += $modeM;
                    					            $min   = $min % 60;
                    					        }
                    					        
                    					    }
                    					    
                                        }
                                        if($hours == 0)
                					    {
                					        $avarage = $sum / 1 ;
                					    }
                					    else
                					    {
                					        $avarage = round(($sum / $hours) * 100) / 100 ;
                					    }
                                        echo $sum;
									?>
									&nbsp;tk
								</p>
							</div>
						</a>
					</li>
					<li class="nav-item nav-profile dropdown">
						<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
							<div class="nav-profile-text">
								<p class="mb-1">
									<?php echo $_SESSION['name'] ?>
								</p>
							</div>
						</a>
						<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
							<a class="dropdown-item" href="#"> <i class="mdi mdi-cached mr-2"></i>Activity Log </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../logout.php"> <i class="mdi mdi-logout mr-2"></i> Signout </a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> <span class="mdi mdi-menu"></span> </button>
			</div>
    </nav>
    <!-- TOpbar.php END -->
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
      <!-- LeftSidebar -->
			<?php include 'leftbar.php'; ?>
      <!-- leftsidebar END -->
      <!-- partial -->
      <!-- Page CONTENT -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="page-header">
						<h3 class="page-title">
                  <div class="input-daterange input-group" id="flight-datepicker">
					<div class="form-item">
					  <label>From </label><span class="fontawesome-calendar"></span>
					  <input class="input-sm form-control" type="text" id="start-date" name="start" placeholder="Select depart date" data-date-format="DD, MM d"/><span class="date-text date-depart"></span>
					</div>
					<div class="form-item">
					  <label>To</label><span class="fontawesome-calendar"></span>
					  <input class="input-sm form-control" type="text" id="end-date" name="end" placeholder="Select return date" data-date-format="DD, MM d"/><span class="date-text date-return"></span>
					</div>
				  </div>
			   </h3>
						<nav aria-label="breadcrumb">
							<ul class="breadcrumb">
								<li class="breadcrumb-item active" aria-current="page"> <a href=""><span></span>Refresh Data <i class="mdi mdi-autorenew icon-sm text-primary align-middle"></i></a> </li>
							</ul>
						</nav>
					</div>
					
					<div class="row">
						<div class="col-md-4 stretch-card grid-margin">
							<div class="card bg-gradient-danger card-img-holder text-white">
								<div class="card-body"> <img src="assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
									<h4 class="font-weight-normal mb-3">Total Earning <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
									<h2 class="mb-5"><?php echo $sum." tk"; ?></h2>
									<h6 class="card-text">Increased by 60%</h6> </div>
							</div>
						</div>
						<div class="col-md-4 stretch-card grid-margin">
							<div class="card bg-gradient-info card-img-holder text-white">
								<div class="card-body"> <img src="assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
									<h4 class="font-weight-normal mb-3">Total Work Hours <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
									<h2 class="mb-5"><?php echo $hours."h ".$min."m ".$sec."s "; ?></h2>
									<h6 class="card-text">Decreased by 10%</h6> </div>
							</div>
						</div>
						<div class="col-md-4 stretch-card grid-margin">
							<div class="card bg-gradient-success card-img-holder text-white">
								<div class="card-body"> <img src="assets/images/circle.svg" class="card-img-absolute" alt="circle-image" />
									<h4 class="font-weight-normal mb-3">Average tk Per hour <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
									<h2 class="mb-5"><?php echo $avarage." tk"?></h2>
									<h6 class="card-text">Increased by 5%</h6> </div>
							</div>
						</div>
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
	var dateSelect = $("#flight-datepicker");
	var dateDepart = $("#start-date");
	var dateReturn = $("#end-date");
	var spanDepart = $(".date-depart");
	var spanReturn = $(".date-return");
	var spanDateFormat = "ddd, MMMM D yyyy";
	dateSelect.datepicker({
		autoclose: true,
		format: "mm/dd/yyyy",
		maxViewMode: 0,
		startDate: "now"
	}).on("change", function() {
		var start = $.format.date(dateDepart.datepicker("getDate"), spanDateFormat);
		var end = $.format.date(dateReturn.datepicker("getDate"), spanDateFormat);
		spanDepart.text(start);
		spanReturn.text(end);
	});
	</script>
	<!-- endinject -->
</body>

</html>