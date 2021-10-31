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
    <title>Pondacam | Home</title>
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
  
<body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="../images/logo-compact1.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="../images/favicon1.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
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
             <li class="nav-item active">
                <a class="nav-link" href="home.php">
                  <span class="menu-title">Home</span>
                  <i class="mdi mdi-home menu-icon"></i>
                </a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="models.php">
                  <span class="menu-title">Models</span>
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
            <!--<li class="nav-item">
				<a class="nav-link" href="#"> <span class="menu-title">Member Referral</span> <i class="mdi mdi-bullhorn menu-icon "></i> </a>
			</li></-->
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
                </span> Home </h3>
              </div>		
            <div class="row">
			        <div class="col-sm-6">
                <div class="col-md-12 stretch-card grid-margin paddlr">
                  <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                      <img src="assets/images/shopping.png" class="card-img-absolute" alt="circle-image" />
                      <h3 class="font-weight-normal mb-3"><b>THE PONDACAM COLLECTION IS HERE </b></h3>
                      <p class="mb-3 padr200">Let your fans show their love by sending you a gift from the pondacam collection! Feel free to wear them when you go online! </p>
                      <h6 class="card-text">DON'T MISS OUT</h6>
					            <a href="" class="button">Select your size</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 stretch-card grid-margin paddlr">
                  <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">                   
                      <h4 class="font-weight-normal">WIN EVERY WEEK UP TO 
                      </h4>
                      <h1 class="mb-3 rpice">$3000</h1>
                      <h6 class="card-text">IN AWARDS!</h6>
                      <a href="" class="button">Discover now!</a>
                      <img src="assets/images/woma.png" class="card-img-absolute card-img-absolute1" alt="circle-image" />
                    </div>
                  </div>
                </div>
                <div class="col-md-12 stretch-card grid-margin paddlr">
                  <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">                   
                      <h4 class="font-weight-normal">Add Model in your Studio 
                      </h4>
                      <!-- <h1 class="mb-3 rpice">$3000</h1>
                      <h6 class="card-text">IN AWARDS!</h6> -->
                      <a href="add_model.php" class="button">&nbsp;&nbsp;&nbsp;Add Model&nbsp;&nbsp;</a>
                      <!-- <a href="add_video.php" class="button">Add Video</a>
                      <a href="updateinfo.php" class="button">Add Info</a> -->
                      <!-- <img src="assets/images/woma.png" class="card-img-absolute card-img-absolute1" alt="circle-image" /> -->
                    </div>
                  </div>
                </div>
              </div>			 
			        <div class="col-md-6 stretch-card grid-margin paddlr">
                <div class="card bg-gradient-danger1 card-img-holder text-white">
                  <div class="card-body">                   
                    <h3 class="font-weight-normal mb-3">PROMATION PERIOD COUNTDOWN</h3>
                     <!-- Countdown 1-->
                    <div class="rounded bg-gradient-1 text-white shadow p-5 text-center mb-5">
                      <div id="clock-b" class="countdown-circles d-flex flex-wrap justify-content-center pt-4"></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h3><b>$0</b></h3>
                        <p>total earnings</p>
                      </div>
                    <div class="col-sm-4">
                      <h3><b>0h 0m</b></h3>
                      <p>online</p>
                    </div>
                    <div class="col-sm-4">
                      <h3><b>$0</b></h3>
                      <p>avg/hour</p>
                    </div>
					        </div>					
					        <h3 class="font-weight-normal mb-3">PERIOD STATISTIC</h3>
                     <!-- Countdown 1-->
                  <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="colorwhite padlf"> Video Call </td>
                        <td style="width: 50%;">
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="colorwhite"> 0h 0m </td>
                      </tr>
                      <tr>
                        <td class="colorwhite padlf"> Pre vip show </td>
                        <td style="width: 50%;">
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="colorwhite padlf"> 0h 0m </td>
                      </tr>
                      <tr>
                        <td class="colorwhite"> Vip Show </td>
                          <td style="width: 50%;">
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td class="colorwhite"> 0h 0m </td>
                          </tr>
                      <tr>
                        <td class="colorwhite"> Private </td>
                        <td style="width: 50%;">
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="colorwhite"> 0h 0m </td>
                      </tr>
                      <tr>
                        <td class="colorwhite"> Member Chat </td>
                        <td style="width: 50%;">
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="colorwhite"> 0h 0m </td>
                      </tr>
                      <tr>
                        <td class="colorwhite"> Free Chat </td>
                        <td style="width: 50%;">
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="colorwhite"> 0h 0m </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
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