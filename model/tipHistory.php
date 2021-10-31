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
            <li class="nav-item">
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
            <li class="nav-item active">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Earnings</span>
                
                <i class="mdi mdi-buffer menu-icon"></i>
              </a>
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
                </span> Token History </h3>
            </div>		
            <div class="row">
                <div class="table-responsive">
                    <?php 
                        $history = $conn -> getRow('tokenTransfer',['user_id' => $_SESSION['id']]);
                        $tday   = date("d");
                        $tmonth   = date("m");
                        $tyear   = date("Y");
                        //$last  = date("Y-m-d") - $month;
                        
                        //Last Month tokens
                        $lastday = strtotime("-".$tday." Days");
                        $day = date("d", $lastday);
                        $day = $day - 1 + $tday ;
                        $firstday = strtotime("-".$day." Days");
                        
                        $flastday  = date("Y-m-d", $lastday);
                        $ffirstday = date("Y-m-d", $firstday);
                        
                        //This Month tokens
                        $tfirstday = date("Y-m-d",strtotime("-".($tday -1)." Days"));
                        $tlastday  = date("Y-m-d",strtotime("Today"));
                        
                        //This Week tokens
                        $twfirstday = date("Y-m-d",strtotime("Last Monday"));
                        $twlastday  = date("Y-m-d",strtotime("Sunday"));
                        
                        //This Week tokens
                        $l24firstday = date("Y-m-d",strtotime("Yesterday"));
                        $l24lastday  = date("Y-m-d",strtotime("Today"));
                        
                        $Lastmonth = 0;
                        $Thismonth = 0;
                        $Thisweek = 0;
                        $Last24hrs = 0;
                        foreach($history as $ind => $row)
                        {
                            //echo "<br />".($row["date"] >= $tfirstday && $row["date"] <= $tlastday);
                            if($row["date"] >= $ffirstday && $row["date"] <= $flastday){ $Lastmonth = $Lastmonth + $row["amount"];};
                            
                            if($row["date"] >= $tfirstday && $row["date"] <= $tlastday){ $Thismonth = $Thismonth + $row["amount"];};
                            
                            if($row["date"] >= $twfirstday && $row["date"] <= $twlastday){ $Thisweek = $Thisweek + $row["amount"];};
                            
                            if($row["date"] >= $l24firstday && $row["date"] <= $l24lastday){ $Last24hrs = $Last24hrs + $row["amount"];};
                        }
                        //date("M d", $firstday);
                        //echo "First day ".$l24firstday." Last Day ".$l24lastday;
                    ?>
			        <table class="table m-0">
			            <thead>
			                <th>Last Month</th>
			                <th>This Month</th>
			                <th>This Week</th>
			                <th>Last 24 Hrs</th>
			            </thead>
			            <tbody>
			                <td><?php echo $Lastmonth ; ?></td>
			                <td><?php echo $Thismonth ; ?></td>
			                <td><?php echo $Thisweek ; ?></td>
			                <td><?php echo $Last24hrs ; ?></td>
			            </tbody>
			        </table>
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